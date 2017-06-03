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

namespace phpList\plugin\AttachmentPlugin;

use phpList\plugin\Common;

/**
 * This class holds the fields entered on the Attachment form.
 */
class Model extends Common\Model
{
    /*
     *    Inherited protected variables
     */
    protected $properties = array(
        'attachments' => array(),
    );
    protected $persist = array();

    public function __construct()
    {
        parent::__construct('AttachmentPlugin');
    }
}
