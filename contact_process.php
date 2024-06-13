<?php
require 'connection.php';
session_start();

echo 'processed';


// if (($_POST['submit'])) {
    // $names=$_FILES;

    // print_r($_FILES);
    // print_r($_FILES['image']['tmp_name']);

    // $name = $_FILES['image']['name'];
    // echo '<br>';
    // echo '<br>';

    // echo $name;
    // echo '<br>';
    // echo '<br>';
    // $temploc = $_FILES['image']['tmp_name'];
    // echo $temploc;

    // $newname=time().' '.$name;
    // echo $newname;
    // $move=move_uploaded_file($temploc,'images/'.$newname);
    // 
    // if($move){
    // $id=$_SESSION['user_id'];
    // $query="UPDATE students_table SET profile_pic='$newname' WHERE student_id=$id ";
    // $dbcon=$connection->query($query);
    // print_r($dbcon);
    // echo 'move uploaded successfully';
    // header('location: dashboard.php');
    // }else{
    // echo 'not move';
    // }


