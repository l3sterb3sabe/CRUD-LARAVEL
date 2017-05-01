<?php
session_start();

$_SESSION['query'] = "select * from people where ". $_POST['q'] . "=" . $_POST['typeSearch'];

?>