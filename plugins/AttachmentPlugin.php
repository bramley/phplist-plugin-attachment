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
 * Registers the plugin with phplist
 */

class AttachmentPlugin extends phplistPlugin
{
    const VERSION_FILE = 'version.txt';

    /*
     *  Inherited variables
     */
    public $name = 'Manage Attachments';
    public $enabled = true;
    public $authors = 'Duncan Cameron';
    public $description = 'Delete unused attachments';
    public $topMenuLinks = array(
        'main' => array('category' => 'system')
    );
    public $pageTitles = array(
        'main' => 'Manage Attachments'
    );

    public function adminmenu()
    {
        return $this->pageTitles;
    }
 
    public function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/AttachmentPlugin/';
        $this->version = (is_file($f = $this->coderoot . self::VERSION_FILE))
            ? file_get_contents($f)
            : '';
        parent::__construct();
    }
}
