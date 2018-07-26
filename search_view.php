<style> 
.hide{
  display: none;
}
.ui-menu {
    list-style: none;
    padding: 2px;
    margin: 94%;
    display: block;
    float: left;
    max-height: 300px;
    overflow-y: scroll;
}
.img-wrapper  {
    background: url("/images/hotel/noimg.jpg") ;
    width: 340px;
    height: 220px;
}
.img-room {
    background: url("/images/hotel/noimage2.gif");
    width: 270px;
    height: 170px
}
.button {
    margin-top: 13px
}
.button-room {
    min-width: 125px;
    padding: 10px 25px;
    background: rgba(253,184,19,1);
    border: none;
    color: rgba(255, 255, 255, 1);
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
    margin-top: 13px ;
}
.button-room:hover {
    background: rgba(146,146,146,1);
    color: rgba(255, 255, 255, 1);
    text-decoration: none;
}
.roomHotel thead {
    border-bottom: 5px solid #fdb813;
    background: #333333;
    color: #fff;
    font-weight: bold;
}
.roomHotel tbody td {
    border-top: 1px solid #fdb813;
    border-left: 1px solid #fdb813;
}
.roomHotel td {
    padding: 10px;
    text-align: center;
}
.roomHotel th {
    padding: 10px;
    border: 1px solid white;
    text-align: center;
    border-color: white;
}
.roomHotel td.bLeft1d1d1d {
    border-left: 1px solid #1d1d1d;
}
.roomHotel td.bLeftffffff {
    border-left: 1px solid #ffffff;
}
.roomHotel td.bBottom1d1d1d {
    border-bottom: 1px solid #1d1d1d;
}
.roomHotel td.bBottomffffff {
    border-bottom: 1px solid #ffffff;
}
.roomHotel td.bBottomfdb813 {
    border-bottom: 1px solid #fdb813;
}
.roomHotel {
    font-size: 12px;
}
table.tableRoom td {
    vertical-align: top;
    text-transform: capitalize;
}
table.tableRoom .button {
    padding: 3px 8px;
}
table.tableRoom .tleft {
    text-align: left;
}
table.tableRoom td {
    vertical-align: top;
    text-transform: capitalize;
}
table.tableRoom .button {
    padding: 3px 8px;
}
table.tableRoom .tleft {
    text-align: left;
}

.button-more-room {
  display: inline-block;
  padding: 3px 5px;
  font-size: 14px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: deepskyblue;
  border-radius: 5px;
}

.button-more-room:hover {background-color: #4CAF50;
}

.button-more-room:active {
  background-color: #4CAF50;
  transform: translateY(4px);
}
.room-title{
    background: #2F4F4F;
    padding: 10px 20px;
    color: #110f41;
    font-weight: normal;
    font-size: 20px;
    text-transform: uppercase;
    margin-top: 15px;
}

.hotel-detail{
    display: block;
    font-weight: normal;
    color: #666666;
    font-size: 15px;
}
.hotel-detail dt{
    text-align: left;
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
.ajax-load{
    background: #e1e1e1;
    padding: 10px 0px;
    width: 100%;
}

.content {
    background: url(http://smallenvelop.com/wp-content/uploads/2014/08/simple-pre-loader.jpg
    ) center no-repeat;
    background-size: 100%;
    width: 100%;
}
            
 /*loader room css untuk see room*/

.loader-room,
.loader-room:before,
.loader-room:after {
  background: #82ed63;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader-room {
  color: #82ed63;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;

}
.loader-room:before,
.loader-room:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader-room:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader-room:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}


