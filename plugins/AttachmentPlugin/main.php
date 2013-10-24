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
 * This is the entry code invoked by phplist
 */

$commonPlugin = isset($plugins['CommonPlugin']) ? $plugins['CommonPlugin'] : null;

if (!($commonPlugin && $commonPlugin->enabled)) {
    echo "phplist-plugin-common must be installed and enabled to use this plugin";
    return;
}

include $commonPlugin->coderoot . 'Autoloader.php';

CommonPlugin_Main::run();
