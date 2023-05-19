<?php

require_once "connect.php";
global $connect;

$name = $_POST['name'];
$url = $_POST['url'];

$sql = "INSERT INTO products(name, url) values('$name', '$url')";
$connect->query($sql);

header("Location: index.php");