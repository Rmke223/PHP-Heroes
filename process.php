<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'sqlheroes') or die(mysqli_error($mysqli));

$update = false;
$id=0;
$name = "";
$about_me = "";
$biography = "";
$image_url = "";
$powers = "";

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $about_me = $_POST['about_me'];
    $biography = $_POST['biography'];
    $image_url = $_POST['image_url'];
    $powers = $_POST['powers'];

    $mysqli->query("INSERT INTO heroes (name, about_me, biography, image_url, powers) VALUES('$name','$about_me','$biography','$image_url','$powers')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM heroes WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM heroes WHERE id=$id") or die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $about_me = $row['about_me'];
        $biography = $row['biography'];
        $image_url = $row['image_url'];
        $powers = $row['powers'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $about_me = $_POST['about_me'];
    $biography = $_POST['biography'];
    $image_url = $_POST['image_url'];
    $powers = $_POST['powers'];

    $mysqli->query("UPDATE heroes SET name='$name', about_me='$about_me', biography='$biography', image_url='$image_url', powers='$powers'  WHERE id=$id") or
    die($mysqli->error);

    $_SESSION['message'] = "Hero has been updated";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}

