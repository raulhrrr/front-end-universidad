<?php

include_once "functions.php";

initSession();
$_SESSION = [];

redirect("../index.php?action=logout&success=true");
