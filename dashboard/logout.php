<?php

// minimal mah start dan destroy ae dah cukup
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("location:../index.php?message=keluar dari sistem");
exit;
