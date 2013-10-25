<?php 
/**
 * AttachmentPlugin for phplist
 * 
 * This file is a part of AttachmentPlugin.
 *
 * @category  phplist
 * @package   AttachmentPlugin
 * @author    Duncan Cameron
 * @copyright 2012-2013 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

/**
 * This class is the controller for the plugin providing the action methods
 * Implements the IPopulator interface
 */
class AttachmentPlugin_Controller
    extends CommonPlugin_Controller
    implements CommonPlugin_IPopulator
{
    const PLUGIN = 'AttachmentPlugin';
    const FORMNAME = 'AttachmentPluginForm';
    const CHECKBOXNAME = 'attachments[]';
    const CHECKBOXID = 'attachments';

    private $model;
    private $repository;

    protected function actionDelete()
    {
        $this->logger->logDebug(print_r($_POST, true));
        $this->normalise($_POST);
        $this->model->setProperties($_POST);

        $count = $this->model->deleteAttachments($this->repository);
        $_SESSION[self::PLUGIN]['deleteResult'] = ($count > 0 )
            ? $this->i18n->get('Deleted %d attachments', $count)
            : $this->i18n->get('No attachments selected to delete');

        $redirect = new CommonPlugin_PageURL(null, array());
        header("Location: $redirect");
        exit;
    }

    protected function actionDefault()
    {
        $toolbar = new CommonPlugin_Toolbar($this);
        $toolbar->addHelpButton('attachment');
        $listing = new CommonPlugin_Listing($this, $this);
        $params = array(
            'formName' => self::FORMNAME,
            'listing' => $listing->display(),
            'toolbar' => $toolbar->display(),
            'action' => new CommonPlugin_PageURL(null, array('action' => 'delete')),
            'message' => $this->i18n->get('Attachment repository is %s', $this->repository),
            'confirm_prompt' => $this->i18n->get('confirm_prompt'),
            'checkBoxId' => self::CHECKBOXID
        );

        if (isset($_SESSION[self::PLUGIN]['deleteResult'])) {
            $params['deleteResult'] = $_SESSION[self::PLUGIN]['deleteResult'];
            unset($_SESSION[self::PLUGIN]['deleteResult']);
        }

        print $this->render(dirname(__FILE__) . '/view.tpl.php', $params);
    }
    /*
     *    Public methods
     */
    public function __construct()
    {
        global $attachment_repository;

        parent::__construct();
        $this->model = new AttachmentPlugin_Model(new CommonPlugin_DB());
        $this->repository = $attachment_repository;
    }
    /*
     * Implementation of CommonPlugin_IPopulator
     */
    public function populate(WebblerListing $w, $start, $limit)
    {
        /*
         * Populates the webbler list with attachment details
         */
        $w->setTitle($this->i18n->get('ID'));
        $showDelete = false;

        foreach ($this->model->attachments($start, $limit) as $row) {
            $key = $row['id'];
            $w->addElement($key);
            $w->addColumn($key, $this->i18n->get('file name'), $row['filename']);
            $w->addColumn($key, $this->i18n->get('mime type'), $row['mimetype']);
            $w->addColumn($key, $this->i18n->get('size'), $row['size']);
            $w->addRow($key, $this->i18n->get('description'), $row['description']);
            $w->addRow($key, $this->i18n->get('remotefile'), $row['remotefile']);
            $w->addColumn($key, $this->i18n->get('msg id'), $row['messageid']);
            $w->addColumn($key, $this->i18n->get('subject'), $row['subject']);
            $status = '';

            if (is_file($this->repository . '/' . $row['filename'])) {
                $status .= new CommonPlugin_ImageTag('attach.png', $this->i18n->get('file exists'));
            }

            if ($row['mid']) {
                $status .= new CommonPlugin_ImageTag('email.png', $this->i18n->get('message exists'));
                $select = '';
            } else {
                $select = CHtml::checkBox(self::CHECKBOXNAME, false, array('value' => $key, 'uncheckValue' => 0));
                $showDelete = true;
            }
            $w->addColumnHtml($key, $this->i18n->get('status'), $status);
            $w->addColumnHtml($key, $this->i18n->get('Select'), $select);
        }

        if ($showDelete) {
             $w->addButton('Delete selected', "javascript::;"); 
        }
    }

    public function total()
    {
        return $this->model->totalAttachments();
    }
}
