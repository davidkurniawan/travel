<style type="text/css">
#checkindate,
#checkoutdate {
    background: #fff;
    cursor: pointer;
    caret-color: transparent;

}
.ui-menu {
    list-style: none;
    padding: 2px;
    margin: 0;
    display: block;
    float: left;
    max-height: 300px;
    overflow-y: scroll;
</style>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        load_options('', 'COUNTRY');
    });

    

    function load_options(id, index) {

        var ajax_path = "<?php echo base_url('attraction/process_data'); ?>";
        

        //$("#loading").show();
        
        $.ajax({
            url : ajax_path, 
            //localCache:true,
            data:{index:index,id:id},
            //cache:false,
            //cacheTTL: 6,
            type: 'POST',
            success : function(data) {
                
                $("#" + index).html(data);
                
                if($('#COUNTRY option:selected').val() && $('#REGION option:selected').val()==''){
                    
                        load_options2($('#COUNTRY option:selected').val(),'CITY');
                }

                if(data==""){
                    $("#" + index + "_BOX").fadeOut();
                }else{
                    $("#" + index + "_BOX").fadeIn();
                }

            }
        })
        return true;
    }


    function load_options2(id, index) {

        var ajax_path = "<?php echo base_url('attraction/process_data'); ?>";
        var flag = 0;

        //$("#loading").show();
        
        $.ajax({
            url : ajax_path, 
            //localCache:true,
            data:{index:index,id:id},
            //cache:false,
            //cacheTTL: 6,
            type: 'POST',
            success : function(data) {
                
                $("#" + index).html(data);

            }
        })
        return true;
    }

    if($('#REGION option:selected').val()==''){
        $('#COUNTRY').attr('onchange',"load_options(this.value,'REGION');load_options(this.value,'CITY');");
    }
    
    $(document).on('submit','#search_form',function( event ){
    
          var v = $('#COUNTRY').val();
          
          if(v==''){
            alert("choose country please");
            return false;
          }
          
          
    });
    
    
    
    
    var a,b;
    
    $('#COUNTRY').live('change',function(){
        // convert string to url (delete space / & into _ )
        var country_temp = $('#COUNTRY option:selected').text().toLowerCase().replace(/[^\w ]/g,'').replace(/ +/g,'_');
        a = country_temp;
        
        if(country_temp =="select_country"){
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>');
        }
        else{
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>/'+country_temp);
        }
         
    });
    
     $('#REGION').live('change',function(){
        // convert string to url (delete space / & into _ )
        var region_temp = $('#REGION option:selected').text().toLowerCase().replace(/[^\w ]/g,'').replace(/ +/g,'_');
        b = region_temp;
        
        if(region_temp =="select_region"){
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>/'+a);
        }
        else{
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>/'+region_temp);
        }
        
        
        
    });
    
    $('#CITY').live('change',function(){
        // convert string to url (delete space / & into _ )
        var city_temp = $('#CITY option:selected').text().toLowerCase().replace(/[^\w ]/g,'').replace(/ +/g,'_');
        
        if(city_temp =="select_city"){
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>/'+b);
        }
        else{
            $("#search_form").attr('action','<?php echo base_url("extra_package/attraction"); ?>/'+city_temp);
        }
        
    });
    
    
    
    
    
</script> -->

