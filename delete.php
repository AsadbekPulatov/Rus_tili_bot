<?php

require_once "connect.php";
global $connect;

$id = $_REQUEST['id'];
$sql = "DELETE FROM lessons WHERE `id` = $id";
$connect->query($sql);

header("Location: index.php");