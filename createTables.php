<?php

require_once 'connect.php';

global $connect;

$sql = "CREATE TABLE users (
    chat_id VARCHAR(30) NOT NULL,
    name VARCHAR(255) NOT NULL,
    page VARCHAR(30) NOT NULL
    )";

if ($connect->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $connect->error;
}

$sql = "CREATE TABLE lessons (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL
    )";

if ($connect->query($sql) === TRUE) {
    echo "Table products created successfully";
} else {
    echo "Error creating table: " . $connect->error;
}
