<?php
require 'core/core.php';
session_destroy();
header("Location: loginregist.php");
exit();
?>