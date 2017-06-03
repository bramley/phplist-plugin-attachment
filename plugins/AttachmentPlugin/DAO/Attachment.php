<?php
/**
 * AttachmentPlugin for phplist.
 *
 * This file is a part of AttachmentPlugin.
 *
 * @category  phplist
 *
 * @author    Duncan Cameron
 * @copyright 2012-2017 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

namespace phpList\plugin\AttachmentPlugin\DAO;

use phpList\plugin\Common;

/**
 * DAO class that provides access to the attachment and related tables.
 */
class Attachment extends Common\DAO
{
    public function attachments($start, $limit)
    {
        /*
         *
         */
        $sql =
            "SELECT a.*, ma.messageid, m.subject, m.id as mid
            FROM {$this->tables['attachment']} AS a
            LEFT OUTER JOIN {$this->tables['message_attachment']} AS ma ON a.id = ma.attachmentid
            LEFT OUTER JOIN {$this->tables['message']} AS m ON ma.messageid = m.id
            ORDER by a.id
            LIMIT $start, $limit";

        return $this->dbCommand->queryAll($sql);
    }

    public function totalAttachments()
    {
        $sql =
            "SELECT count(*) as t
            FROM {$this->tables['attachment']} AS a";

        return $this->dbCommand->queryOne($sql, 't');
    }

    public function attachment($attachmentId)
    {
        /*
         *
         */
        $sql =
            "SELECT *
            FROM {$this->tables['attachment']}
            WHERE id = $attachmentId";

        return $this->dbCommand->queryRow($sql);
    }

    public function deleteAttachments(array $attachmentIds)
    {
        /*
         *
         */
        if (count($attachmentIds) == 0) {
            return 0;
        }

        $sql = sprintf(
            "DELETE
            FROM {$this->tables['attachment']}
            WHERE id in (%s)",
            implode(',', $attachmentIds)
        );

        return $this->dbCommand->queryAffectedRows($sql);
    }
}
