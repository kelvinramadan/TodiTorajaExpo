<?php 
$db = new mysqli('localhost','root','','hotel_db');
if(!$db) {
    echo 'Could not establish database connection, please review your settings';
}

define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/ht/');
include BASEURL.'fpdf/fpdf.php';
session_start();
?>