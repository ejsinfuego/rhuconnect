<?php

require '../vendor/autoload.php';
use Carbon\Carbon;
session_start();
$timeNow = Carbon::now('Asia/Kolkata');


    include("../connection.php");
    //get all rows of date and time
    

    if(isset($_POST['submit'])){
        $type=$_POST['type'];
        $time=$_POST['time'];
        $date=$_POST['date'];
        $pid=$_POST['patient_id'];
        $stat=$_POST['stat'];
        $timestamp= $timeNow;

        $search = $database->query("select * from consultation where date='$date' and time='$time'");

        if($search->num_rows==0){
            $database->query("insert into consultation(type, time, date, patient_id, stat, created_at, updated_at) values('$type','$time','$date','$pid','$stat','$timestamp','$timestamp')");             
            $_SESSION['message']="Consultation Request Sent!";
            $_SESSION['show_modal'] = "myModal";
            header("location: appointments.php");
        }else{
            $_SESSION['message']="Time and Date already taken!";
            $_SESSION['show_modal'] = "myModal";
            header("location: appointments.php");
        }

     }
?>