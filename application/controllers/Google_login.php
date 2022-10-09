<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {


 function login()
 {
//   include_once APPPATH . "/vendor/autoload.php";

//   $google_client = new Google_Client();

//   $google_client->setClientId('268100085937-ej7qc7ll02di15570g29sh9tkvposl37.apps.googleusercontent.com'); //Define your ClientID

//   $google_client->setClientSecret('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'); //Define your Client Secret Key

//   $google_client->setRedirectUri('https://www.kotobee.online/google_login/login'); //Define your Redirect Uri

//   $google_client->addScope('email');
//   $google_client->addScope('profile');

//   if(isset($_GET["code"]))
//   {
//    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//    if(!isset($token["error"]))
//    {
//     $google_client->setAccessToken($token['access_token']);

//     $this->session->set_userdata('access_token', $token['access_token']);

//     $google_service = new Google_Service_Oauth2($google_client);

//     $data = $google_service->userinfo->get();

//     if(isset($data['email'])){
//         if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
//             $email = $data['email'];
//             $fb_user_id = $data['id'];
//             $first_name = $data['given_name'];
//             $last_name = $data['family_name'];
            
//             $credential = array('email' => $email, 'status' => 1);
//             $query = $this->db->get_where('users', $credential);
//             if($query->num_rows() > 0){
//                 $row = $query->row();

//                 // For device login tracker
//                 $this->user_model->new_device_login_tracker($row->id);
//                 $this->user_model->set_login_userdata($row->id);
//             }else{
//                 $data['first_name'] = $first_name;
//                 $data['last_name']  = $last_name;
//                 $data['email']  = $email;
//                 $data['password']  = sha1(random(30));
//                 $data['status']  = 1;
        
        
//                 $data['wishlist'] = json_encode(array());
//                 $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
//                 $social_links = array(
//                     'facebook' => "",
//                     'twitter'  => "",
//                     'linkedin' => ""
//                 );
//                 $data['social_links'] = json_encode($social_links);
//                 $data['role_id']  = 2;
//                 $data['payment_keys'] = '{"paypal":{"production_client_id":"","production_secret_key":""},"stripe":{"public_live_key":"","secret_live_key":""},"razorpay":{"key_id":"","secret_key":""}}';
                
//                 $validity = $this->user_model->check_duplication('on_create', $data['email']);
//                 if($validity == true){
//                     $this->db->insert('users', $data);
                    
//                     //login
//                     $credential = array('email' => $email, 'status' => 1);
//                     $query = $this->db->get_where('users', $credential);
//                     $row = $query->row();

//                     // For device login tracker
//                     $this->user_model->new_device_login_tracker($row->id);
//                     $this->user_model->set_login_userdata($row->id);
//                 }else{
//                     $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
//                     redirect(site_url('home/login'), 'refresh');
//                 }
//             }
            
//             $this->session->set_flashdata('flash_message', get_phrase('welcome') . ' ' . $row->first_name . ' ' . $row->last_name);

//             if($this->session->userdata('url_history')){
//                 redirect($this->session->userdata('url_history'), 'refresh');
//             }
//             redirect(site_url(), 'refresh');
//         }else{
//             $this->session->set_flashdata('error_message', get_phrase('invalid_email_address'));
//             redirect(site_url('home/login'), 'refresh');
//         }
//     }
//    }
//   }
//   $login_button = '';
//   if(!$this->session->userdata('access_token'))
//   {
//    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'asset/sign-in-with-google.png" /></a>';
//    $data['login_button'] = $login_button;
//    $data['page_name'] = 'login';
//    $data['page_title'] = site_phrase('login');
//    $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $data);
//   }
//   else
//   {
//    $data['page_name'] = 'login';
//    $data['page_title'] = site_phrase('login');
//    $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $data);
//   }
 }

 function logout()
 {
  $this->session->unset_userdata('access_token');

  $this->session->unset_userdata('user_data');

  redirect('google_login/login');
 }
 
}
?>