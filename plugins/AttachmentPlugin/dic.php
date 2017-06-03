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

/**
 * This file creates a dependency injection container.
 */
use Mouf\Picotainer\Picotainer;
use Psr\Container\ContainerInterface;

return new Picotainer([
    'phpList\plugin\AttachmentPlugin\Controller' => function (ContainerInterface $container) {
        return new phpList\plugin\AttachmentPlugin\Controller(
            $container->get('phpList\plugin\AttachmentPlugin\Model'),
            $container->get('phpList\plugin\AttachmentPlugin\DAO\Attachment')
        );
    },
    'phpList\plugin\AttachmentPlugin\Model' => function (ContainerInterface $container) {
        return new phpList\plugin\AttachmentPlugin\Model();
    },
    'phpList\plugin\AttachmentPlugin\DAO\Attachment' => function (ContainerInterface $container) {
        return new phpList\plugin\AttachmentPlugin\DAO\Attachment(
            $container->get('phpList\plugin\Common\DB')
        );
    },
    'phpList\plugin\Common\DB' => function (ContainerInterface $container) {
        return new phpList\plugin\Common\DB();
    },
]);
