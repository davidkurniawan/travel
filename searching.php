<?php
if (count($data) > 0) {
?>

<HTML>
<HEAD>
    <TITLE>List Hotel</TITLE>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.0/awesomplete.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.3/jquery.datetimepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.3/build/jquery.datetimepicker.full.min.js"></script>
    <!-- https://leaverou.github.io/awesomplete/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.0/awesomplete.min.js"></script>

    <!-- https://select2.github.io/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
</HEAD>
<BODY>
<div class="container">
    <form method="post" action="<?php echo base_url('hotel/cs');?>" class="form-inline">
        <input type="hidden" name="city" value="<?=$city; ?>">
        <input type="hidden" name="nation" value="<?=$nation; ?>">
        <input type="hidden" name="national" value="<?=$national; ?>">
        <input type="hidden" name="checkindate" value="<?=$checkindate; ?>">
        <input type="hidden" name="checkoutdate" value="<?=$checkoutdate; ?>">
        <input type="hidden" name="single" value="<?=$single; ?>">
        <input type="hidden" name="double" value="<?=$double; ?>">
        <input type="hidden" name="twin" value="<?=$twin; ?>">
        <?php
        foreach ($data["Hotel"] as $hoteldata) {
            //var_dump($hoteldata);
            $hotelname = $hoteldata["Name"];
            $roomgrade = $hoteldata["RmGrade"];
            $meal = $hoteldata["Meal"];
            $currency = $hoteldata["Currency"];
            $price = $hoteldata["Price"];
            $totalrate = $hoteldata["TotalRate"];
            $discountdesc = $hoteldata["DiscountDesc"];
            $importantinfo = $hoteldata["ImportantInfo"];
            $status = $hoteldata["Status"];
            $hoteljson = base64_encode(json_encode($hoteldata));
            ?>
            <div class="row">
                <div class="col-md-3">
                    Hotel : <?= $hotelname; ?><br/>
                    Room Grade : <?= $roomgrade; ?><br/>
                    Meal : <?= $meal; ?><br/>
                    Disc : <?=$discountdesc; ?><br/>
                    Info : <?=$importantinfo; ?><br/>
                    Status : <?=$status; ?><br/>
                    <?=var_dump($price); ?>
                </div>
                <div class="col-md-3">
                    Rate : <?= $currency.' '.$totalrate; ?>
                </div>
                <div class="col-md-3">
                    <input type="radio" name="hotel" value='<?=$hoteljson; ?>' style="cursor: pointer;">&nbsp;Pick
                </div>
            </div>
            <div class="clearfix"></div>
            <div style="border-bottom: 2px solid #4F5155; width: 100%;"></div>
            <?php
        }
        ?>
        <input type="submit" name="choosebtn" class="btn btn-success" value="Next">
    </form>
</div>
</BODY>
</HTML>
<?php
}
else {
    die("No hotel result");
}
?>