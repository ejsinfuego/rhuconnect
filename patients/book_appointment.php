<?php include(__DIR__ . '/../_header_v2.php');

$today = date("Y-m-d");
?>
            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;">
                <form method="POST" action="submitConsultation.php" class="text-start" style="border-radius: 10px;">
                    <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Book an Appointment</h2>
                    <h6 class="text-center">Fill up this form with necessary information request medicine.</h6><label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Type</label><select name="type" class="form-select">
                        <optgroup label="Services">
                            <option value="consultation" selected="">Consultation</option>
                            <option value="xray">Xray</option>
                            <option value="urinalysis">Urinalysis</option>
                        </optgroup>
                    </select>
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Date</label>
                    <input class="form-control w-25" min="<?php echo $today; ?>" name="date" type="date">
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Time</label>
                    <input class="form-control w-25" min="08:00" max="18:00" name="time" type="time">
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Note</label><textarea name="note" class="form-control"></textarea>
                    <input class="form-control" name="patient_id" value="<?php echo $userid; ?>" type="hidden">
                    <input name="submit" type="submit" value="Submit" style="margin-top: 18px;margin-bottom: 18px;background: #2E8B57;" class="btn btn-sm btn-primary" >
                </form>
                <div>
                    <strong style="font-family: Montserrat, sans-serif;">Note: Please wait for the confirmation.</strong>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../_footer.php'); ?>