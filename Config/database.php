<?php
$host = "localhost/XE";
$user = "sha";
$pass = "system";
$dbconn = oci_connect($user, $pass, $host);

if (!$dbconn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
function CloseConn($conn): void
{
    oci_close($conn);
}
?>