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
 * This class holds the fields entered on the Attachment form
 */
class AttachmentPlugin_Model extends CommonPlugin_Model
{
    /*
     *    private variables
     */
    private $dao;

    /*
     *    Inherited protected variables
     */
    protected $properties = array(
        'attachments' => array()
    );
    protected $persist = array(
    );
    /*
     *    Private methods
     */
    /*
     *    Public methods
     */
    public function __construct($db)
    {
        parent::__construct('AttachmentPlugin');
        $this->dao = new AttachmentPlugin_DAO_Attachment($db);
    }

    public function attachments($start, $limit)
     {
        return $this->dao->attachments($start, $limit);
    }

    public function totalAttachments()
     {
        return $this->dao->totalAttachments();
    }

    public function deleteAttachments($repository)
     {
        foreach ($this->attachments as $attachId) {
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
        return $this->dao->deleteAttachments($this->attachments);
    }

}
