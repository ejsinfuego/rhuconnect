<?php 
$title= 'Prescriptions';
$border = "border-left: 3px solid #2E8B57;";
if(!strpos($_SERVER['REQUEST_URI'], 'prescription.php')){
    
}else{ 
    session_start();
    if( $_SESSION['usertype'] == 'd' or $_SESSION['usertype'] == ''){
    header('location: ../login_v2.php');
    }
    session_abort();
    include(__DIR__ . '/../_header_v2.php');
}
$prescriptions = $database->query("select * from prescription where patient_id = ".$userid);
?>
<div class="col py-lg-4 d-lg-flex flex-column align-items-lg-center" style="background: #f1f0f0;font-family: Montserrat, sans-serif;margin-left: 24px;border-radius: 10px; border: 2px solid #2E8B57;">
                <h1 style="font-family: Montserrat, sans-serif;border-radius: 10px;background: transparent;text-align: center; font-weight: bold;text-shadow: 2px 2px #abb2b9;">Prescriptions</h1>
                <p>List your Prescriptions</p>
                <div class="py-2" style="font-family: Alatsi, sans-serif;text-align: left;--bs-body-bg: var(--bs-primary-bg-subtle);--bs-body-font-weight: normal;border-radius: 15px;padding-right: 0px;background: #f1f0f0;">
                    <table class="table sortTable" id="sortTable">
                        <thead>
                            <tr>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Prescription ID</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Note</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Diagnosis</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Date Prescribed</th>
                                <th style="border-style: solid;font-family: Montserrat, sans-serif;background: rgba(255,255,255,0);">Action</th>

                            </tr>
                        </thead>
                        <tbody style="border-style: solid;background: rgba(255,255,255,0);">
                        <?php
                        if(mysqli_fetch_column($prescriptions) == 0){
                            echo "</p>No prescriptions found.</p>";
                        }else{
                        foreach($prescriptions as $prescription){
                            echo "<tr style='border-style: solid;background: rgba(255,255,255,0);'>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['prescription_id']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['note']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".$prescription['diagnosis']."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>".date('M d, Y', strtotime($prescription['created_at']))."</td>";
                            echo "<td style='font-family: Montserrat, sans-serif;border-width: 1px;border-style: solid;background: rgba(255,255,255,0);'>
                            <form method='get'action='generateReport.php'>
                            <input type='hidden' name='prescription_id' value='".$prescription['prescription_id']."'>
                            <button class='btn'style='background-color: #2E8B57; color: white;' type='submit' prescription_id=".$prescription['prescription_id']."'>Print</button>
                            </form>
                            </td>";
                            echo "</tr>";

                        }
                    }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include(__DIR__ . '/../_footer.php'); ?>