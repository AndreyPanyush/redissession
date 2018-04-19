<?php
/* @var $modx modX */



if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx->addExtensionPackage('redissession', '[[++core_path]]components/redissession/model/');

            break;

        case xPDOTransport::ACTION_UPGRADE:
            $modx->addExtensionPackage('redissession', '[[++core_path]]components/redissession/model/');

            break;

        case xPDOTransport::ACTION_UNINSTALL:
            $modx->removeExtensionPackage('redissession');

            break;
    }
}

return true;