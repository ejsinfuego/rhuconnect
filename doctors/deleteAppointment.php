<?php

 session_start();

    include('../connection.php');
    //delete all picked appointments
    if(isset($_GET['appointment_id'])){
        $appointment_id = $_GET['appointment_id'];
        $database->query("DELETE FROM consultation WHERE consultation_id = '$appointment_id'");
    }

    unset($_SESSION['appointment_id']);
    $_SESSION['message'] = "Appointment(s) deleted successfully";
    $_SESSION['show_modal'] = "myModal";
    header('location: appointments.php');    
    