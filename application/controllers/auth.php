<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->database();
   $this->load->library('session');
     $elBibleLang = null;

     if (!isset($_COOKIE["elBibleLang"])) {
         $elBibleLang = $this->defaultLanguage;
         setcookie("elBibleLang", $elBibleLang, time() + 3153600, "/");
     }else{
         $elBibleLang = $_COOKIE["elBibleLang"];
     }


     $this->lang->load('elbible',$elBibleLang);

 }

// 로그아웃
public function logout(){
	$this->session->unset_userdata('is_login');
    $this->session->unset_userdata('elbible_user_info');	
	$this->load->helper('url');
	redirect('/auth/login');
}

 public function login()
 {
   $data['message'] = $this->input->get('message');

   if($this->session->userdata('is_login')) {
       $this->load->view('diary_v', $data);
   }else{
       $data['strRequireLogin'] = $this->lang->line('RequireLogin');
       $data['strEmailAdress'] = $this->lang->line('EmailAdress');
       $data['strPassword'] = $this->lang->line('Password');
       $data['strSaveLoginSession'] = $this->lang->line('SaveLoginSession');
       $data['strSignIn'] = $this->lang->line('SignIn');
       $data['strRegister'] = $this->lang->line('Register');
	   $data['returnURL'] = $this->input->get('returnURL');
       $this->load->view('auth/login_v', $data);
   } 
 }

	public function alert($str)
	{
		echo('<script>alert('.$str.');</script>');
		
	}

 public function authentication(){

//	$duration = 24 * 60 * 60 * 1;  // 1일간 유지
	$duration = 10;  // 10초
    if ($this->input->post('rememberme') == 'on') {
	//	$duration = 24 * 60 * 60 * 365;  // 1년간 유지
		$duration = 60;  // 1년간 유지
	}


   $this->load->model('user_m');
   $user = $this->user_m->getByEmail($this->input->post('email'));
    if(!function_exists('password_hash')){
		$this->load->helper('password');
	}
    if(
        $this->input->post('email') == $user->email && 
        password_verify($this->input->post('password'), $user->password)
    ) {
		$user->password = null; 
        $this->session->set_userdata('elbible_user_info', $user);	
    	$this->session->set_userdata('is_login', true);	
        $this->load->helper('url');
        $returnURL = $this->input->get('returnURL');
        log_message('info', $returnURL);
        redirect($returnURL ? $returnURL : '/');
		exit();
    } else {        		
		$message = urlencode($this->lang->line('loginFailed'));
        $this->load->helper('url');
        redirect('/auth/login?message='.$message.'&returnURL='.urlencode($this->input->get('returnURL')));
    }
 }
 public function _remap($method){
   // 헤더
  $this->load->view('header_v');
  if (method_exists($this, $method)){
    $this->{"{$method}"}();
  }
 }
}	

