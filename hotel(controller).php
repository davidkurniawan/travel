<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller 
{
    var $table = 'hotel_booking';

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('hotelavia');
    }

    public function index()
    {
        $asset = array(
            'title'   => 'Hotel Booking',
            'js'      => array('jquery.fancyform.min','jquery.validate.min.16','additional-methods.min'),
            'css'     => array('fancyform','api'),
            'web'     => $this->db->get_where('setting', array('flag' => 1))->row_array(),
            'support' => $this->db->get_where('support', array('flag' => 1))->result_array()
        );

        $data['checkindate']  = date('d-m-Y');
        $data['checkoutdate'] = date('d-m-Y', strtotime(date('d-m-Y') . ' +1 day'));

        $data['nations'] = $this->hotelavia->getNation();
        usort($data['nations'], 'cmpcountryhotel');
        
        $this->load->view('template/header', $asset);   
        $this->load->view('template/top');
        $this->load->view('hotel/hotel_view', $data);
        $this->load->view('template/footer');
    }
    public function nohotel()
    {
        
        $asset = array(
            'title'   => 'Hotel Booking',
            'js'      => array('jquery.fancyform.min','jquery.validate.min.16','additional-methods.min'),
            'css'     => array('fancyform','api'),
            'web'     => $this->db->get_where('setting', array('flag' => 1))->row_array(),
            'support' => $this->db->get_where('support', array('flag' => 1))->result_array()
        );
        $data['checkindate']  = date('d-m-Y');
        $data['checkoutdate'] = date('d-m-Y', strtotime(date('d-m-Y') . ' +1 day'));

        $data['nations'] = $this->hotelavia->getNation();
        usort($data['nations'], 'cmpcountryhotel');
        
        $this->load->view('template/header', $asset);   
        $this->load->view('template/top');
        $this->load->view('hotel/no_hotel', $data);
        $this->load->view('template/footer');
    }
    
    public function search_region()
    {
        $param = $this->input->get('term');
        
        $json = array();
        $result_country = array();
        $result_city = array();

        $sql = "(SELECT city_code as `rgncode`, concat(city_name, ', ', country_name) as label, country_code as `nlcode` 
                    FROM `master_region`
                    WHERE city_name LIKE '%". $param ."%'
                    OR country_name LIKE '%". $param ."%')";

        $country = $this->db->query($sql)->result_array();
        
        $temp = array();
        foreach ($country as $value) {
            
            $temp[] = $value;
        }

        header('Content-Type: application/json');
        echo json_encode($temp);
    }

    public function search_hotel()
    {
        $region_code=$this->input->post('region_code');

        $json = array();
        $param = $this->input->get('term');

        $sql = "SELECT hotel_name as label ,hotel_code as hcode, city_code as `rgncode` , country_code as `ccode` ,hotel_city_id as `hotelcity_id`
                    FROM `master_hotel` 
                    WHERE hotel_name LIKE '%" . $param . "%'";
                    if(! empty($region_code)){
                        $sql .= " AND hotel_region_code='{$region_code}'";
        }
        
        $sql .= " GROUP BY hotel_name";
        $result_hotel = $this->db->query($sql)->result_array();

        $temp = array();
        foreach ($result_hotel as $value) {
            $temp[] = $value;
        }

        header('Content-Type: application/json');
        echo json_encode($temp);
    }

    public function getHotelRoom()
    {
        // pre($datadata['city_id']);
        $datadata     = $this->input->post();
        $country_code = $this->input->post('countrycode');
        $nation       = $this->input->post('nation_code');
        $national     = $this->input->post('national_code');
        $checkindate  = date('Y-m-d',strtotime($this->input->post('checkindate')));
        $checkoutdate = date('Y-m-d',strtotime($this->input->post('checkoutdate')));
        $single       = $this->input->post('single');
        $double       = $this->input->post('double');
        $twin         = $this->input->post('twin');
        $city         = $this->input->post('city');
        $room_code    = $this->input->post('hotel_code');
        $hotel_code   = $this->input->post('room_code');
        $regionlabel  = $this->input->post('regionlabel');
        $city_id      = $this->input->post('city_id');

        if(empty($room_code)){

        $req = array(
            'city_id'      => $city_id,
            'nation'       => $nation,
            'national'     => $national,
            'checkindate'  => $checkindate,
            'checkoutdate' => $checkoutdate,
            'single'       => $single,
            'double'       => $double,
            'twin'         => $twin,
            'city'         => $city,
            'hotel_code'   => $hotel_code,
            'regionlabel'  => $regionlabel,
            );

                $hotelroom = $this->hotelavia->hotelSearch($req);

            } else {

               $req = array(
            'city_id'      => $city_id,
            'nation'       => $nation,
            'national'     => $national,
            'checkindate'  => $checkindate,
            'checkoutdate' => $checkoutdate,
            'single'       => $single,
            'double'       => $double,
            'twin'         => $twin,
            'city'         => $city,
            'hotel_code'   => $room_code,
            'regionlabel'  => $regionlabel,
            ); 
               $hotelroom = $this->hotelavia->hotelSearch($req);
            }
               $hotelroom = $this->array_sort($hotelroom['Hotel'], 'TotalRate', SORT_ASC);
            if(!empty($datadata['country_code'])){

                $data["customerdata"]["city"]         = $datadata["city"];
                $data["customerdata"]["nation"]       = $datadata["country_code"];
                $data["customerdata"]["national"]     = $datadata["country_code"];
                $data["customerdata"]["checkindate"]  = date('Y-m-d', strtotime($datadata["checkindate"]));
                $data["customerdata"]["checkoutdate"] = date('Y-m-d', strtotime($datadata["checkoutdate"]));
                $data["customerdata"]["single"]       = $datadata["single"];
                $data["customerdata"]["double"]       = $datadata["double"];
                $data["customerdata"]["twin"]         = $datadata["twin"];

            } else {
                
                $data["customerdata"]["city"]         = $datadata["city"];
                $data["customerdata"]["nation"]       = $datadata["nation_code"];
                $data["customerdata"]["national"]     = $datadata["national_code"];
                $data["customerdata"]["checkindate"]  = date('Y-m-d', strtotime($datadata["checkindate"]));
                $data["customerdata"]["checkoutdate"] = date('Y-m-d', strtotime($datadata["checkoutdate"]));
                $data["customerdata"]["single"]       = $datadata["single"];
                $data["customerdata"]["double"]       = $datadata["double"];
                $data["customerdata"]["twin"]         = $datadata["twin"];

            }

                $html  = '';
                $html .= '<div class="productList bevyup_product nores">';
                $html .= '<div class="wrapTable" style="margin-top: 20px; overflow-y: auto; width: 99%;">';  
                $html .= '<table class="roomHotel tableRoom" width="100%">';
                $html .= '<thead>';
                $html .= '<th>Room Grade</th>';
                $html .= '<th>Meal</th>';
                $html .= '<th>Price Per Room/Night</th>';
                $html .= '<th>Cancelation Policy</th>';
                $html .= '<th style="width: 132px;">Book it</th>';
                $html .= '</thead>';
                $html .= '<tbody>';  
                   
                   
            if($hotelroom[0] == 1){
                    $room_grade = $hotelroom[6];
                    $mealname   = $hotelroom[5];
                    $priceroom  = $hotelroom[3];
                    $curren     = $hotelroom[8];
                    $hotel_name = $hotel_name[13];

                    $html .= '<tr>';
                    $html .= '<td>Out Of Room</td>';
                    $html .= '<td>Out Of Room</td>';
                    $html .= '<td style="color : blue;">Out Of Room</td>';
                    $html .= '<td>Guaranteed Booking</td>';
                    $html .= '<td>Sorry No Available</td>';
                    $html .= '</tr>';
            } else {
                 
            foreach ($hotelroom as $key => $roomhotel){  
                $splycd         = $roomhotel['SplyCd'];
                $availsply      = $roomhotel['AvailSply'];
                $Availsplyhotel = $roomhotel['AvailSplyHotel'];
                $gambarhotel    = $roomhotel['ImageUrl'];
                $hotelname      = $roomhotel["Name"];
                $roomgrade      = $roomhotel["RmGrade"];
                $meal           = $roomhotel["Meal"];
                $currency       = $roomhotel["Currency"];
                $price          = $roomhotel["Price"];
                $totalrate      = $roomhotel["TotalRate"];
                $discountdesc   = $roomhotel["DiscountDesc"];
                $importantinfo  = $roomhotel["ImportantInfo"];
                $status         = $roomhotel["Status"];
                $hoteljson      = base64_encode(json_encode($roomhotel));
           
                // pre($datadata['city_id']);
                $data["hoteldata"] = array(
                                    'MealCd'         => $roomhotel["MealCd"],
                                    'SplyCd'         => $roomhotel["SplyCd"],
                                    'AvailSply'      => $roomhotel["AvailSply"],
                                    'AvailSplyHotel' => $roomhotel["AvailSplyHotel"],
                                    'HCode'          => $roomhotel["HCode"],
                                    'RmGrade'        => $roomhotel["RmGrade"],
                                    );

                $gambar = $this->hotelavia->searchHotelDetail($hotel_detail);
               
                        
                    $html .= '<tr>';
                    $html .= '<td>'.$roomgrade.'</td>';
                    $html .= '<td>' .$meal. '</td>';
                    $html .= '<td style="color : blue;"">' .$currency." ".number_format($totalrate).'</td>';
                    
                        $result_cancel_deadline = $this->hotelavia->hotelSearchCancelDeadline($data);
                        $cancelday = date('d',strtotime($data["customerdata"]["checkindate"])) - $result_cancel_deadline['CXLPolicy']['CXLDay'];
                        $cancelday = strtotime($data["customerdata"]["checkindate"] . "- {$result_cancel_deadline['CXLPolicy']['CXLDay']} days" );

                    if(strtotime(date('dMY')) >= $cancelday){
                        $html .= '<td>Guaranteed Booking</td>';
                        } else {
                        $html .= '<td>Before '.date('d M Y',$cancelday).'</td>';    
                    }

                    $html .= '<td><a class="button bookingv" type="submit" href="'.base_url('hotel/book_now').'?city='.$data["customerdata"]["city"].'&nation='.$data["customerdata"]["nation"].'&national='.$data["customerdata"]["national"].'&checkindate='.date('Y-m-d',strtotime($checkindate)).'&checkoutdate='.date('Y-m-d',strtotime($checkoutdate)).'&single='.$single.'&double='.$double.'&twin='.$twin.'&hotel='.$hoteljson.'&data_hotel='.$roomhotel["HCode"].'&regionlabel='.$regionlabel .'&city_id='.$datadata['city_id'].'">Book Now!</a></td>';
                     
                    $html .= '</tr>'; 
                }
            }

            $html .= '</tbody>';
            $html .= '</div>';
            $html .= '</div>';

            echo $html;
           
    }
    

    public function getCity()
    {
        $nation_code = $this->input->post('nation_code');

        $cities = false;
        if( ! empty($nation_code)) {
            $this->load->library('hotelavia');
            $cities = $this->hotelavia->getCity($nation_code);

            usort($cities, 'cmpcityhotel');
            $html = '';
            foreach($cities as $key => $city) {
                $html .= '<option value="' . $city['CityCode'] . '">' . $city['CityName'] . '</option>';
            }

        }

        echo $html;
    }
    public function getHotelIncity()
    {
        if($nation_code=='') {
            $nation_code = $this->input->post('nation_searchcode');
        }
        
        if($city_code=='') {
            $city_code = $this->input->post('city_searchcode');
        }

        $hotel_incity = $this->hotelavia->getHotel($nation_code, $city_code);

        $html = '';
        foreach ($hotel_incity as $all_hotelincity) {

            $new_row['value']=htmlentities(stripslashes($all_hotelincity['HotelCode']));
            $new_row['label']=htmlentities(stripslashes($all_hotelincity['HotelName']));
            $row_set[] = $new_row;
        }

        echo json_encode($row_set);
    }

    public function search_hotel_by_name(){
        if($nation_code=='') {
            $nation_code = $this->input->post('nation_searchcode');
        }
        
        if($city_code=='') {
            $city_code = $this->input->post('city_searchcode');
        }
    }

    public function searching($page=0)
    {
        $asset = array(
            'title'     => 'Hotel Booking Search', 
            'js'        => array('jquery.fancyform.min', 'jquery.validate.min'), 
            'css'       => array('fancyform', 'api'), 
            'web'       => $this->db->get_where('setting', array('flag' => 1))->row_array(), 
            'support'   => $this->db->get_where('support', array('flag' => 1))->result_array()
        );
        $asset['input'] = $this->input->get();
        $asset['post']  = $this->input->post();
        // pre($asset['input']);
        $data_hotel = array();
       
        if( ! $this->input->get('checkindate') && ! $this->input->get('checkoutdate')) {
            $this->session->set_flashdata('type_room_error', 'You must fill the amount of room!');
            redirect(base_url('hotel'));
        } else {
            // reformat to Y-m-d, due to API requirement
            $asset['input']['checkindate'] = date('Y-m-d', strtotime($this->input->get('checkindate')));
            $asset['input']['checkoutdate'] = date('Y-m-d', strtotime($this->input->get('checkoutdate')));
            
            //room harus lebih dari nol
            if($this->input->get('single') > 0 || $this->input->get('double') > 0 || $this->input->get('twin')){    

            }else{
                $this->session->set_flashdata('type_room_error', 'You must fill the amount of room!');
                redirect(base_url('hotel'));
            }

            if($data_hotel != 'No available hotels'){
                if(empty($asset['input']['hotelcode'])){

                $data_hotel = $this->hotelavia->hotelSearchCity($asset['input']);
                } else {
                    $roomhotel = array(
                        'nation' => $asset['input']['countrycode'],
                        'national' => $asset['input']['countrycode'],
                        'checkindate' => date('Y-m-d',strtotime($asset['input']['checkindate'])),
                        'checkoutdate' => date('Y-m-d',strtotime($asset['input']['checkoutdate'])),
                        'single' => $asset['input']['single'],
                        'double' => $asset['input']['double'],
                        'twin' => $asset['input']['twin'],
                        'city' => $asset['input']['city'],
                        'hotel_code' => $asset['input']["hotelcode"],
                    );
                    $search_hotel = $this->hotelavia->hotelSearch($roomhotel);
                }

            }else{
                $this->session->set_flashdata('No_available_hotels', 'Sorry ,No available hotels');
            }
            
        }
        $city_id      = $asset['input']['city_id'];
        $countrycode  = $asset['input']['countrycode'];
        $hotel_code   = $asset['input']['hotelcode'];
        $hotel_label  = $asset['input']['hotel_label'];
        $region_label = $asset['input']['city_label'];
        $city_name    = $asset['input']['city'];
        $nation       = $asset['input']['nation'];
        $national     = $asset['input']['national'];
        $checkindate  = date('d-m-Y', strtotime($this->input->get('checkindate')));
        $checkoutdate = date('d-m-Y', strtotime($this->input->get('checkoutdate')));
        $single       = $asset['input']['single'];
        $double       = $asset['input']['double'];
        $twin         = $asset['input']['twin'];
        if(empty($asset['input']['regionlabel'])){
        $region_label = $asset['input']['regionlabel'];
            } else {
        $region_label = $asset['input']['input_hotel_label_main'];
        }
                  
        //pagination
        $offset = $this->input->get('per_page');
        $page = ($offset + 100) / 10;

        // pre($_SERVER['QUERY_STRING']) ; untuk melihat url dan membuat paging 
        $config['base_url'] = base_url() . 'hotel/searching?national='.$nation.'&nation='.$nation.'&city='.$city_name.'&checkindate='.$checkindate.'&checkoutdate='.$checkoutdate.'&single='.$single.'&double='.$double.'&twin='.$twin.'&sortHotel='.$asset['input']['sortHotel'];

        $config['total_rows'] = count($data_hotel['Hotel']);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['page_query_string'] = TRUE;
        $limit = $config['per_page'];
        $page = 0;

        //paging display config
        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['full_tag_open'] = '<div class="pagers">';
        $config['full_tag_close'] = '</div>'; 

        /* Added by William */                                                                                       
        if($asset['input']['sortHotel'] === 'maxprice') {
           $data_hotel['Hotel'] = $this->array_sort($data_hotel['Hotel'], 'TotalRate', SORT_DESC);
        }               
        /* Added by William */
         if($asset['input']['sortHotel'] === 'minprice') {
           $data_hotel['Hotel'] = $this->array_sort($data_hotel['Hotel'], 'TotalRate', SORT_ASC);
        }                                

        if(empty($offset)){
            $data['allhotel'] = array_slice($data_hotel['Hotel'], $page, $limit);
        } else {
            $data['allhotel'] = array_slice($data_hotel['Hotel'], $offset, $limit);
        }

        $this->pagination->initialize($config);

        //mengambil semua kota
        $data['city_id']           = $city_id;
        $data['countrycode']       = $countrycode;
        $data['search_hotel']      = $search_hotel['Hotel'];
        $data['city']              = $data_city;
        $data['data_detail']       = $hotel_data;
        $data['hotel_code']        = $hotel_code;
        $data['city']              = $city_name;
        $data['current_city_code'] = $city_name;
        $data['hotel_label']       = $hotel_label;
        $data['current_nation']    = $nation;
        $data['region_label']      = $region_label;
        $data['current_national']  = $national;
        $data['checkindate']       = $checkindate;
        $data['checkoutdate']      = $checkoutdate;
        $data['single']            = $single;
        $data['double']            = $double;
        $data['twin']              = $twin;

        $asset['city_list'] = $data['cities'];
        $asset['nation_list'] = $data['nations'];

        $this->load->view('template/header', $asset);   
        $this->load->view('template/top');
        $this->load->view('hotel/search_view', $data);
        $this->load->view('template/footer');
    }

     private  function salutation(){
        return array( 'MR' => 1, 'MRS' => 2, 'MS' => 3, 'MSTR' => 4, 'MISS' => 5 );
    }

     public function book_now()
    {
        // pre($this->input->get());
        $this->load->model('model_hotel');
        $asset = array(
            'title'     => 'Hotel Booking Customer Form',
            'js'        => array('jquery.fancyform.min','jquery.validate.min'),
            'css'       => array('fancyform','api'),
            'web'       => $this->db->get_where('setting', array('flag' => 1))->row_array(),
            'support'   => $this->db->get_where('support', array('flag' => 1))->result_array()
        );
        $datadata = '';
        $data = '';

        $this->load->library('form_validation');
        /*$config = array(
            array( 'field' => 'contact_first_name', 'label' => 'Firstname', 'rules' => 'trim|required' ),
            array( 'field' => 'contact_last_name', 'label' => 'Lastname', 'rules' => 'trim|required' ),
            array( 'field' => 'contact_email', 'label' => 'Email', 'rules' => 'trim|required|valid_email' ),
            array( 'field' => 'contact_phone', 'label' => 'Phone', 'rules' => 'trim|required' ),
            array( 'field' => 'contact_mobile', 'label' => 'Mobile', 'rules' => 'trim|required' )
        );*/
        $this->form_validation->set_rules('contact_mobile', 'Mobile',  'trim|required' );
        
        $this->form_validation->set_rules('contact_first_name', 'Firstname',  'trim|required' );
        $this->form_validation->set_rules('contact_last_name', 'Lastname',  'trim|required' );
        $this->form_validation->set_rules('contact_email', 'Email',  'trim|required|valid_email' );
        $this->form_validation->set_rules('contact_phone', 'Phone',  'trim|required' );
        $this->form_validation->set_rules('contact_mobile', 'Mobile',  'trim|required' );
            
        if($single > 0){
            for($s =0; $s<$single; $s++) {
                $this->form_validation->set_rules('sex-single-'.$s, 'Gender', 'required');
                $this->form_validation->set_rules('first-single-'.$s, 'Firstname', 'required');
                $this->form_validation->set_rules('last-single-'.$s, 'Lastname', 'required');
            }
        }

        if($double > 0){
            for($d =0; $d<$double; $d++) {
                $this->form_validation->set_rules('sex-double-'.$d, 'Gender', 'required');
                $this->form_validation->set_rules('first-double-'.$d, 'Firstname', 'required');
                $this->form_validation->set_rules('last-double-'.$d, 'Lastname', 'required');
            }
        }

        if($twin > 0){
            for($t =0; $t<$twin; $t++) {
                $this->form_validation->set_rules('sex-twin-'.$t, 'Gender', 'required');
                $this->form_validation->set_rules('first-twin-'.$t, 'Firstname', 'required');
                $this->form_validation->set_rules('last-twin-'.$t, 'Lastname', 'required');
            }
        }

        if($this->form_validation->run() == TRUE)
        {       
            $datadata   = $_POST;

            $data = array();
            $data["hoteldata"] = json_decode(base64_decode($datadata["hotel"]), true);
            
            $data["customerdata"]["city"] = $datadata["city"];
            $data["customerdata"]["nation"] = $datadata["nation"];
            $data["customerdata"]["national"] = $datadata["national"];
            $data["customerdata"]["checkindate"] = date('Y-m-d', strtotime($datadata["checkindate"]));
            $data["customerdata"]["checkoutdate"] = date('Y-m-d', strtotime($datadata["checkoutdate"]));
            $data["customerdata"]["name"] = $datadata["contact_first_name"].' '.$datadata["contact_last_name"];
            $data["customerdata"]["email"] = $datadata["contact_email"];
            $data["customerdata"]["phone"] = $datadata["contact_phone"];
            $data["customerdata"]["mobile"] = $datadata["contact_mobile"];
            $data["customerdata"]["single"] = $datadata["single"];
            $data["customerdata"]["double"] = $datadata["double"];
            $data["customerdata"]["twin"] = $datadata["twin"];

            $datadata['city_list'] ='';
            $datadata['nation_list'] = '';

            if ($datadata["single"] > 0){
                for ($i=0; $i<$datadata["single"]; $i++) {
                    $data["customerdata"]["sex-single-".$i] = $datadata["sex-single-".$i];
                    $data["customerdata"]["local-single-".$i] = $datadata["local-single-".$i];
                    $data["customerdata"]["first-single-".$i] = $datadata["first-single-".$i];
                    $data["customerdata"]["last-single-".$i] = $datadata["last-single-".$i];
                }
            }

            if ($datadata["double"] > 0){
                for ($i=0; $i<$datadata["double"]*2; $i++) {
                    $data["customerdata"]["sex-double-".$i] = $datadata["sex-double-".$i];
                    $data["customerdata"]["local-double-".$i] = $datadata["local-double-".$i];
                    $data["customerdata"]["first-double-".$i] = $datadata["first-double-".$i];
                    $data["customerdata"]["last-double-".$i] = $datadata["last-double-".$i];
                }
            }

            if ($datadata["twin"] > 0){
                for ($i=0; $i<$datadata["twin"]*2; $i++) {
                    $data["customerdata"]["sex-twin-".$i] = $datadata["sex-twin-".$i];
                    $data["customerdata"]["local-twin-".$i] = $datadata["local-twin-".$i];
                    $data["customerdata"]["first-twin-".$i] = $datadata["first-twin-".$i];
                    $data["customerdata"]["last-twin-".$i] = $datadata["last-twin-".$i];
                }
            }


            //  [sex-twin-1] => 1
            // [local-twin-1] => 
            // [first-twin-1] => Rian
            // [last-twin-1] => gositus
            
            // for ($i=0; $i<1*3; $i++) {
            //     $data["customerdata"]["sex-triple-".$i] = 'MR';
            //     $data["customerdata"]["local-triple-".$i] = '';
            //     $data["customerdata"]["first-triple-".$i] = 'Ones'.$i;
            //     $data["customerdata"]["last-triple-".$i] = 'Lukito'.$i;
            // }
            // pre($data);
            $data["agentref"] = time().strlen($datadata["name"]).soundex($datadata["name"]);
            
            //cancel deadline   
            $result_cancel_deadline = $this->hotelavia->hotelSearchCancelDeadline($data);
            //hotel booked

            $result = $this->hotelavia->hotelBooking($data);
            // pre($result);
            

            
            $datadata["agentref"] = time().strlen($datadata["name"]).soundex($datadata["name"]);
            $datadata['BkNo'] = $result['BkNo'];

            if(strtotime(date('dMY')) >= $result['CXLDead']){
                $datadata['CXLDead'] = 'Guaranteed Booking';
            } else {
            $datadata['CXLDead'] = $result['CXLDead'];
             }
            //$c = $hotel->hotelCancelBooking($datadata);
            //$c = $hotel->hotelCheckBooking($datadata);
            
            // unset($data);    
            if(!empty($result)){

                $data['salutations'] = $this->salutation();
                // $this->load->model('model_booking_cp');
                $this->load->model('model_avia');

                $unique_id = unique_id($this->table);
                //-------booking data insert---------
                $booking = array(
                    'unique_id'     => $unique_id,
                    'booking_code'  => $this->model_avia->generate_code(),
                    'date_added'    => date('YmdHis'),
                    'last_modified' => date('YmdHis'),
                    'flag'          => 1
                );
            // pre($booking);
                $this->db->insert('booking', $booking);
                $booking_id = $this->db->insert_id();

                if($booking['unique_id'] != $booking_id){
                    $set_unique['unique_id'] = $booking_id;
                    //$this->db->where('booking_id',$booking_id);
                    //$this->db->update('booking',$set_unique);
                }

                //-------end for booking data insert---------
                // $tata = 'aaa';
                //-------hotel booking data insert-------
                $insert = array(
                    'unique_id'                     => unique_id('hotel_booking'),
                    'booking_code'                  => $result['BkNo'],
                    'booking_date_from'             => $data["customerdata"]["checkindate"],
                    'booking_date_to'               => $data["customerdata"]["checkoutdate"],
                    'hotel_code'                    => $result['HCode'],
                    'agent_reference'               => $result['AgentReference'],
                    'room_grade'                    => $result['RmGrade'],
                    'meal_code'                     => $result['MealCd'],
                    'meal'                          => $data['hoteldata']['Meal'],
                    'currency'                      => $result['Currency'],
                    'total_price'                   => $result['Total'],
                    'cancel_limit_date'             => $result['CXLDead'],
                    'api_status'                    => $result['Status'],
                    'contact_name'                  => $datadata["contact_first_name"].' '.$datadata["contact_last_name"],
                    'contact_email'                 => $datadata["contact_email"],
                    'contact_phone'                 => $datadata["contact_phone"],
                    'contact_mobile'                => $datadata["contact_mobile"],
                    'single'                        => $datadata["single"],
                    'double'                        => $datadata["double"],
                    'twin'                          => $datadata["twin"],
                    'nation'                        => $datadata["nation"],
                    'country_code'                  => $datadata["national"],
                    'city_code'                     => $datadata["city"],
                    'hotel_city_id'                 => $datadata['city_id'],
                    'hotel_name'                    => $data['hoteldata']['Name'],
                    'reservation_time'              => date('Y-m-d H:i:s'),
                    'facilities'                    => serialize($datadata['facilities']),
                    'flag'                          => 1
                );
                  
                $this->db->insert('hotel_booking', $insert);
                $hotel_booking_id = $this->db->insert_id();
                //-------end of flight domestic data insert-------

                //-------booking history insert-------
                $booking_history = array(
                    'unique_id'     => unique_id('booking_history'),
                    'booking_id'    => $booking_id,
                    'status'        => 1,
                    'date_added'    => date('YmdHis'),
                    'note'          => 'New Booking by Customer' // default value
                );

                // if admin is present
                $admin_present = get_admin_name();
                if($admin_present){
                    if($admin_present['admin_id']) $booking_history['added_by']=$admin_present['admin_id'];
                    if($admin_present['admin_name']) $booking_history['note'] = 'New Booking by '.$admin_present['admin_name'];
                }
                $this->db->insert('booking_history', $booking_history);
                //-------end booking history-------

                //-------booking detail insert-------
                $booking_detail = array(
                    'unique_id'     => unique_id('booking_detail'),
                    'booking_id'    => $booking_id,
                    'item_type'     => 9,
                    'item_id'       => $hotel_booking_id,
                    'date_added'    => date('YmdHis'),
                    'last_modified' => date('YmdHis')
                );
                $this->db->insert('booking_detail', $booking_detail);
                //-------end of booking detail insert-------

                //-------hotel booking detail insert-------
                $convert_salutation = $this->salutation();
                if ($datadata['single'] > 0){
                    for ($i=0; $i<$datadata["single"]; $i++) {
                        /*$customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-single-".$i]],$datadata["first-single-".$i],'',$datadata["last-single-".$i],'');*/
                        $hotel_booking = array(
                            'unique_id'                     => unique_id('hotel_booking_detail'),
                            'hotel_booking_id'              => $hotel_booking_id,
                            'customer_first_name'           => $datadata["first-single-".$i],
                            'customer_last_name'            => $datadata["last-single-".$i],
                            'salutation'                    => $datadata["sex-single-".$i],
                            'meal'                          => $data['hoteldata']['Meal'],
                            /*'tour_customer_id'              => $customer_id,*/
                            'flag'                          => 1
                        );
                        $this->db->insert('hotel_booking_detail', $hotel_booking);
                    }
                }
                if ($datadata['double'] > 0){
                    for ($i=0; $i<$datadata["double"]*2; $i++) {
                        /*$customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-double-".$i]],$datadata["first-double-".$i],'',$datadata["last-double-".$i],'');*/
                        $hotel_booking = array(
                            'unique_id'                     => unique_id('hotel_booking_detail'),
                            'hotel_booking_id'              => $hotel_booking_id,
                            'customer_first_name'           => $datadata["first-double-".$i],
                            'customer_last_name'            => $datadata["last-double-".$i],
                            'salutation'                    => $datadata["sex-double-".$i],
                            'meal'                          => $data['hoteldata']['Meal'],
                            /*'tour_customer_id'              => $customer_id,*/
                            'flag'                          => 1
                        );
                        $this->db->insert('hotel_booking_detail', $hotel_booking);
                    }
                }
                if ($datadata['twin'] > 0){
                    for ($i=0; $i<$datadata["twin"]*2; $i++) {
                        $customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-twin-".$i]],$datadata["first-twin-".$i],'',$datadata["last-twin-".$i],'');
                        $hotel_booking = array(
                            'unique_id'                     => unique_id('hotel_booking_detail'),
                            'hotel_booking_id'              => $hotel_booking_id,
                            'customer_first_name'           => $datadata["first-twin-".$i],
                            'customer_last_name'            => $datadata["last-twin-".$i],
                            'salutation'                    => $datadata["sex-twin-".$i],
                            'meal'                          => $data['hoteldata']['Meal'],
                            /*'tour_customer_id'              => $customer_id,*/
                            'flag'                          => 1
                        );
                        $this->db->insert('hotel_booking_detail', $hotel_booking);
                    }
                }
            }

            $this->load->view('template/header', $asset);   
            $this->load->view('template/top', $datadata);
            $this->load->view('hotel/result_view', $data);
            $this->load->view('template/footer');
        }


        $post = $this->input->post();
        if(!empty($post)){

            usort($data['nations'], 'cmpcountryhotel');
            $data['city_id']      = $this->input->post('city_id');
            $data['region_label'] = $this->input->post('regionlabel');
            $data['checkindate']  = $this->input->post('checkindate');
            $data['checkoutdate'] = $this->input->post('checkoutdate');
            $data['national']     = $this->input->post('national');
            $data['nation']       = $this->input->post('nation');
            $data['city']         = $this->input->post('city');
            $data['single']       = $this->input->post('single');
            $data['double']       = $this->input->post('double');
            $data['twin']         = $this->input->post('twin');
            $data['triple']       = 1;
            $data['hotel']        = $this->input->post('hotel');
            $data["hoteldata"]   = json_decode(base64_decode($this->input->post('hotel')), true);
            $data['city_list']   = $data['city'];
            $data['nation_list'] = $data['nation'];

        } else {

            usort($data['nations'], 'cmpcountryhotel');
            $data['city_id']      = $this->input->get('city_id');
            $data['region_label'] = $this->input->get('regionlabel');
            $data['checkindate']  = $this->input->get('checkindate');
            $data['checkoutdate'] = $this->input->get('checkoutdate');
            $data['national']     = $this->input->get('national');
            $data['nation']       = $this->input->get('nation');
            $data['city']         = $this->input->get('city');
            $data['single']       = $this->input->get('single');
            $data['double']       = $this->input->get('double');
            $data['twin']         = $this->input->get('twin');
            $data['triple']       = 1;
            $data['hotel']        = $this->input->get('hotel');
            $data["hoteldata"]   = json_decode(base64_decode($this->input->get('hotel')), true);
            $data['city_list']   = $data['city'];
            $data['nation_list'] = $data['nation'];
        }

        $data['salutations'] = $this->salutation();
        $data['facilities']  = $this->model_hotel->get_hotel_facilities();

        $this->load->view('template/header', $asset);   
        $this->load->view('template/top');
        $this->load->view('hotel/book_customer_view', $data);
        $this->load->view('template/footer');
    }
    
    public function booking()
    {
        $asset = array(
            'title'     => 'Hotel Booking Result',
            'js'        => array('jquery.fancyform.min','jquery.validate.min'),
            'css'       => array('fancyform','api'),
            'web'       => $this->db->get_where('setting', array('flag' => 1))->row_array(),
            'support'   => $this->db->get_where('support', array('flag' => 1))->result_array()
        );
        $datadata = $_POST;

        $data = array();
        $data["hoteldata"]                    = json_decode(base64_decode($datadata["hotel"]), true);
        $data["customerdata"]["city"]         = $datadata["city"];
        $data["customerdata"]["nation"]       = $datadata["nation"];
        $data["customerdata"]["national"]     = $datadata["national"];
        $data["customerdata"]["checkindate"]  = date('Y-m-d', strtotime($datadata["checkindate"]));
        $data["customerdata"]["checkoutdate"] = date('Y-m-d', strtotime($datadata["checkoutdate"]));
        $data["customerdata"]["name"]         = $datadata["name"];
        $data["customerdata"]["email"]        = $datadata["email"];
        $data["customerdata"]["phone"]        = $datadata["phone"];
        $data["customerdata"]["mobile"]       = $datadata["mobile"];
        $data["customerdata"]["single"]       = $datadata["single"];
        $data["customerdata"]["double"]       = $datadata["double"];
        $data["customerdata"]["twin"]         = $datadata["twin"];

               
        $datadata['city_list'] = '';
        $datadata['nation_list'] = '';
        

        if ($datadata["single"] > 0){
            for ($i=0; $i<$datadata["single"]; $i++) {
                $data["customerdata"]["sex-single-".$i]   = $datadata["sex-single-".$i];
                $data["customerdata"]["local-single-".$i] = $datadata["local-single-".$i];
                $data["customerdata"]["first-single-".$i] = $datadata["first-single-".$i];
                $data["customerdata"]["last-single-".$i]  = $datadata["last-single-".$i];
            }
        }

        if ($datadata["double"] > 0){
            for ($i=0; $i<$datadata["double"]*2; $i++) {
                $data["customerdata"]["sex-double-".$i]   = $datadata["sex-double-".$i];
                $data["customerdata"]["local-double-".$i] = $datadata["local-double-".$i];
                $data["customerdata"]["first-double-".$i] = $datadata["first-double-".$i];
                $data["customerdata"]["last-double-".$i]  = $datadata["last-double-".$i];
            }
        }

        if ($datadata["twin"] > 0){
            for ($i=0; $i<$datadata["twin"]*2; $i++) {
                $data["customerdata"]["sex-twin-".$i]   = $datadata["sex-twin-".$i];
                $data["customerdata"]["local-twin-".$i] = $datadata["local-twin-".$i];
                $data["customerdata"]["first-twin-".$i] = $datadata["first-twin-".$i];
                $data["customerdata"]["last-twin-".$i]  = $datadata["last-twin-".$i];
            }
        }

        $data["agentref"] = time().strlen($datadata["name"]).soundex($datadata["name"]);
        
        //hotel booked
        $result = $this->hotelavia->hotelBooking($data);

        $datadata['BkNo'] = $result['BkNo'];
        $datadata['CXLDead'] = $result['CXLDead'];

        // unset($data);
        //pre($result);

        if(count($result)>1){
            $unique_id = unique_id($this->table);
            //-------booking data insert---------
            $booking = array(
                'unique_id'     => unique_id('booking'),
                'booking_code'  => $this->model_avia->generate_code(),
                'date_added'    => date('YmdHis'),
                'last_modified' => date('YmdHis'),
                'flag'          => 1
            );
            $this->db->insert('booking', $booking);
            $booking_id = $this->db->insert_id();
            if($booking['unique_id'] != $booking_id){
                $set_unique['unique_id'] = $booking_id;
                $this->db->where('booking_id',$booking_id);
                $this->db->update('booking',$set_unique);
            }
            //-------end for booking data insert---------

            //-------hotel booking data insert-------
            $insert = array(
                'unique_id'                     => unique_id('hotel_booking'),
                'booking_code'                  => $result['BkNo'],
                'booking_date_from'             => $data["customerdata"]["checkindate"],
                'booking_date_to'               => $data["customerdata"]["checkoutdate"],
                'hotel_code'                    => $result['HCode'],
                'agent_reference'               => $result['AgentReference'],
                'room_grade'                    => $result['RmGrade'],
                'meal_code'                     => $result['MealCd'],
                'currency'                      => $result['Currency'],
                'total_price'                   => $result['Total'],
                'cancel_limit_date'             => $result['CXLDead'],
                'api_status'                    => $result['Status'],
                'contact_name'                  => $datadata["name"],
                'contact_email'                 => $datadata["email"],
                'contact_phone'                 => $datadata["phone"],
                'contact_mobile'                => $datadata["mobile"],
                'single'                        => $datadata["single"],
                'double'                        => $datadata["double"],
                'twin'                          => $datadata["twin"],
                'nation'                        => $datadata["nation"],
                'national'                      => $datadata["national"],
                'city'                          => $datadata["city"],
                'reservation_time'              => date('Y-m-d H:i:s'),
                'flag'                          => 1
            );
            $this->db->insert('hotel_booking', $insert);
            $hotel_booking_id = $this->db->insert_id();

            //-------end of flight domestic data insert-------

            //-------booking history insert-------
            $booking_history = array(
                'unique_id'     => unique_id('booking_history'),
                'booking_id'    => $booking_id,
                'status'        => 1,
                'date_added'    => date('YmdHis'),
                'note'          => 'New Booking by Customer' // default value
            );

            // if admin is present
            $admin_present = get_admin_name();
            if($admin_present){
                if($admin_present['admin_id']) $booking_history['added_by']=$admin_present['admin_id'];
                if($admin_present['admin_name']) $booking_history['note'] = 'New Booking by '.$admin_present['admin_name'];
            }
            $this->db->insert('booking_history', $booking_history);
            //-------end booking history-------

            //-------booking detail insert-------
            $booking_detail = array(
                'unique_id'     => unique_id('booking_detail'),
                'booking_id'    => $booking_id,
                'item_type'     => 9,
                'item_id'       => $hotel_booking_id,
                'date_added'    => date('YmdHis'),
                'last_modified' => date('YmdHis')
            );
            $this->db->insert('booking_detail', $booking_detail);
            //-------end of booking detail insert-------

            //-------hotel booking detail insert-------
            $convert_salutation = $this->salutation();
            if ($datadata['single'] > 0){
                for ($i=0; $i<$datadata["single"]; $i++) {
                    /*$customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-single-".$i]],$datadata["first-single-".$i],'',$datadata["last-single-".$i],'');*/
                    $hotel_booking = array(
                        'unique_id'                     => unique_id('hotel_booking_detail'),
                        'hotel_booking_id'              => $hotel_booking_id,
                        'customer_first_name'           => $datadata["first-single-".$i],
                        'customer_last_name'            => $datadata["last-single-".$i],
                        'customer_gender'               => $convert_salutation[$datadata["sex-single-".$i]],
                        /*'tour_customer_id'            => $customer_id,*/
                        'flag'                          => 1
                    );
                    $this->db->insert('hotel_booking_detail', $hotel_booking);
                }
            }
            if ($datadata['double'] > 0){
                for ($i=0; $i<$datadata["double"]*2; $i++) {
                    /*$customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-double-".$i]],$datadata["first-double-".$i],'',$datadata["last-double-".$i],'');*/
                    $hotel_booking = array(
                        'unique_id'                     => unique_id('hotel_booking_detail'),
                        'hotel_booking_id'              => $hotel_booking_id,
                        'customer_first_name'           => $datadata["first-double-".$i],
                        'customer_last_name'            => $datadata["last-double-".$i],
                        'customer_gender'               => $convert_salutation[$datadata["sex-double-".$i]],
                        /*'tour_customer_id'            => $customer_id,*/
                        'flag'                          => 1
                    );
                    $this->db->insert('hotel_booking_detail', $hotel_booking);
                }
            }
            if ($datadata['twin'] > 0){
                for ($i=0; $i<$datadata["twin"]*2; $i++) {
                    /*$customer_id = $this->model_avia->new_customer($convert_salutation[$datadata["sex-twin-".$i]],$datadata["first-twin-".$i],'',$datadata["last-twin-".$i],'');*/
                    $hotel_booking = array(
                        'unique_id'                     => unique_id('hotel_booking_detail'),
                        'hotel_booking_id'              => $hotel_booking_id,
                        'customer_first_name'           => $datadata["first-twin-".$i],
                        'customer_last_name'            => $datadata["last-twin-".$i],
                        'customer_gender'               => $convert_salutation[$datadata["sex-twin-".$i]],
                        /*'tour_customer_id'              => $customer_id,*/
                        'flag'                          => 1
                    );
                    $this->db->insert('hotel_booking_detail', $hotel_booking);
                }
            }
                //$flight_booking_id = $this->db->insert_id();
            //-------end of hotel booking detail insert-------

            /*//------contact data insert--------
            $contact = array(
                'unique_id'             => unique_id('booking_cp'),
                'booking_id'            => $booking_id,
                // 'salutation'            => $convert_salutation[$title],
                'customer_firstname'    => strtoupper($datadata["name"]),
                // 'customer_lastname'     => strtoupper($lastname),
                'birth_date'            => birthdate_check(date('Y-m-d', strtotime($birth))),
                'handphone'             => isset($datadata["mobile"]) ? $datadata["mobile"] : '' ,
                'email'                 => $datadata["email"],
                'date_added'            => date('YmdHis'),
                'last_modified'         => date('YmdHis'),
                'flag'                  => 1
            );
            $contact_check = $this->db->query("SELECT * FROM tour_customer WHERE LOWER(TRIM(customer_firstname)) = LOWER(TRIM('{$datadata["name"]}'))  AND LOWER(TRIM(customer_lastname)) = LOWER(TRIM('{$lastname}')) AND flag !=3 AND birth_date = '".birthdate_check($birth)."'")->row_array();
            if(isset($data['tour_customer_id']) && !empty($data['tour_customer_id'])){
                $contact['tour_customer_id'] = $data['tour_customer_id'];
                $contact['cp_type'] = $data['customer_type'];
            }elseif($contact_check){
                $contact['tour_customer_id'] = $contact_check['tour_customer_id'];
            }else{
                $customer = array(
                    'unique_id'             => unique_id('tour_customer'),
                    'customer_type'         => 3,
                    'salutation'            => $data['contact_title'],
                    'customer_firstname'    => strtoupper($nama_pesan),
                    'customer_lastname'     => strtoupper($lastname),
                    'email'                 => $email,
                    'birth_date'            => birthdate_check(date('Y-m-d', strtotime($birth))),
                    'home_phone'            => $phone,
                    'date_added'            => date('YmdHis'),
                    'last_modified'         => date('YmdHis'),
                    'flag'                  => 1
                );
                $this->db->insert('tour_customer', $customer);
                $contact['tour_customer_id'] = $this->db->insert_id();
            }
            $this->db->insert('booking_cp', $contact);
            //-----end of contact data insert-------*/
        }


        //$this->load->view('customerform');
        $this->load->view('template/header', $asset);   
        $this->load->view('template/top', $datadata);
        $this->load->view('hotel/result_view', $data);
        $this->load->view('template/footer');
    }

   
    //function controll untuk mengupdate country/nations(JANGAN DI HAPUS)
    // public function ambil_datacountry()
    // {   
    //     $this->load->model('model_data');
    //     $data['nations'] = $this->hotelavia->getNation();
    //     $this->load->view('hotel/data', $data);
    // }
    // public function ambil_data()
    // {
    //     $this->load->model('model_data');
    //     $asset['post']  = $this->input->post();

    //     foreach ($asset['post']['name_code'] as $key => $value) {
    //     $data = array(
    //         'unique_id'   => unique_id('hotel_country'),
    //         'nation_name' => $value,
    //         'nation_code' => $key,
    //         'flag'        => 1
    //         );
    //     $this->model_data->input_data($data, 'hotel_country');
        
    //     }
    //     redirect('hotel/ambil_datacountry');
    // }

    // //FUNCTION UNTUK MENGUPDATE CITY (JANGAN DI HAPUS)
    // public function ambil_datacity()
    // {   
    //     $this->load->model('model_data');
    //     $nation_code =  GB;
    //     $data['city'] = $this->hotelavia->getCity($nation_code);
    //     $this->load->view('hotel/data_city', $data);
    // }
    // public function ambil_data()
    // {
    //     $this->load->model('model_data');
    //     $asset['post']  = $this->input->post();
    //     $nation_code = GB;
    //     foreach ($asset['post']['name_code'] as $key => $value) {
    //     $data = array(
    //         'unique_id'                 => unique_id('hotel_city'),
    //         'hotel_city_name'           => $value,
    //         'hotel_city_code'           => $key,
    //         'hotel_city_parent'         => $nation_code,
    //         'master_city_is_searchable' => 1,
    //         'flag'                      => 1
    //         );
    //     $this->model_data->input_data($data, 'hotel_city');
        
    //     }
    //     redirect('hotel/ambil_datacity');
    // }

    // //FUNCTION UNTUK MENGAMBIL SEMUA DATA HOTEL ,NEGARA DAN DI KOTA 
    // public function ambil_datahotel()
    // {   

    //     $this->load->model('model_data');
    //     $nation_code = ZW;
    //     // $city_code = SBO;
    //     $cities = $this->hotelavia->getHotel($nation_code);

    //     // pre($cities);
    //     // $data = array();
    //     foreach ($cities as $city) {
    //         pre($city);
    //         $data[] = array(
    //             'hotel_country_code' => $city['NationCode'],
    //             'hotel_city_code' => $city['CityCode'],
    //             'hotel_code' => $city['HotelCode'],
    //             'hotel_name' => $city['HotelName'],
    //             'address' => $city['Address'],
    //             'phone' => is_array($city['Phone'])? implode(',', $city['Phone']):$city['Phone'],
    //             'fax' => is_array($city['Fax'])? implode(',', $city['Fax']):$city['Fax'],
    //             'flag' => 1,
    //             'flag_memo' => '',
    //         );
    //     }
    //     // pre($data);
    //     // pre($this->db->last_query());
    //     $this->model_data->input_data('hotel',$data);
    //     // $this->load->view('hotel/data', $data);
    // }
    // public function ambil_data()
    // {
    //     $this->load->model('model_data');
    //     $asset['post']  = $this->input->post();
    //     $nation_code = GB;
    //     foreach ($asset as $value) 
    //     $nation_code = $value['nation_code'];
    //     $city_code   = $value['city_code'];
    //     $hotel_code  = $value['hotel_code'];
    //     $hotel_name  = $value['hotel_name'];
    //     $address     = $value['address'];
    //     $phone       = $value['phone'];
    //     $fax         = $value['fax'];
    //     {
    //     $data = array();
    //         $data['hotel_country_code']  = $nation_code;
    //         $data['hotel_city_code']     = $city_code;
    //         $data['hotel_code']          = $hotel_code;
    //         $data['hotel_name']          = $hotel_name;
    //         $data['address']             = $address;
    //         $data['phone']               = $phone;
    //         $data['fax']                 = $fax;
    //         $data['flag']                = 1;
    //         pre($data);
    //     $this->model_data->input_data($data, 'hotel');
    //     }
    //     redirect('hotel/ambil_datahotel');
    // }

    /*public function ambil_hotelinfo()
    {   
      
        $this->load->model('model_data');
        $this->db->select('hotel_city_code, hotel_country_code');
        $names = array('BO','BR','BS');
        $this->db->where_in('hotel_country_code', $names);
        $hotel_cities = $this->db->get('hotel_city')->result_array();
        // pre($hotel_cities);
        foreach($hotel_cities as $item) {
            $hotel = $this->hotelavia->searchHotelDetail($item['hotel_country_code'], $item['hotel_city_code']);

            // $data = array();
            foreach ($hotel['Hotel'] as $hotels) {
                // pre($hotels['HotelDesc']);
                $data[] = array(
                    'unique_id'             => unique_id('hotel_information'),
                    'hotel_country_code'    => $hotels['NationCode'],
                    'hotel_city_code'       => $hotels['CityCode'],
                    'hotel_code'            => $hotels['HotelCode'],
                    'hotel_name'            => $hotels['HotelName'],
                    'hotel_star'            => is_array($hotels['Star'])? implode(',', $hotels['Star']):$hotels['Star'],
                    'hotel_email'           => is_array($hotels['Email'])? implode(',', $hotels['Email']):$hotels['Email'],
                    'hotel_phone'           => is_array($hotels['Phone'])? implode(',', $hotels['Phone']):$hotels['Phone'],
                    'hotel_fax'             => is_array($hotels['Fax'])? implode(',', $hotels['Fax']):$hotels['Fax'],
                    'hotel_url'             => is_array($hotels['Url'])? implode(',', $hotels['Url']):$hotels['Url'],
                    'hotel_address'         => $hotels['Address'],
                    'hotel_room_qty'        => is_array($hotels['RoomQty'])? implode(',', $hotels['RoomQty']):$hotels['RoomQty'],
                    'hotel_latitude'        => $hotels['Latitude'],
                    'hotel_longtitude'      => $hotels['Longitude'],
                    'flag'                  => 1,
                );
            }
            // unexit_pre($data);
        }
        $this->model_data->input_data('hotel_information',$data);
        // pre(stop);
    }

     public function ambil_hoteldesc()
    {   

        $this->load->model('model_data');
        $this->db->select('hotel_city_code, hotel_country_code');
        $names = array('BH');
        $this->db->where_in('hotel_country_code', $names);
        $this->db->select('hotel_city_code, hotel_country_code');
        $hotel_cities = $this->db->get('hotel_city')->result_array();

                // pre($hotel_cities);
        foreach($hotel_cities as $item) {
            $hotel = $this->hotelavia->searchHotelDetail($item['hotel_country_code'], $item['hotel_city_code']);

        foreach ($hotel['Hotel'] as $hotel_desc){
            foreach ($hotel_desc['HotelDesc'] as $description) {
            $data[] = array(
                'unique_id'      => unique_id('hotel_description'),
                'hotel_code'     => $hotel_desc['HotelCode'],
                'desc_title'     => is_array($description['DescTitle'])? implode(',', $description['DescTitle']):$description['DescTitle'],
                'description'    => is_array($description['Description'])? implode(',', $description['Description']):$description['Description'],
            );
            }
            // unexit_pre($data);
        }
    }    
        // pre(stop);
        $this->model_data->input_data('hotel_description',$data);
    }

     public function ambil_hotelimage()
    {   

        $this->load->model('model_data');
        $this->db->select('hotel_city_code, hotel_country_code');
        $names = array('BB','BD');
        $this->db->where_in('hotel_country_code', $names);
        $hotel_cities = $this->db->get('hotel_city')->result_array();
        foreach($hotel_cities as $item) {
        $hotel = $this->hotelavia->searchHotelDetail($item['hotel_country_code'], $item['hotel_city_code']);

        // pre($hotel);
        foreach ($hotel['Hotel'] as $indexhotel => $image) {
            foreach ($image['HotelImage'] as $value) {
          
            $data[] = array(
                'unique_id'           => unique_id('hotel_image'),
                'hotel_code'          => $image['HotelCode'],
                'image_title'         => $value['ImageTitle'],
                'hotel_image_url'     => $value['ImageUrl'],
                'hotel_thumbnail_url' => is_array($value['Thumbnail'])? implode(',', $value['Thumbnail']):$value['Thumbnail'],
                'flag'                => 1,
                'flag_memo'           => '', 
                );
                }
             // unexit_pre($data);
            }
        }
        // pre(stop);
        $this->model_data->input_data('hotel_image',$data);
    }

    public function ambil_data()
    {
        $this->load->model('model_data');
        $asset['post']  = $this->input->post();
        $nation_code = GB;
        foreach ($asset as $value) 
        $nation_code = $value['nation_code'];
        $city_code   = $value['city_code'];
        $hotel_code  = $value['hotel_code'];
        $hotel_name  = $value['hotel_name'];
        $address     = $value['address'];
        $phone       = $value['phone'];
        $fax         = $value['fax'];
        {
        $data = array();
            $data['hotel_country_code']  = $nation_code;
            $data['hotel_city_code']     = $city_code;
            $data['hotel_code']          = $hotel_code;
            $data['hotel_name']          = $hotel_name;
            $data['address']             = $address;
            $data['phone']               = $phone;
            $data['fax']                 = $fax;
            $data['flag']                = 1;
            pre($data);
        $this->model_data->input_data($data, 'hotel');
        }
        redirect('hotel/ambil_datahotel');
    }*/

    function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }

            foreach ($sortable_array as $k => $v) {
                array_push($new_array, $array[$k]);
            }
        }

        return $new_array;
    }
    
}