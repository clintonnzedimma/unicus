<?php

/**
 * @author Clinton Nzedimma
 * First Things First (FTF).
 * This module contain all included classes and initialization
 *
 */
ob_start();
session_start();


include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/env/db.php';

include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/procedures/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/procedures/errors.php';

/*CLASSES*/
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/time_object.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/room.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/hall.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/room_singleton.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/user.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/user_singleton.php';
include $_SERVER['DOCUMENT_ROOT'].'/hotelr/engine/tesseract/class/admin.php';
?>

