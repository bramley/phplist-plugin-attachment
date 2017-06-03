<?php
/**
 * AttachmentPlugin for phplist.
 *
 * This file is a part of AttachmentPlugin.
 *
 * @category  phplist
 *
 * @author    Duncan Cameron
 * @copyright 2012-2015 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

namespace phpList\plugin\AttachmentPlugin;

use CHtml;
use phpList\plugin\Common\ImageTag;
use phpList\plugin\Common\IPopulator;
use phpList\plugin\Common\Listing;
use phpList\plugin\Common\PageURL;
use phpList\plugin\Common\Toolbar;

/**
 * This class is the controller for the plugin providing the action methods
 * Implements the IPopulator interface.
 */
class Controller extends \phpList\plugin\Common\Controller implements IPopulator
{
    const PLUGIN = 'AttachmentPlugin';
    const FORMNAME = 'AttachmentPluginForm';
    const CHECKBOXID = 'attachments';

    private $dao;
    private $model;
    private $repository;

    private function deleteAttachments($repository)
    {
        foreach ($this->model->attachments as $attachId) {
            $attachment = $this->dao->attachment($attachId);
            /*
             * Delete attachment and shadow file with no extension
             */
            foreach (array($attachment['filename'], pathinfo($attachment['filename'], PATHINFO_FILENAME)) as $f) {
                if (is_file($file = $repository . '/' . $f)) {
                    unlink($file);
                }
            }
        }

        return $this->dao->deleteAttachments($this->model->attachments);
    }

    protected function actionDelete()
    {
        $this->logger->debug(print_r($_POST, true));
        $this->normalise($_POST);
        $this->model->setProperties($_POST);

        $count = $this->deleteAttachments($this->repository);
        $_SESSION[self::PLUGIN]['deleteResult'] = ($count > 0)
            ? $this->i18n->get('Deleted %d attachments', $count)
            : $this->i18n->get('No attachments selected to delete');

        $redirect = new PageURL();
        header("Location: $redirect");
        exit;
    }

    protected function actionDefault()
    {
        $toolbar = new Toolbar($this);
        $toolbar->addHelpButton('attachment');
        $listing = new Listing($this, $this);
        $params = array(
            'formName' => self::FORMNAME,
            'listing' => $listing->display(),
            'toolbar' => $toolbar->display(),
            'action' => new PageURL(null, array('action' => 'delete')),
            'message' => $this->i18n->get('Attachment repository is %s', $this->repository),
            'confirm_prompt' => $this->i18n->get('confirm_prompt'),
            'checkBoxId' => self::CHECKBOXID,
      );

        if (isset($_SESSION[self::PLUGIN]['deleteResult'])) {
            $params['deleteResult'] = $_SESSION[self::PLUGIN]['deleteResult'];
            unset($_SESSION[self::PLUGIN]['deleteResult']);
        }

        echo $this->render(dirname(__FILE__) . '/view.tpl.php', $params);
    }

    /*
     *    Public methods
     */
    public function __construct(Model $model, DAO\Attachment $dao)
    {
        global $attachment_repository;

        parent::__construct();
        $this->model = $model;
        $this->dao = $dao;
        $this->repository = $attachment_repository;
    }

    /*
     * Implementation of CommonPlugin_IPopulator
     */
    public function populate(\WebblerListing $w, $start, $limit)
    {
        /*
         * Populates the webbler list with attachment details
         */
        $w->setTitle($this->i18n->get('Attachments'));
        $showDelete = false;
        $checkBoxName = sprintf('%s[]', self::CHECKBOXID);

        foreach ($this->dao->attachments($start, $limit) as $row) {
            $key = $row['id'];
            $w->addElement($key);
            $w->addColumn($key, $this->i18n->get('file name'), $row['filename']);
            $w->addColumn($key, $this->i18n->get('mime type'), $row['mimetype']);
            $w->addColumn($key, $this->i18n->get('size'), $row['size']);
            $w->addRow($key, $this->i18n->get('description'), $row['description']);
            $w->addRow($key, $this->i18n->get('remotefile'), $row['remotefile']);

            if ($row['messageid']) {
                $w->addRow($key, $this->i18n->get('campaign'), "{$row['messageid']} | {$row['subject']}");
            }
            $status = '';

            if (is_file($this->repository . '/' . $row['filename'])) {
                $status .= new ImageTag('attach.png', $this->i18n->get('file exists'));
            }

            if ($row['mid']) {
                $status .= new ImageTag('email.png', $this->i18n->get('message exists'));
                $select = '';
            } else {
                $select = CHtml::checkBox($checkBoxName, false, array('value' => $key, 'uncheckValue' => 0));
                $showDelete = true;
            }
            $w->addColumnHtml($key, $this->i18n->get('status'), $status);
            $w->addColumnHtml($key, $this->i18n->get('Select'), $select);
        }

        if ($showDelete) {
            $w->addButton('Delete selected', 'javascript::;');
        }
    }

    public function total()
    {
        return $this->dao->totalAttachments();
    }
}
