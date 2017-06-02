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

/*
 * This page and class are used to display the phplist help dialog.
 */

namespace phpList\plugin\AttachmentPlugin;

use phpList\plugin\Common;

class PageactionController extends Common\Controller
{
}

$controller = new PageactionController();
$action = isset($_GET['action']) ? $_GET['action'] : null;
$controller->run($action);
