<?php include('config/constants.php');

    $_SESSION=[];
    session_unset();
    session_destroy();
    header('location: userlogin.php');

?>