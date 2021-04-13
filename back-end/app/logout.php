<?php
// session init.
session_start();

// unset all session variables.
$_SESSION = array();

// clearing all cookies.
if(isset($_COOKIE[session_name()])):
    setcookie(session_name(), '', time()-7000000, '/');
endif;

// unset, destroy all session. destroy() ignores some so we do an unset too.
session_unset();
session_destroy();
$_SESSION = array();

header('location: ../../index.php');

?>