/* Add animation to "page content" */
.toggle-room {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s;
  min-height: 250px;
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

.loader-test{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: none;
    background: center no-repeat rgba(0,0,0,0.5);
}
.loader {
  position:absolute;
  top:0px;
  left:0px;
  width:100%;
  height:3px;
  margin-top: 16px;
  background: #AAA;
  overflow:hidden;
  display: none;
}
.blockMain{
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-color: center no-repeat rgba(0,0,0,0.5);
    opacity: 0.50;
    display: none;
}
.onload {
  position:absolute;
  width:35%;
  height:inherit;
  background:rgba(253,184,19,1);
  transform: skew(-20deg, 0deg);
  -ms-transform: skew(-20deg, 0deg);
  -webkit-transform: skew(-20deg, 0deg);
  animation-name:loading;
  animation-duration:1.5s;
  animation-timing-function:linear;
  animation-iteration-count:infinite;
  display: none;
}

@keyframes loading {
    0%   {right:100%;}
    100% {right:-35%;}
    
}
.mainContent {
    position: relative;
}
.EDEDEDTitlesearch{
    font-size: 20px;
    font-weight: normal;
    text-transform: uppercase;
    margin-top: 15px; 
}
.sortHotel {
    position: absolute;
    top: 36px;
    left: 72%;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">
    <div class="row-fluid">
    <!-- SIDE BAR -->
        <div class="span3 left_categories">
            <div>
                <div class="headtitle"><p class="left"></p><p class="center">Search Detail </p><p class="right"></p></div>
                
                <p><?php echo date('d M Y', strtotime($checkindate)) . " &mdash; " . date('d M Y', strtotime($checkoutdate)) ;?></p>
                <form id="search_form" action="<?php echo base_url('hotel/searching');?>" method="get">
                    
                    <div>
                        <label for="input_hotel_label_main">Search Hotel Name</label>
                        <div class="outer_select">
                            <input id="input_hotel_label_main" type="text" name="input_hotel_label_main" class="input-hotel-main text-form search-group" value="" placeholder="Nama Hotel" data-msg-required="Kota/Tujuan tidak boleh kosong!">

                            <input id="input-hotel-label" type="hidden" name="hotel_label">
                            <input id="input-hotel-hcode" type="hidden" name="hotelcode">
                            <input id="input-hotel-ccode" type="hidden" name="countrycode">
                            <input id="input-hotel-rgncode" type="hidden" name="city">
                            <input id="input-city-label" type="hidden" name="city_label">
                            <input id="input-city-ncode" type="hidden" name="nation">
                            <input id="input-city-nlcode" type="hidden" name="national">
                            <input id="input_city_id" type="hidden"  name="city_id" >
                        </div>
                    </div> 

                    <label>Check In</label>
                    <input type="text" name="checkindate" id="checkindate" class="form-control required" value="<?php echo $checkindate;?>" readonly="readonly" style="cursor: pointer;"/>

                    <label>Check Out</label>
                    <input type="text" name="checkoutdate" id="checkoutdate" class="form-control required" value="<?php echo $checkoutdate;?>" readonly="readonly" style="cursor: pointer;"/>

                    <div class="col-md-4 rooms">
                        <label>Single</label>
                        <select name="single" id="single" class="form-control required">
                            <?php for($i=0;$i<=6;$i++){
                                if($i==1 && $input['single'] == '')
                                {
                                  $selected = 'selected="selected"';  
                                }
                                elseif($input['single'] != '' && $i == $input['single'])
                                {
                                  $selected = 'selected="selected"'; 
                                }
                                else
                                {
                                  $selected = '';
                                }
                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 rooms">
                        <label>Double</label>
                        <select name="double" id="double" class="form-control required">
                            <?php for($i=0;$i<=6;$i++){
                                if($i==1 && $input['double'] == '')
                                {
                                  $selected = 'selected="selected"';  
                                }
                                elseif($input['double'] != '' && $i == $input['double'])
                                {
                                  $selected = 'selected="selected"'; 
                                }
                                else
                                {
                                  $selected = '';
                                }
                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 rooms">
                        <label>Twin</label>
                        <select name="twin" id="twin" class="form-control required">
                            <?php for($i=0;$i<=6;$i++){
                                if($i==1 && $input['twin'] == '')
                                {
                                  $selected = 'selected="selected"';  
                                }
                                elseif($input['twin'] != '' && $i == $input['twin'])
                                {
                                  $selected = 'selected="selected"'; 
                                }
                                else
                                {
                                  $selected = '';
                                }
                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <input id="search" type="submit" onclick="move()" class="button" value="SEARCH" />
                    
                    </form>                
                </div>    
            </div>
        <!-- MAIN CONTENT -->
        <div class="se-pre-con"></div>
        <div class="span9 mainContent">
        <div class="blockMain"></div>
        <div class="loader">
            <div class="onload">
            </div>            
        </div> 

        <div class="EDEDEDTitle" style="padding:2px 20px;">
        <?php if(empty($hotel_label)){ ?>
            <h2 class="EDEDEDTitlesearch">Your Search Results in <?php echo $region_label ;?></h2>
            <?php } else { ?> 
            <h2 class="EDEDEDTitlesearch">Hotel Search Results in <?php echo $hotel_label ;?></h2>
            <?php } ?>
            <?php echo $this->session->flashdata('No_available_hotels'); ?>
            <form action="<?php echo base_url('hotel/searching');?>" method="get">
            <select class="sortHotel" name="sortHotel" onchange="this.form.submit()">
                <option name="sortHotel" >--Option--</option>
                <option name="maxprice" value="maxprice" >High To Low Price</option>
                <option name="minprice" value="minprice" >Low To High Price</option>
            </select>
            <input type="hidden" name="row" value="<?php echo $count; ?>" >
            <input type="hidden" name="city" value="<?php echo $current_city_code; ?>">
            <input type="hidden" name="nation" value="<?php echo $current_nation; ?>">
            <input type="hidden" name="national" value="<?php echo $current_national; ?>">
            <input type="hidden" name="checkindate" value="<?php echo date('Y-m-d',strtotime($checkindate)); ?>">
            <input type="hidden" name="checkoutdate" value="<?php echo date('Y-m-d',strtotime($checkoutdate)); ?>">
            <input type="hidden" name="single" value="<?php echo $single; ?>">
            <input type="hidden" name="double" value="<?php echo $double; ?>">
            <input type="hidden" name="twin" value="<?php echo $twin; ?>">
            <input type="hidden" name="hotel" value="<?php echo $hoteljson; ?>">
            <input type="hidden" name="data_hotel" value="<?php echo $hoteldata["HCode"];?>" />
            <input type="hidden" name="regionlabel" value="<?php echo $region_label ;?>" />
            <input type="hidden" name="data_hotel" value="<?php echo $hotel_label;?>" />
            <input type="hidden" name="city_id" value="<?php echo $city_id ?>">
            </form>
        </div>
        <?php if($allhotel['HotelNo'] == '1'){ ?>
        	<div style="position: absolute; width: 100%; height: 97%;background: white; ">
                <h2 style="text-align:center;">No available Hotel Room</h2>
                </div>

        <?php } ?>        
            <?php if(empty($search_hotel)) { ?>
            <?php
            $count = 0;
            $satu  = 0 ;
            foreach ($allhotel as $key => $hoteldata)
              {
                $count++;
                $splycd         = $hoteldata['SplyCd'];
                $availsply      = $hoteldata['AvailSply'];
                $Availsplyhotel = $hoteldata['AvailSplyHotel'];
                $gambarhotel    = $hoteldata['ImageUrl'];
                $hotelname      = $hoteldata["Name"];
                $roomgrade      = $hoteldata["RmGrade"];
                $meal           = $hoteldata["Meal"];
                $currency       = $hoteldata["Currency"];
                $price          = $hoteldata["Price"];
                $totalrate      = $hoteldata["TotalRate"];
                $discountdesc   = $hoteldata["DiscountDesc"];
                $importantinfo  = $hoteldata["ImportantInfo"];
                $status         = $hoteldata["Status"];
                $hoteljson      = base64_encode(json_encode($hoteldata));
                $input          = $this->input->get();
                $asset['input'] = $input;
                $req = array(
                    "hotel_code" => $hoteldata["HCode"]
                );
                $gambar = $this->hotelavia->searchHotelDetail($req);
              
            ?>    

                <form id="book-form" method="post" action="<?php echo base_url('hotel/book_now');?>" class="form-inline" data-id="myDiv<?php echo $key; ?>">

                    <div class="productList bevyup_product">                        
                        <div class="span5 fleft">
                            <div class="img-wrapper">                                
                                <a class="detail-btn" href="javascript:void(0);" data-row="<?php echo $key; ?>" >

                                    <img src="<?php echo $gambar["Hotel"]["HotelImage"][2]['ImageUrl'];?>" alt="" style="width: 337px;height: 237px;" />

                                </a>
                            </div>
                        </div>

                        <div class="span7 fleft productContent">
                            <div class="description-wrapper">
                                <div class="hotel-title">
                                    <h2>
                                    <a class="detail-btn" href="javascript:void(0);" data-row="<?php echo $key; ?>" ><?php echo $hotelname; ?></a>
                                    </h2>
                                </div>

                                <div class="hotel-detail detailProduct clearfix">
                                                        
                                
                                    <div class="fleft detail3"><p><?php echo $currency." "; echo number_format($totalrate);  ?></p></div>

                                    <div class="fleft">
                                            <p>
                                                
                                            </p>
                                    </div>
                                </div>
                
                                <div class="hotel-detail dl-horizontal" id="post-data">
                                    <?php if($roomgrade != '') {?>
                                        <dt>Room Grade</dt>
                                        <dd><?php echo $roomgrade;?></dd>
                                    <?php } ?>

                                    <?php if($meal != '') {?>
                                        <dt>Meal</dt><dd><?php echo $meal;?></dd>
                                    <?php } ?>

                                    <?php if(! empty($discountdesc)) {?>
                                    <dt>Discount</dt><dd><?php echo $discountdesc;?></dd>
                                    <?php } ?>

                                    <?php if(! empty($importantinfo)) {?>
                                    <dt>Info</dt><dd><?php echo $importantinfo;?></dd>
                                    <?php }?>

                                 
                                </div>
                    
                                <input id="bookhotel" type="submit" class="button fright" value="Book Now" />
                            </div>

                            <input type="hidden" name="row" value="<?php echo $this->security->sanitize_filename($count); ?>" >
                            <input type="hidden" name="city" value="<?php echo $this->security->sanitize_filename($current_city_code); ?>">
                            <input type="hidden" name="nation" value="<?php echo $current_nation; ?>">
                            <input type="hidden" name="national" value="<?php echo $current_national; ?>">
                            <input type="hidden" name="checkindate" value="<?php echo date('Y-m-d',strtotime($checkindate)); ?>">
                            <input type="hidden" name="checkoutdate" value="<?php echo date('Y-m-d',strtotime($checkoutdate)); ?>">
                            <input type="hidden" name="single" value="<?php echo $single; ?>">
                            <input type="hidden" name="double" value="<?php echo $double; ?>">
                            <input type="hidden" name="twin" value="<?php echo $twin; ?>">
                            <input type="hidden" name="hotel" value="<?php echo $hoteljson; ?>">
                            <input type="hidden" name="data_hotel" value="<?php echo $hoteldata["HCode"];?>" />
                            <input type="hidden" name="regionlabel" value="<?php echo $region_label ;?>" />
                            <input type="hidden" name="splycd" value="<?php echo $splycd ;?>" />
                            <input type="hidden" name="availsply" value="<?php echo $availsply ;?>" />
                            <input type="hidden" name="Availsplyhotel" value="<?php echo $this->security->sanitize_filename($Availsplyhotel) ;?>" />
                            <input type="hidden" name="city_id" value="<?php echo $city_id ?>">
                            <!-- //kirim data untuk mendapatkan room -->
                            <?php if(empty($this->input->get('hotelname'))) {?>
                                <input type="button" id="ajaxBtnRoom" class="button-room" value="View More Room" />
                            <?php } ?>
                    </div>
                    <div class="row_fluid clearfix"></div>
                </div> 
                </form>  
                    <!-- SEE ROOM -->
                <div class="se-pre-con"></div>
                <div class="toggle-room clearfix" style="padding: 0 15px;" id="myDiv<?php echo $key; ?>">
                    <div class="loader-room"></div>
                    <div class="hotel-room">
                        <div id="div1" class="showRoomBtn1" ">
                            
                        </div>
                    </div> <!-- tag tutup Hotel Room -->
                </div> <!-- tag tutup Toggle Room -->                           

                
        <?php } ?> <!-- tutup foreach -->
            <div class="pagers">
                <?php echo $this->pagination->create_links(); ?>
            </div>
            </div>
        </div>
    </div>

                <?php } else { ?>

                <?php if($search_hotel == 'N'){ ?>
                <div style="position: absolute; width: 100%; height: 66%;background: white; ">
                <h2 style="text-align:center;">No available Hotel Room</h2>
                </div>
                <?php } ?>

                <?php if(!empty($search_hotel[0])){ ?>
          <?php
            $key = 0;
            $key++;
                $gambarhotel   = $search_hotel[0]['ImageUrl'];
                $hotelname     = $search_hotel[0]["Name"];
                $roomgrade     = $search_hotel[0]["RmGrade"];
                $meal          = $search_hotel[0]["Meal"];
                $currency      = $search_hotel[0]["Currency"];
                $price         = $search_hotel[0]["Price"];
                $totalrate     = $search_hotel[0]["TotalRate"];
                $discountdesc  = $search_hotel[0]["DiscountDesc"];
                $importantinfo = $search_hotel[0]["ImportantInfo"];
                $status        = $search_hotel[0]["Status"];
                $hoteljson     = base64_encode(json_encode($search_hotel[0]));
                $input         = $this->input->get();
                $asset['input'] = $input;
                $req = array(
                    "hotel_code" => $search_hotel["HCode"]
                );
                $gambar = $this->hotelavia->searchHotelDetail($req);
            ?>
            <?php } else { ?>
            <?php
            $key = 0;
            $key++;
                $gambarhotel   = $search_hotel['ImageUrl'];
                $hotelname     = $search_hotel["Name"];
                $roomgrade     = $search_hotel["RmGrade"];
                $meal          = $search_hotel["Meal"];
                $currency      = $search_hotel["Currency"];
                $price         = $search_hotel["Price"];
                $totalrate     = $search_hotel["TotalRate"];
                $discountdesc  = $search_hotel["DiscountDesc"];
                $importantinfo = $search_hotel["ImportantInfo"];
                $status        = $search_hotel["Status"];
                $hoteljson     = base64_encode(json_encode($search_hotel));
                $input         = $this->input->get();
                $asset['input'] = $input;
                $req = array(
                    "hotel_code" => $search_hotel["HCode"]
                );
                $gambar = $this->hotelavia->searchHotelDetail($req);
            ?>
            <?php } ?>
            <form id="book-form" method="post" action="<?php echo base_url('hotel/book_now');?>" class="form-inline" data-id="myDiv<?php echo $key+1; ?>">
                
                <div class="productList bevyup_product">       
                        <div class="span5 fleft">
                            <div class="img-wrapper">                                
                                <a class="detail-btn" href="javascript:void(0);" data-row="<?php echo $key+1; ?>" >

                                    <img src="<?php echo $gambar["Hotel"]["HotelImage"][1]['ImageUrl'];?>" alt="" width="100%" height="100%" />

                                </a>
                            </div>
                        </div>

                <div class="span7 fleft productContent">
                    <div class="description-wrapper">
                        <div class="hotel-title">
                            <h2>
                            <a class="detail-btn" href="javascript:void(0);" data-row="<?php echo $key+1; ?>" ><?php echo $hotelname; ?></a>
                            </h2>
                        </div>

                        <div class="hotel-detail detailProduct clearfix">
                         
                            <div class="fleft detail3"><p><?php echo $currency." "; echo number_format($totalrate);  ?></p></div>
                               
                            <div class="fleft">
                                <p>
                                    
                                </p>
                            </div>
                        </div>
                
                        <div class="hotel-detail dl-horizontal" id="post-data">
                            <?php if($roomgrade != '') {?>
                                <dt>Room Grade</dt>
                                <dd><?php echo $roomgrade;?></dd>
                            <?php } ?>

                            <?php if($meal != '') {?><dt>Meal</dt><dd><?php echo $meal;?></dd>
                            <?php } ?>

                            <?php if(empty($discountdesc)) {?>
                            <?php } else {?>
                            <dt>Discount</dt><dd><?php echo $discountdesc;?></dd>
                            <?php } ?>

                            <?php if(empty($importantinfo)) {?>
                            <?php } else {?>
                            <dt>Info</dt><dd><?php echo $importantinfo;?></dd>
                            <?php }?>

                            <?php if(empty($status)) {?>
                            <?php } else {?>
                            <?php }?>
                    </div>
                                        
                        <input id="bookhotel" type="submit" class="button fright" value="Book Now" />
                    </div>

                    <input type="hidden" name="row" value="<?php echo $count; ?>" >
                    <input type="hidden" name="city" value="<?php echo $current_city_code; ?>">
                    <input type="hidden" name="nation" value="<?php echo $countrycode; ?>">
                    <input type="hidden" name="national" value="<?php echo $countrycode; ?>">
                    <input type="hidden" name="checkindate" value="<?php echo date('Y-m-d',strtotime($checkindate)); ?>">
                    <input type="hidden" name="checkoutdate" value="<?php echo date('Y-m-d',strtotime($checkoutdate)); ?>">
                    <input type="hidden" name="single" value="<?php echo $single; ?>">
                    <input type="hidden" name="double" value="<?php echo $double; ?>">
                    <input type="hidden" name="twin" value="<?php echo $twin; ?>">
                    <input type="hidden" name="hotel" value="<?php echo $hoteljson; ?>">
                    <input type="hidden" name="hotelcode" value="<?php echo $hotel_code ;?>" />
                    <input type="hidden" name="regionlabel" value="<?php echo $region_label ;?>" />
                    <input type="hidden" name="city_id" value="<?php echo $city_id ?>">
                    <!-- //kirim data untuk mendapatkan room -->
                   <?php if(!empty($this->input->get('hotelname'))) {?>
                
                    <?php } else { ?>
                    <input type="button" id="ajaxBtnRoom" class="button-room" value="view more Room" />
                    <?php } ?>
                </div>
                  <div class="row_fluid clearfix"></div>
                </div> 
            </form>    
                    <!-- SEE ROOM -->
            <div class="se-pre-con aaa"></div>
            <div class="toggle-room clearfix" id="myDiv<?php echo $key+1; ?>">
                <div class="loader-room"></div>
                <div class="hotel-room">
                    
                    <div id="div1" class="showRoomBtn1" ">
                      
                    </div>
                </div> <!-- tag tutup Hotel Room -->
            </div> <!-- tag tutup Toggle Room -->
                                              
            </div>    
        </div>
    </div>
                <?php } ?>

       

<div class="loader-test"></div>

<script type="text/javascript">
$('.form-inline').hide();
for(i=1;i<=10;i++) {
    $('.form-inline input[value="' + (i) + '"]').parents('.form-inline').show();
}
    
    $( function() {
        var myVar;

        $('#search').on('click',function(){
            $('.onload').fadeIn();
            $('.loader').fadeIn();
            $('.blockMain').fadeIn();
        })
        

        function myFunction() {
            myVar = setTimeout(showPage, 10000);
        }
        function showPage() {
         $('.loader-room').fadeOut();
          document.getElementById("myDiv").style.display = "block";
        }
        function slider_init(min_price, max_price){
          // Slider Filter Price
          $('#slider-range').slider({
            range: true,
            min:min_price,
            max:max_price,
            step:1,
            values:[min_price, max_price],
            slide: function(event, ui) {
              $('.min.price span').text(formatNumber(ui.values[ 0 ]));
              $('.max.price span').text(formatNumber(ui.values[ 1 ]));
              $('input[name=min_price]').val(ui.values[ 0 ]);
              $('input[name=max_price]').val(ui.values[ 1 ]);
            },
            change: function(event, ui){
            }
          });
          $('.min.price span').text(formatNumber($( "#slider-range" ).slider( "values", 0 )));
          $('.max.price span').text(formatNumber($( "#slider-range" ).slider( "values", 1 )));
          $('input[name=min_price]').val($( "#slider-range" ).slider( "values", 0 ));
          $('input[name=max_price]').val($( "#slider-range" ).slider( "values", 1 ));
          // Slider Filter Price
        }

        var dateFormat = "dd-mm-yy",
          from = $( "#checkindate" )
            .datepicker({
              minDate: 0,
              dateFormat: "dd-mm-yy",
              numberOfMonths: 2
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = $( "#checkoutdate" ).datepicker({
            dateFormat: "dd-mm-yy",
            <?php
            if ($checkoutdate != ''){
              echo 'minDate: "'. date('d-m-Y', strtotime($checkindate . ' +1 day')) .'",';
            }
            else {
              echo '';
            }
            ?>
            numberOfMonths: 2
          });
     
        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }
          date = new Date(date);
          newdate = new Date(date.setDate(date.getDate() + 1));
          return newdate.getDate() + '-' + (parseInt(newdate.getMonth()) + 1) + '-' + newdate.getFullYear();
        }

        $('#search_form').validate({
          submitHandler: function(form) {
            if($('#single').val() == 0 && $('#double').val() == 0 && $('#twin').val() == 0) {
              $('#single').val('1').trigger('change');
            }
            $('#search').val('Please Wait ...');
            $('#search').prop('disabled', true);
            form.submit();
          }
        });

    });
    $(window).scroll(function() {

        if($(window).scrollTop() + $(window).height() >= $(document).height()) {

            page++;

            loadMoreData(page);

        }

    });

</script>
<script type="text/javascript">
// $(document).ready(function() {
//     $('#nation').change(function() {
//         var nationCode = $('[name=\'nation\']').val();

//         $.ajax({
//             url: "<?php echo base_url('hotel')?>/getCity",
//             type: 'post',
//             dataType: 'html',
//             data: {
//                 nation_code : nationCode 
//             },

//             success: function(json) {
//                 $('#city').html(json);
                
//                 if (json['error']) {
//                     $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
//                 }

//                 if (json['success']) {
//                     $(node).parent().find('input').attr('value', json['code']);
//                 }
//             },
 
//         });
//     });


// });
</script>

<!-- ajax javascript untuk ngepost data room -->
<script type="text/javascript">
$(document).ready(function(){
    $('.toggle-room').hide();

    $('.button-room').click(function(){


        productContent = $(this).parents('.form-inline');
        hotelRoom      = productContent.siblings('.toggle-room');
        dataid         = productContent.attr('data-id');
        
        if(!$('#'+dataid).is(":visible")){
            $('.loader-room').css("display", "block");
        }
       
       var nationalCode      = $(this).parent().find('input[name=\'national\']').val();
       var nationCode        = $(this).parent().find('input[name=\'nation\']').val();
       var CityCode          = $(this).parent().find('input[name=\'city\']').val();
       var checkindate       = $(this).parent().find('input[name=\'checkindate\']').val();
       var checkoutdate      = $(this).parent().find('input[name=\'checkoutdate\']').val();
       var single            = $(this).parent().find('input[name=\'single\']').val();
       var double            = $(this).parent().find('input[name=\'double\']').val();
       var twin              = $(this).parent().find('input[name=\'twin\']').val();
       var room_code_hotel   = $(this).parent().find('input[name=\'hotelcode\']').val();
       var data_hotel_room   = $(this).parent().find('input[name=\'data_hotel\']').val();
       var regionlabel       = $(this).parent().find('input[name=\'regionlabel\']').val();
       var countrycode       = $(this).parent().find('input[name=\'countrycode_forhotel\']').val();
       var city_id           = $(this).parent().find('input[name=\'city_id\']').val();
       
 
       $('#'+dataid).slideToggle(1000);

        if($(this).hasClass('nores')) return true;
        $(this).addClass('nores');

        $.ajax({
            url: "<?php echo base_url('hotel/getHotelRoom')?>",
            type: 'POST',
            dataType: 'html',
            data: 
            {   
            	city_id       : city_id,
                nation_code   : nationCode,
                national_code : nationCode,
                city          : CityCode,
                checkindate   : checkindate,
                checkoutdate  : checkoutdate,  
                single        : single,
                double        : double,
                twin          : twin,
                hotel_code    : data_hotel_room,
                room_code     : room_code_hotel,
                regionlabel   : regionlabel,
            },
            error: function(error) {
              console.log('error');
          }
        }).done(function(data){
           $('#'+dataid).html(data);
       }).fail(function(jqXHR, textStatus){
           alert('Error occured: ' + textStatus);
       });
     // }
    });
});
</script>
<script type="text/javascript">
$(function(){
    $( "#input_hotel_label_main" ).autocomplete({
        //source:  base_url + 'hotel/search_hotel/',
        source: function (request, response) {
            console.log(response);
            var ajaxes=[]
             function killAjaxes(){
                $.each(ajaxes,function(i,ajax){
                    ajax.abort()
                })
            }
            ajaxes=[
                        $.getJSON(base_url + 'hotel/search_region/', request, response),
                        $.getJSON(base_url + 'hotel/search_hotel/', request, response)
                    ]
        $.when.apply(0,ajaxes).then(function() {
                        response(Array.prototype.map.call(arguments, function(res) {
                            return res[0]
                        }).reduce(function(p, c) {
                            return p.concat(c)
                        }))
                    })
                },
                select:function(ui,result){
                console.log(result)
                $(".input-hotel-main").val(result.item.label); // display the selected text
                $("#input-hotel-ccode").val(result.item.ccode); // save selected id to hidden input
                $("#input-hotel-hcode").val(result.item.hcode); // save selected id to hidden input
                $("#input-hotel-label").val(result.item.label);
                $("#input-hotel-rgncode").val(result.item.rgncode);
                $("#input-city-label").val(result.item.label);
                $("#input-city-nlcode").val(result.item.nlcode);
                $("#input-city-ncode").val(result.item.nlcode);
                $("#input_city_id").val(result.item.hotelcity_id);
            return false;
            },
            minLength: 1
        });
    });
</script>
<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sort_by').click(function() {

        var minprice = $('[name=\'minprice\']').val();
        var maxprice = $('[name=\'maxprice\']').val();
        $.ajax({
            url: "<?php echo base_url('hotel/searching')?>",
            type: 'post',
            dataType: 'html',
            data: {minprice : minprice,
                   maxprice : maxprice, },
        beforeSend : function(){
          loading();
        },
        success: function(data) {

            },
        });
    });


});
  function loading() {
    var html = '<div class="voucher-loading"><span>Loading...</span></div>';
    $(html).insertAfter('.sort');
    var itemNo = 0;
  }
</script>

