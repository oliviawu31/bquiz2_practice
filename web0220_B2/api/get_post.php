<?php include_once "db.php";
$id=$_POST['id'];
$rows=$News->find($id);

    echo $row['news'];
    