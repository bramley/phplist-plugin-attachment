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

/**
 * This is the entry code invoked by phplist.
 */
if (!(phplistPlugin::isEnabled('CommonPlugin'))) {
    echo 'phplist-plugin-common must be installed and enabled to use this plugin';

    return;
}

phpList\plugin\Common\Main::run(new phpList\plugin\AttachmentPlugin\ControllerFactory());
