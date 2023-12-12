<?php

$pluginsDir = dirname(__DIR__);

return [
    'phpList\plugin\AttachmentPlugin\Controller' => $pluginsDir . '/AttachmentPlugin/Controller.php',
    'phpList\plugin\AttachmentPlugin\ControllerFactory' => $pluginsDir . '/AttachmentPlugin/ControllerFactory.php',
    'phpList\plugin\AttachmentPlugin\DAO\Attachment' => $pluginsDir . '/AttachmentPlugin/DAO/Attachment.php',
    'phpList\plugin\AttachmentPlugin\Model' => $pluginsDir . '/AttachmentPlugin/Model.php',
    'phpList\plugin\AttachmentPlugin\PageactionController' => $pluginsDir . '/AttachmentPlugin/pageaction.php',
];
