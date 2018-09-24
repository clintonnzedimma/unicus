<?php

/**
 * @author Clinton Nzedimma
 * First Things First (FTF).
 * This module contain all included classes and initialization
 *
 */
ob_start();
session_start();


include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/db.php';

include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/procedures/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/procedures/errors.php';

include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/class/admin.php';
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/class/user.php';
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/class/user_singleton.php';
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/class/event_singleton.php';

;
?>

