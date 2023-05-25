<?php
require 'config/database.php';

session_start();
echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
    echo $key . " " . $val . "<br/>";

$_SESSION["id"] = "";
$_SESSION["isloggedin"] = false;
$_SESSION["username"] = "";

session_destroy();

header("location: index.php");

exit;
?>