<div class="container">
    <div class="row-fluid">
        <div class="span12 mainContent">
            <form id="search_form" action="<?php echo base_url('hotel/searching');?>" method="get">
            
                <div class="stepForm hotelSearch clearfix">
                    <h2 class="EDEDEDTitle">Hotel Search</h2>
                    <div class="row-fluid">
                        <!-- SELECT AREA -->
                        <div class="span6">
                        <?php /*
                            <!-- <div id="REGION_BOX">
                                <label>Select Nationality</label>
                                <div class="outer_select">
                                    <select id="national" class="select_region right-arrowed" name="national">
                                        <option value="">-Select National-</option>
                                        <?php if($nations){
                                            ?>
                                            <?php foreach($nations as $key => $nation){?>
                                                <option value="<?php echo $nation['NationCode'] ?>"><?php echo $nation['NationName'] ?></option>
                                            <?php } ?>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                                
                            <div>
                                <label>Select Country</label>
                                <div class="outer_select">
                                    <select id="nation" class="select_country right-arrowed" name="nation">
                                        <option value="">-Select Nations-</option>
                                        <?php if($nations){ 
                                            ?>
                                            
                                            <?php foreach($nations as $key => $nation){?>
                                                <option value="<?php echo $nation['NationCode'] ?>"><?php echo $nation['NationName'] ?></option>
                                            <?php } ?>
                                        <?php }?>
                                    </select>
                                </div>
                            </div> -->
                            <!--input kota asal-->
                            <!--  <div id="REGION_BOX">
                                <label for="input_region_main">Search Country/City</label>
                                <div class="outer_select">
                                    <input id="input_region_main" type="text" name="input_region_main" class="input-city-main text-form search-group" placeholder="Negara Tujuan/ Kota" data-msg-required="Kota/Tujuan tidak boleh kosong!">
                                    <input id="input-city-rgncode" type="hidden" name="city">
                                    <input id="input-city-label" type="hidden" name="city_label">
                                    <input id="input-city-ncode" type="hidden" name="nation">
                                    <input id="input-city-nlcode" type="hidden" name="national">
                                </div>
                             <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div> 
                            </div> -->*/ ?>

                            <!-- input hotel -->
                            <div>
                                <label for="input_hotel_label_main">Search Hotel Name</label>
                                <div class="outer_select">
                                    <input id="input_hotel_label_main" type="text" name="input_hotel_label_main" class="input-hotel-main text-form search-group" placeholder="Nama Hotel" data-msg-required="Kota/Tujuan tidak boleh kosong!">
                                    <input id="input-hotel-label" type="hidden" name="hotel_label">
                                    <input id="input-hotel-hcode" type="hidden" name="hotelcode">
                                    <input id="input-hotel-ccode" type="hidden" name="countrycode">
                                    <input id="input-hotel-rgncode" type="hidden" name="city">
                                    <input id="input-city-label" type="hidden" name="city_label">
                                    <input id="input-city-ncode" type="hidden" name="nation">
                                    <input id="input-city-nlcode" type="hidden" name="national">
                                    <input id="input-city-id" type="hidden" name="city_id">
                                </div>
                            </div> 

                            <!-- SELECT DATE -->
                        
                            <div class="col-md-6" style="padding-left: 0px;">
                                <label for="checkindate" >Check In</label>
                                <div class="form-inline">
                                    <input type="text" name="checkindate" id="checkindate" class="form-control required" value="<?php echo $checkindate ?>" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="col-md-6" style="padding-right: 0px;">
                                <label for="checkoutdate">Check Out</label>
                                <div class="form-inline">
                                    <input type="text" name="checkoutdate" id="checkoutdate" class="form-control required" value="<?php echo $checkoutdate ?>" readonly="readonly"/>
                                </div>
                            </div>
                        <?php /*
                            <!-- <div id="CITY_BOX">
                                <label>Select City</label>
                                <div class="outer_select">
                                    <select id="city" class="select_city right-arrowed" name="city" >
                                        <option value="">-Select City-</option>
                                    </select>
                                </div>
                            </div> -->
                            */ ?>
                        <div>
                           <img src="images/loader.gif" id="loading" align="absmiddle" style="display:none;"/> 
                        </div>
                        
                        </div>

                        
                        
                        <!-- SELECT ADULT BY ROOM -->
                        <div class="span6">
                            <?php /*
                            <div class="col-md-6">
                                <label for="single">Adults</label>
                                <div class="form-group outer_select">
                                    <!-- <input type="number" name="single" id="single" class="form-control required"/> -->
                                    <select name="single" id="single" class="form-control right-arrowed required">
                                        <?php for($i=1;$i<=6;$i++){
                                            $selected = ($i==1 ? 'selected="selected"' : '');
                                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="single">Rooms</label>
                                <div class="form-group outer_select">
                                    <!-- <input type="number" name="single" id="single" class="form-control required"/> -->
                                    <select name="single" id="single" class="form-control right-arrowed required">
                                        <?php for($i=1;$i<=6;$i++){
                                            $selected = ($i==1 ? 'selected="selected"' : '');
                                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>*/?>

                            <div class="col-md-4">
                                <label for="single">Single</label>
                                <div class="form-group outer_select">
                                    <!-- <input type="number" name="single" id="single" class="form-control required"/> -->
                                    <label class="avia-select">
                                    <select name="single" id="single" class="required">
                                        <?php for($i=0;$i<=6;$i++){
                                            /*if($i==1 && $input['dewasa'] == '')
                                            {
                                              $selected = 'selected="selected"';  
                                            }
                                            elseif($input['dewasa'] != '' && $i == $input['dewasa'])
                                            {
                                              $selected = 'selected="selected"'; 
                                            }
                                            else
                                            {
                                              $selected = '';
                                            }*/
                                            $selected = ($i==0 ? 'selected="selected"' : '');
                                            echo '<option value="'.$i.'" >'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="double">Double</label>
                                <div class="form-group outer_select">
                                    <!-- <input type="number" name="double" id="double" class="form-control right-arrowed required"/> -->
                                    <select name="double" id="double" class="form-control right-arrowed required">
                                        <?php for($i=0;$i<=6;$i++){
                                            /*if($i==1 && $input['dewasa'] == '')
                                            {
                                              $selected = 'selected="selected"';  
                                            }
                                            elseif($input['dewasa'] != '' && $i == $input['dewasa'])
                                            {
                                              $selected = 'selected="selected"'; 
                                            }
                                            else
                                            {
                                              $selected = '';
                                            }*/
                                            $selected = '';
                                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="twin">Twin</label>
                                <div class="form-group outer_select">
                                    <!-- <input type="number" name="twin" id="twin" class="form-control right-arrowed required"/> -->
                                    <select name="twin" id="twin" class="form-control right-arrowed required">
                                        <?php for($i=0;$i<=6;$i++){
                                            /*if($i==1 && $input['dewasa'] == '')
                                            {
                                              $selected = 'selected="selected"';  
                                            }
                                            elseif($input['dewasa'] != '' && $i == $input['dewasa'])
                                            {
                                              $selected = 'selected="selected"'; 
                                            }
                                            else
                                            {
                                              $selected = '';
                                            }*/
                                            $selected = '';
                                            echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input id="search" type="submit" class="button pull-right" style="margin-top: 12px;margin-right: 14px" value="SEARCH" />
                        </div>

                        <div class="span6">
                            <div class="col-md-12">
                            <?php echo $this->session->flashdata('No_available_hotels'); ?>
                                <?php echo $this->session->flashdata('type_room_error'); ?>
                                <?php echo $this->session->flashdata('booking_alowed'); ?>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<style type="text/css">
    /*#single, #double, #twin {
        height: 30px;
    }*/
    input[type="number"]:focus {
        border: 1px solid #fdb813 !important;
        box-shadow: 0px 0px 1px 0px #fbc137 !important;
    }
    label.error {
        color: red;
        /*position: absolute;*/
        bottom: -15px;
        /* right: 10px; */
        font-size: 13px;
        text-transform: none;
    }
    .right-arrowed{
        -moz-appearance: none;
        -webkit-appearance: none;
        background: none repeat scroll 0 0 transparent;
        border: medium none;
        height: 31px;
        margin-top: 1px;
        padding: 0 35px 0 2px;
        text-overflow: ellipsis;
        width: 100% !important;
    }
</style>

<script type="text/javascript">
$(document).ready(function() {
    $('#nation').change(function() {
        var nationCode = $('[name=\'nation\']').val();

        $.ajax({
            url: "<?php echo base_url('hotel')?>/getCity",
            type: 'post',
            dataType: 'html',
            data: {nation_code : nationCode },
            success: function(json) {
                $('#city').html(json);
                
                if (json['error']) {
                    $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $(node).parent().find('input').attr('value', json['code']);
                }
            },
        });
    });
});
</script>

<script type="text/javascript">
    $( function() {

        var dateFormat = "dd-mm-yy",
          from = $( "#checkindate" )
            .datepicker({
              minDate: 0,
              dateFormat: "dd-mm-yy",
              //changeMonth: true,
              numberOfMonths: 2
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = $( "#checkoutdate" ).datepicker({
            dateFormat: "dd-mm-yy",
            <?php
            /*if ($pulang != ''){
              echo 'minDate: "'.$pergi.'",';
            }
            else {
              echo '';
            }*/
            ?>
            //changeMonth: true,
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
          // console.log(newdate.getDate() + '-' + (parseInt(newdate.getMonth()) + 1) + '-' + newdate.getFullYear());
          return newdate.getDate() + '-' + (parseInt(newdate.getMonth()) + 1) + '-' + newdate.getFullYear();
        }

        /*$('#search_form').validate();*/

        $('#search_form').validate({
            rules : {
                input_region_main:{
                    require_from_group: [1, ".search-group"] 
                },
                input_hotel_label_main:{
                    require_from_group: [1, ".search-group"]
                }
            },

          submitHandler: function(form) {
            if($('#single').val() == 0 && $('#double').val() == 0 && $('#twin').val() == 0) {
              //$('#single').val('1').trigger('change');
            }
            form.submit();
          }
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
                $("#input-city-id").val(result.item.hotelcity_id);
            return false;
            },
            minLength: 1
        });
    });
</script>




