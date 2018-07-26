<style>
    .hotel-detail{
        display: block;
        font-weight: normal;
        color: #666666;
        font-size: 15px;
        background-color: #ededed;
        padding: 15px 10px;
        box-shadow: 0px 3px 10px rgba(0,0,0,.3);
    }
    .hotel-detail dt{
        text-align: left;
    }
    .hotel-detail hr {
        margin: 15px 0;
        border: 1px solid #ffc02b;
    }
    .bed {
        font-weight: bold;
    }
    #search{
        text-align: center; 
    }
    #search_form input{
        width: 100%;
    }
    .rooms{
        padding: 0px 3px;
    }
    .hotelname {
        font-size: 20px;
        font-weight: bold;
        color: #160959;
    }
    .contact-container {
        padding: 0 15px;
    }
</style>
<div class="container">

    <div class="row-fluid">
        
        <!-- LEFT SIDE BAR -->
        <div class="span4 leftContent left_categories">
           	<div>
                <div class="headtitle"><p class="left"></p><p class="center">Hotel Detail</p><p class="right"></p></div>
                <div class="hotel-detail dl-horizontal">
                    <p class="hotelname"><?php echo $hoteldata['Name'] ;?></p>
                   <!--  <p><?php //echo $nation_list . ", " . $nation_list . ", " . $city_list;?></p> -->
                   <p><?php echo $region_label ?></p>
                    <p><?php echo date('d M Y', strtotime($checkindate)) . " &mdash; " . date('d M Y', strtotime($checkoutdate)) ;?></p>
                    <?php if($single > 0) {?>
                        <div class="col-md-4 rooms">
                            <p class="bed"><?php echo $single.' ';?>Single</p>
                        </div>
                    <?php } ?>
                    <?php if($double > 0) {?>
                        <div class="col-md-4 rooms">
                            <p class="bed"><?php echo $double.' ';?>Double</p>
                        </div>
                    <?php } ?>
                    <?php if($twin > 0) {?>
                        <div class="col-md-4 rooms">
                            <p class="bed"><?php echo $twin.' ';?>Twin</p>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <hr />
                    <?php //pre($hoteldata); ?>
                    <?php if($hoteldata["RmGrade"] != '') {?>
                    <dt>Room Grade</dt>
                    <dd><?php echo $hoteldata["RmGrade"];?></dd>
                    <?php } ?>

                    <?php if($hoteldata["Meal"] != '') {?>
                    <dt>Meal</dt>
                    <dd><?php echo $hoteldata["Meal"];?></dd>
                    <?php } ?>

                    <?php if(!empty($hoteldata["DiscountDesc"])) {?>
                    <dt>Discount</dt>
                    <dd><?php echo is_array($hoteldata["DiscountDesc"])? implode(',', $hoteldata["DiscountDesc"]):$hoteldata["DiscountDesc"];?></dd>
                    <?php } ?>

                    <?php if(!empty($hoteldata["ImportantInfo"])) {?>
                    <dt>Importand Info</dt>
                    <dd><?php echo is_array($hoteldata["ImportantInfo"])? implode(',', $hoteldata["ImportantInfo"]):$hoteldata["ImportantInfo"];?></dd>
                    <?php } ?>

                    <?php if($hoteldata["Status"] != '') {?>
                    <dt>Status</dt>
                    <dd><?php echo $hoteldata["Status"];?></dd>
                    <?php } ?>
                    
                    <hr />
                    <dt>Total Price</dt><dd class="hotelname"><?php echo $hoteldata["Currency"].' '.number_format($hoteldata["TotalRate"]);?></dd>
                </div>
            </div>    
        </div>
        
        <!-- CONTENT -->
        <div id="hotel-booking" class="span8 mainContent">
            <form id="hotel-book-form" method="post" action="">
                <?php $hoteljson = base64_encode(json_encode($hoteldata));?>
                <input type="hidden" name="city" value="<?php echo $city_list; ?>">
                <input type="hidden" name="nation" value="<?php echo $nation_list; ?>">
                <input type="hidden" name="national" value="<?php echo $nation_list; ?>">
                <input type="hidden" name="checkindate" value="<?php echo $checkindate; ?>">
                <input type="hidden" name="checkoutdate" value="<?php echo $checkoutdate; ?>">
                <input type="hidden" name="single" value="<?php echo $single; ?>">
                <input type="hidden" name="double" value="<?php echo $double; ?>">
                <input type="hidden" name="twin" value="<?php echo $twin; ?>">
                <input type="hidden" name="hotel" value="<?php echo $hoteljson; ?>">
                <input type="hidden" name="city_id" value="<?php echo $city_id; ?>">
                
                <div class="contact-container">

                    <!-- CONTACT PERSON -->
                    <div class="stepForm clearfix">
                        <h2 class="EDEDEDTitle">Contact Person</h2>
                        <div class="row-fluid orange_box" style="width:calc(100% - 4px);">
                            <div class="span6" style="height: 32px !important;">
                                <div>
                                    <label for="contact_title" style="height: 32px !important;">Salutation <span class="req" style="height: 32px !important;">*</span></label>
                                    <select name="contact_title" id="contact_title" class="formselect" style="height: 32px !important;">
                                        <?php foreach ($salutations as $s => $salutation) {?>
                                            <option value="<?php echo $s ?>"  style="height: 32px !important;"><?php echo $s ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="contact_first_name">First Name <span class="req">*</span></label>
                                    <input type="text" class="required val_name" name="contact_first_name" id="contact_first_name"  placeholder="<?php echo form_error('contact_first_name',' ',' '); ?>" />

                                </div>
                                <div>
                                    <label for="contact_last_name">Last Name <span class="req">*</span></label>
                                    <input type="text" name="contact_last_name" id="contact_last_name" class="val_name required"  placeholder="<?php echo form_error('contact_last_name',' ',' '); ?>" />
                                </div>      
                            </div>
                            <div class="span6">
                                <div>
                                    <label for="contact_email">Email <span class="req">*</span></label>
                                    <input type="text" name="contact_email" id="contact_email" class="required email" placeholder="<?php echo form_error('contact_email',' ',' '); ?>" />
                                </div>
                                <div>
                                    <label for="contact_phone">Phone <span class="req">*</span></label>
                                    <input type="text" name="contact_phone" id="contact_phone" class="required" placeholder="<?php echo form_error('contact_phone',' ',' '); ?>" />
                                </div>
                                <div>
                                    <label for="contact_address">MOBILE <span class="req">*</span></label>
                                    <input type="text" name="contact_mobile" id="contact_mobile" class=" required" placeholder="<?php echo form_error('contact_mobile',' ',' '); ?>" />
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- SINGLE -->    
                    <?php if($single > 0){?>
                        <div class="stepForm clearfix">
                            <h2 class="EDEDEDTitle">SINGLE</h2>
                                <label class="clearfix">
                                    <input type="checkbox" class="as_contact<?php if($i == 0){echo' contact_person';}?>" id="as_contact<?php echo $i; ?>" value="<?php if($i == 1){echo $i;}?>" />
                                    Copy from contact person
                                </label>
                            <?php for($i=0; $i<$single; $i++){?>
                                <div class="room-class"> 
                                    <h4>Room <?php echo $i+1 ?></h4>
                                </div>

                                <div class="row-fluid contact-data border-group">
                                    <div class="row-fluid">
                                        <div class="form-group col-md-12 ">
                                            <!-- <label class="control-label" for="name">TITLE *</label> -->
                                            <div class="span2">
                                                <label for="contact_title">Title <span class="req">*</span></label>
                                                <select name="sex-single-<?php echo $i; ?>" id="contact_title" class="formselect form-input" style="display: none;">
                                                    <?php foreach ($salutations as $s => $salutation) {?>
                                                        <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="span5">
                                                <label for="contact_first_name">First Name <span class="req">*</span></label>
                                                <input type="text" class="required val_name form-input" maxlength="100" name="first-single-<?php echo $i; ?>" id="first-single-<?php echo $i; ?>" placeholder="First Name" >
                                            </div>
                                            <div class="span5">
                                                <label for="contact_last_name">Last Name <span class="req">*</span></label>
                                                <input type="text" class="val_name required form-input" maxlength="100" name="last-single-<?php echo $i; ?>" id="last-single-<?php echo $i; ?>" placeholder="Last Name" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>            
                    <?php }?>

                    <!-- DOUBLE -->
                    <?php if($double > 0){ ?>                
                        <div class="stepForm clearfix">
                            <h2 class="EDEDEDTitle">DOUBLE</h2>
                                <label class="clearfix">
                                    <input type="checkbox" class="as_contact<?php if($i == 0){echo' contact_person';}?>" id="as_contact<?php echo $i; ?>" value="<?php if($i == 1){echo $i;}?>" />
                                    Copy from contact person
                                </label>
                            <?php 
                            $room_number=1; 
                            for($i=0; $i<$double*2; $i++){?>
                                <?php if($i%2 == 0){?>
                                    <div class="room-class">                                    
                                        <h4>Room <?php echo $room_number; $room_number++; ?></h4>
                                    </div>
                                <?php } ?>

                                <div class="row-fluid contact-data <?php echo ($i%2 != 0) ? 'border-group' : ''?> ">
                                    <div class="row-fluid">
                                        
                                        <div class="form-group col-md-12 ">
                                            <!-- <label class="control-label" for="name">TITLE *</label> -->
                                            <div class="span2">
                                                <label for="contact_title">Title <span class="req">*</span></label>
                                                <select name="sex-double-<?php echo $i; ?>" id="contact_title" class="formselect form-input" style="display: none;">
                                                    <?php foreach ($salutations as $s => $salutation) {?>
                                                        <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="span5">
                                                <label for="contact_first_name">First Name <span class="req">*</span></label>
                                                <input type="text" class="required val_name form-input" maxlength="100" name="first-double-<?php echo $i; ?>" id="first-double-<?php echo $i; ?>" placeholder="First Name">
                                            </div>
                                            <div class="span5">
                                                <label for="contact_last_name">Last Name <span class="req">*</span></label>
                                                <input type="text" class="val_name required form-input" maxlength="100" name="last-double-<?php echo $i; ?>" id="last-double-<?php echo $i; ?>" placeholder="Last Name">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php }?>
                        </div>            
                    <?php }?>

                    <!-- TWIN -->
                    <?php if($twin > 0){?>
                        <div class="stepForm clearfix">
                            <h2 class="EDEDEDTitle">TWIN</h2>
                            <label class="clearfix">
                                <input type="checkbox" class="as_contact<?php if($i == 0){echo' contact_person';}?>" id="as_contact<?php echo $i; ?>" value="<?php if($i == 1){echo $i;}?>" />
                                Copy from contact person
                            </label>
                            <?php 
                            $room_number = 1;
                            for($i=0; $i<$twin*2; $i++){?>
                                <?php if($i%2 == 0){?>
                                    <div class="room-class">                                    
                                        <h4>Room <?php echo $room_number; $room_number++; ?></h4>
                                    </div>
                                <?php } ?>

                                <div class="row-fluid contact-data <?php echo ($i%2 != 0) ? 'border-group' : ''?> ">
                                    <div class="row-fluid">
                                        <div class="form-group col-md-12 ">
                                            <!-- <label class="control-label" for="name">TITLE *</label> -->
                                            <div class="span2">
                                                <label for="contact_title">Title <span class="req"  >*</span></label>
                                                <select name="sex-twin-<?php echo $i; ?>" id="contact_title" class="formselect form-input" style="display: none; height: 32px;">
                                                    <?php foreach ($salutations as $s => $salutation) {?>
                                                        <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="span5">
                                                <label for="contact_first_name">First Name <span class="req">*</span></label>
                                                <input type="text" class="required val_name form-input" maxlength="100" name="first-twin-<?php echo $i; ?>" id="first-twin-<?php echo $i; ?>" placeholder="First Name">
                                            </div>
                                            <div class="span5">
                                                <label for="contact_last_name">Last Name <span class="req">*</span></label>
                                                <input type="text" class="val_name required form-input" maxlength="100" name="last-twin-<?php echo $i; ?>" id="last-twin-<?php echo $i; ?>" placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div>            
                    <?php }?>

                    <!-- ADDITIONAL REQUEST-->
                    <div class="clearfix">
                        <h2 class="EDEDEDTitle">ADDITIONAL FACILITIES</h2>
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <?php if($facilities){ ?>
                                        <?php foreach ($facilities as $facility) {?>
                                            <label class="col-xs-12 col-md-4 cb-height">
                                              <input type="checkbox" name="facilities[]"> <?php echo $facility['title'] ?>
                                            </label>
                                            <!-- early checkin -->
                                            <?php if($facility['hotel_facilities_id'] == 3){?>
                                                <input type="text" name="facilities[][checkin]" class="col-xs-2 col-md-1 facilities-input">
                                            <?php }?>
                                            <!-- early checkout --> 
                                            <?php if($facility['hotel_facilities_id'] == 7){?>
                                                <input type="text" name="facilities[][checkout]" class="col-xs-2 col-md-1 facilities-input">
                                            <?php }?>
                                            <!-- bed child -->
                                            <?php if($facility['hotel_facilities_id'] == 8){?>
                                                <select name="facilities[][bed_child]" class="col-xs-2 col-md-1 facilities-select">
                                                    <?php for($a=0; $a<=10; $a++){ ?>
                                                        <option><?php echo $a?></option>
                                                    <?php }?>
                                                </select>
                                            <?php }?>
                                        <?php } ?>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="row btn-wrapper">
                        <div class="col-md-12" style="text-align: center;">
                            <input style="margin-top:8px;" type="submit" value="BOOK NOW" class="button">
                        </div>
                    </div>                           
                </div>
                
                
                <div class="pagers">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            
            </form>
        </div>
            
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#hotel-book-form').validate({
            submitHandler: function(form) { // <- pass 'form' argument in
                $('#bookbuttontext').html('Please Wait ...');
                $('#bookbutton').prop('disabled', true);
                // $('#loading-overlay').fadeIn();
                form.submit(); // <- use 'form' argument here.
            }
        });
    });
    $('.as_contact').change(function(){
        var id = $(this).attr('id').replace('as_contact', '');;
        if($(this).is(':checked')){

            $('.as_contact').prop('checked', false);
            $(this).prop('checked', true);

            $('.as_contact').val('');
            $('.passenger_title').val('');
            $('#first-single-0').val($('#contact_first_name').val());
            $('#last-single-0').val($('#contact_last_name').val());
            $('#first-double-0').val($('#contact_first_name').val());
            $('#last-double-0').val($('#contact_last_name').val());
            $('#first-twin-0').val($('#contact_first_name').val());
            $('#last-twin-0').val($('#contact_last_name').val());

           
        }
        
    });
</script>