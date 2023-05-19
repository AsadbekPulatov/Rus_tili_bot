<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <title>Darslar ro'yxati</title>
</head>
<body>
<h1 align="center" class="text text-primary container">Darslar ro'yxati</h1>
<div class="container">
    <a href="create.php" class="btn btn-info float-end m-3">Dars qo'shish</a>
    <table class="table table-bordered text-center">
        <tr>
            <th>Nomi</th>
            <th>Video</th>
            <th>Amallar</th>
        </tr>
        <?php
        require_once "connect.php";
        global $connect;
        $sql = "SELECT * FROM lessons";
        $result = $connect->query($sql);
        $lessons = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><a href='{$row['url']}' >" . $row['url'] . "</a></td>";
                echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>O'chirish</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>

</body>
</html>
