<?php
if (!session_id()) session_start();
if (!$_SESSION['logon']){
    header("Location:index.php");
}
else {
    session_destroy();
    setcookie("email", "", time()-3600);
    header("location: index.php");
}
die();
?>