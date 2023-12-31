<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PEW</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
</head>
<?php

require 'vendor/autoload.php';

use Carbon\Carbon;  

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;

$timeNow = Carbon::now('Asia/Kolkata');

//import database
include("connection.php");

if($_POST){

    $date = date('Y-m-d H:i:s');
    $result= $database->query("select * from webuser");
    
    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $province=$_SESSION['personal']['province'];
    $town=$_SESSION['personal']['town'];
    $brgy=$_SESSION['personal']['brgy'];
    $street=$_SESSION['personal']['street'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $mother=$_SESSION['personal']['mother'];
    $father=$_SESSION['personal']['father'];
    $marital=$_SESSION['personal']['marital'];
    $sex = $_SESSION['personal']['sex'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    $created_at = $timeNow;
    $updated_at = $timeNow;
    
    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            
            $database->query("insert into patient(pemail, f_name, l_name, ppassword, pprovince, ptown, pbrgy, pstreet, pdob, ptel, pmother, pfather,pmarital_status, psex, created_at, updated_at) values('$email','$fname','$lname','$newpassword','$province','$town','$brgy','$street','$dob','$tele','$mother','$father','$marital','$sex','$created_at','$updated_at');");
            $database->query("insert into webuser values('$email','p')");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: patients/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }



    
}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>

<body>
    <section class="position-relative py-4 py-xl-5" style="font-family: Montserrat, sans-serif;">
        <section class="py-4 py-xl-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div>
                            <h2 class="text-uppercase fw-bold mb-3">rHUCONNECT</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xxl-12" style="height: auto;margin-bottom: -51px;">
                    <div class="row mb-5" style="height: auto;">
                        <div class="col-8 col-md-8 col-xl-10 text-center mx-auto px-lg-0" style="padding-left: 0px;padding-right: 0px;width: 325px;height: 47.4px;">
                            <h2>Let's get started</h2>
                            <p class="w-lg-50">Now, create your log-ins.</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10 col-xl-8 col-xxl-12">
                            <div class="card flex mb-5">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <label class="form-label">Email</label>
                                    <form class="text-center" method="post">
                                        <div class="mb-3">
                                            <input class="form-control" type="email" name="newemail" placeholder="Email">
                                        <label class="form-label">Phone Number</label>
                                        <input class="form-control" type="phone" name="tele" placeholder="Phone Number"></div>
                                        <div class="mb-3">
                                        <label class="form-label">Password</label><input class="form-control" type="password" name="newpassword" placeholder="Email"></div>
                                        <label class="form-label">Repeat Password</label>
                                        <div class="mb-3">
                                            <input class="form-control" type="password" name="cpassword" placeholder="Password">
                                        </div>
                                        <div class="mb-3">
                                            <input class="btn btn-primary d-block w-100" type="submit" style="background: #1e80c1;">
                                        </div>
                                        <p class="text-muted">Login</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>