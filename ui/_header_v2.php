<?php 
$title = $title ?? 'RHUConnect'; 
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
</head>
<?php 

session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p' and $_SESSION['usertype']!='d'){
            header("location: ../login_v2.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login_v2.php");
    }
    
    if($_SESSION['usertype']=='p'){
        include("connection.php");
        $userrow = $database->query("select * from patient where pemail='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["pid"];
        $username=$userfetch["pname"];
        $med_link = "../patients/request_medicine.php";
        $med_link_sidebar = "../patients/medicine_requests.php";
        $appointment_link = "../patients/book_appointment.php";
        $appointment_link_sidebar = "../patients/appointments.php";
        $index = "../patients/index.php";

    }else{
        //import database
        include("connection.php");
        $userrow = $database->query("select * from doctor where docemail='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["docid"];
        $username=$userfetch["docname"];
        $med_link = "../doctors/medicine_inventory.php";
        $appointment_link = "../doctors/appointments.php";
        $med_link_sidebar = "../doctors/medicine_requests.php";
        $appointment_link_sidebar = "../doctors/appointments.php";
        $index = "../doctors/index.php";
    }
        ?>

  
    <?php if(isset($_SESSION['message']) && $_SESSION['message'] !=''){
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']);
    } ?>

<body style="font-family: Montserrat, sans-serif;">
    <nav class="navbar navbar-expand-md shadow py-3" data-bs-theme="light" style="--bs-body-color: #212529;--bs-primary: #090c9b;--bs-primary-rgb: 9,12,155;background: linear-gradient(69deg, #1e80c1 56%, white 100%), var(--bs-primary);color: #fbfff1;border-color: #3c3744;border-bottom: 4.4px none #3c3744;">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="<?php echo $index; ?>"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon" style="background: #a5def2;text-shadow: 20px -1px 5px var(--bs-primary);"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" style="box-shadow: 0px 0px;text-shadow: 4px 2px 3px;">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.6 483.2 483.9 512 448.5 512H128.1C92.75 512 64.09 483.3 64.09 448V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5H575.8zM328 232V176C328 167.2 320.8 160 312 160H264C255.2 160 248 167.2 248 176V232H192C183.2 232 176 239.2 176 248V296C176 304.8 183.2 312 192 312H248V368C248 376.8 255.2 384 264 384H312C320.8 384 328 376.8 328 368V312H384C392.8 312 400 304.8 400 296V248C400 239.2 392.8 232 384 232H328z"></path>
                    </svg></span><span style="font-family: Alata, sans-serif;font-size: 25px;color: #fbfff1;">RHUConnect</span></a><button data-bs-toggle="collapse" class="navbar-toggler text-center" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1" style="color: #fbfff1;">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" data-bss-hover-animate="jello" href="<?php echo $appointment_link; ?>" style="font-family: Allerta, sans-serif;color: #fbfff1;">Appointment</a></li>
                    <li class="nav-item"><a class="nav-link" data-bss-hover-animate="jello" href="<?php echo $med_link; ?>" style="font-family: Allerta, sans-serif;color: #fbfff1;">Medicine</a></li>
                    <li class="nav-item" style="color: #fbfff1;"><a class="nav-link" data-bss-hover-animate="jello" href="#" style="font-family: Allerta, sans-serif;color: #fbfff1;">Consultation</a></li>
                    <li class="nav-item"><a class="nav-link" data-bss-hover-animate="wobble" href="#" style="font-family: Allerta, sans-serif;color: rgb(251,255,241);">Health Monitoring</a></li>
                </ul><a class="btn btn-warning" href="../logout.php" data-bss-hover-animate="bounce" type="button" style="background: #1e80c1;font-family: Allerta, sans-serif;color: #fbfff1;border-style: none;">Logout</a>
            </div>
            <aside></aside>
        </div>
    </nav>
    <div class="container"></div>
    <div class="container">
        <div class="row gx-2" style="margin-top: 45px;">
            <div class="col-md-8 col-xl-4 col-xxl-2 offset-xl-0" style="background: #f1f0f0;border-radius: 23px;">
                <ul class="nav nav-tabs" style="border-radius: 10px;">
                    <li class="nav-item"><a class="nav-link active text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="<?php echo $med_link_sidebar; ?>" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;padding-top: 21px;"><strong>Medicine Requests</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M128 192C110.3 192 96 177.7 96 160C96 142.3 110.3 128 128 128C145.7 128 160 142.3 160 160C160 177.7 145.7 192 128 192zM200 160C200 146.7 210.7 136 224 136H448C461.3 136 472 146.7 472 160C472 173.3 461.3 184 448 184H224C210.7 184 200 173.3 200 160zM200 256C200 242.7 210.7 232 224 232H448C461.3 232 472 242.7 472 256C472 269.3 461.3 280 448 280H224C210.7 280 200 269.3 200 256zM200 352C200 338.7 210.7 328 224 328H448C461.3 328 472 338.7 472 352C472 365.3 461.3 376 448 376H224C210.7 376 200 365.3 200 352zM128 224C145.7 224 160 238.3 160 256C160 273.7 145.7 288 128 288C110.3 288 96 273.7 96 256C96 238.3 110.3 224 128 224zM128 384C110.3 384 96 369.7 96 352C96 334.3 110.3 320 128 320C145.7 320 160 334.3 160 352C160 369.7 145.7 384 128 384zM0 96C0 60.65 28.65 32 64 32H512C547.3 32 576 60.65 576 96V416C576 451.3 547.3 480 512 480H64C28.65 480 0 451.3 0 416V96zM48 96V416C48 424.8 55.16 432 64 432H512C520.8 432 528 424.8 528 416V96C528 87.16 520.8 80 512 80H64C55.16 80 48 87.16 48 96z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="prescription.php" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;"><strong>Prescriptions</strong><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-prescription align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <path d="M5.5 6a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0V9h.293l2 2-1.147 1.146a.5.5 0 0 0 .708.708L9 11.707l1.146 1.147a.5.5 0 0 0 .708-.708L9.707 11l1.147-1.146a.5.5 0 0 0-.708-.708L9 10.293 7.695 8.987A1.5 1.5 0 0 0 7.5 6h-2ZM6 7h1.5a.5.5 0 0 1 0 1H6V7Z"></path>
                                <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v10.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 14.5V4a1 1 0 0 1-1-1V1Zm2 3v10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V4H4ZM3 3h10V1H3v2Z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="#" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;"><strong>Check Patients</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M208 256c35.35 0 64-28.65 64-64c0-35.35-28.65-64-64-64s-64 28.65-64 64C144 227.3 172.7 256 208 256zM464 232h-96c-13.25 0-24 10.75-24 24s10.75 24 24 24h96c13.25 0 24-10.75 24-24S477.3 232 464 232zM240 288h-64C131.8 288 96 323.8 96 368C96 376.8 103.2 384 112 384h192c8.836 0 16-7.164 16-16C320 323.8 284.2 288 240 288zM464 152h-96c-13.25 0-24 10.75-24 24s10.75 24 24 24h96c13.25 0 24-10.75 24-24S477.3 152 464 152zM512 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h448c35.35 0 64-28.65 64-64V96C576 60.65 547.3 32 512 32zM528 416c0 8.822-7.178 16-16 16H64c-8.822 0-16-7.178-16-16V96c0-8.822 7.178-16 16-16h448c8.822 0 16 7.178 16 16V416z"></path>
                            </svg></a><a class="nav-link text-center d-xxl-flex flex-wrap order-first align-items-xxl-center" href="<?php echo $appointment_link_sidebar; ?>" style="background: rgba(255,255,255,0);font-size: 0.7rem;border-style: none;color: #3c3744;padding-bottom: 21px;"><strong>Appointments</strong><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" class="align-self-start order-first" style="font-size: 30px;padding-right: 0px;padding-left: 0px;width: 46px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z"></path>
                            </svg></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
            </div>