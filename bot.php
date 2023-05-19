<?php

include 'Telegram.php';
require_once 'User.php';

$bot_token = "5982490005:AAHL9JjQ7f45QAfmEYGcGgUtlFrfrL5Y81U";
$telegram = new Telegram($bot_token);

$chat_id = $telegram->ChatID();
$text = $telegram->Text();
$first_name = $telegram->FirstName();

$user = new User($chat_id);
$page = $user->getPage();

if ($text == "/start") {
    $user->createUser($chat_id, $first_name);
    showMainPage();
} else {
    switch ($page) {
        case "main":
            switch ($text) {
                case "Darslar ro'yxati 📁":
                    showList();
                    break;
                case "Darsni qidirish 🔎":
                    askDrug();
                    break;
            }
            break;
        case "search":
            searchLesson($text);
            break;
        case "result":
            showLesson($text);
            break;
    }
}

function showMainPage()
{
    global $chat_id, $telegram, $user;
    $user->setPage("main");

    $text = "Rus tilini o'rgatadigan botga xush kelibsiz!";

    $options = [
        [$telegram->buildKeyboardButton("Darslar ro'yxati 📁"), $telegram->buildKeyboardButton("Darsni qidirish 🔎")],
    ];
    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function showList(){
    global $chat_id, $telegram, $user;
    $user->setPage("result");

    $text = "Darslar ro'yxati:";
    $lesson = new Lesson();
    $lessons = $lesson->getLessons();
    $options = [];
    foreach ($lessons as $item) {
        $options[] = [$telegram->buildKeyboardButton($item['name'])];
    }

    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function askDrug(){
    global $chat_id, $telegram, $user;
    $user->setPage("search");

    $text = "Dars nomini kiriting";
    $content = [
        'chat_id' => $chat_id,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function searchLesson($name){
    global $chat_id, $telegram, $user;
    $user->setPage("result");

    $text = "Qidiruv natijalari:";
    $lesson = new Lesson();
    $lessons = $lesson->searchLesson($name);
    $options = [];
    foreach ($lessons as $item) {
        $options[] = [$telegram->buildKeyboardButton($item['name'])];
    }
    $keyboard = $telegram->buildKeyBoard($options, false, true);
    $content = [
        'chat_id' => $chat_id,
        'reply_markup' => $keyboard,
        'text' => $text,
    ];
    $telegram->sendMessage($content);
}

function showLesson($name){
    global $chat_id, $telegram, $user;
    $user->setPage("result");

    $text = "Dori haqida ma'lumot:";
    $lesson = new Lesson();
    $lesson = $lesson->searchLesson($name);
    $lesson = $lesson[0];
    $text .= "\n\n<b>Nomi:</b> " . $lesson['name'];
    $text .= "<a href='" . $lesson['video'] . "'>{$lesson['name']}</a>";
    $content = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
    ];
    $telegram->sendMessage($content);
}

?>