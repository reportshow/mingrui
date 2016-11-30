<pre><?php
session_start();

$c = var_export($_SESSION,1);
echo $c;
unset($_SESSION);
//session_unset(),