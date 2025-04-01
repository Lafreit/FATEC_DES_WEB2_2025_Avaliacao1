<?php
session_start();
session_destroy();
header("Location: /biblioteca/index.php");
exit;
?>
