<?php require_once("includes/connection.php") ?>
<?php
    session_destroy();
    header("Location: index.php");
?>