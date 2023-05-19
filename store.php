<?php

require_once "connect.php";
require_once "Telegram.php";
global $connect;

$bot_token = "5982490005:AAHL9JjQ7f45QAfmEYGcGgUtlFrfrL5Y81U";
$telegram = new Telegram($bot_token);

$name = $_POST['name'];
$url = $_POST['url'];

$text = $name;
$text .= "\n\n";
$text .= $url;

$sql = "SELECT * FROM users";
$result = $connect->query($sql);
$chat_id = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content = [
            'chat_id' => $row['chat_id'],
            'text' => $text,
            'parse_mode' => 'HTML',
        ];
        $telegram->sendMessage($content);
    }
}

$sql = "INSERT INTO lessons(name, url) values('$name', '$url')";
$connect->query($sql);

header("Location: index.php");