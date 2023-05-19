<?php

require_once "connect.php";

class Lesson
{
    function getLessons()
    {
        global $connect;
        $sql = "SELECT * FROM lessons";
        $result = $connect->query($sql);
        $lessons = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lessons[] = $row;
            }
        }
        return $lessons;
    }

    function searchLesson($name)
    {
        global $connect;
        $sql = "SELECT * FROM lessons WHERE name LIKE '%$name%'";
        $result = $connect->query($sql);
        $lessons = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lessons[] = $row;
            }
        }
        return $lessons;
    }
}