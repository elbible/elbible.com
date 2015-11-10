<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
     parent::__construct();
     $this->load->database();
    // $this->load->model('user_m'); 구현 하자...

     $elBibleLang = null;

     if (!isset($_COOKIE["elBibleLang"])) {
         $elBibleLang = $this->defaultLanguage;
         setcookie("elBibleLang", $elBibleLang, time() + 3153600, "/");
     }else{
         $elBibleLang = $_COOKIE["elBibleLang"];
     }
     $this->lang->load('elbible',$elBibleLang);
 }

 public function index()
 {
   $this->login();
 }

 // 사이트 헤더, 푸터 추가
    public function _remap($method){
        // 헤더
        $this->load->view('header_v');
        if (method_exists($this, $method)){
            $this->{"{$method}"}();
        }
    }

 // 폼 검증
 public function register_form(){
 	//$this->output->enable_profiler(TRUE);


 	// 폼검증 라이브러리 로드
 	$this->load->library('form_validation');
 	

 	// 폼검증 실패시 일반 입력 페이지
    $data['strEmailAdress'] = $this->lang->line('EmailAdress');
    $data['strPassword'] = $this->lang->line('Password');
    $data['strRegister'] = $this->lang->line('Register');
    $data['strRegisterForm'] = $this->lang->line('RegisterForm');
    $data['strUserName'] = $this->lang->line('UserName');
    $data['strPasswordConfirmed'] = $this->lang->line('PasswordConfirmed');


	$this->form_validation->set_rules('email',  $data['strEmailAdress'], 'required|valid_email|trim'); 	
	$this->form_validation->set_rules('user_name', $data['strUserName'], 'required|min_length[3]|max_length[20]');
 	$this->form_validation->set_rules('password',  $data['strPassword'], 'required|min_length[6]|max_length[30]|matches[re_password]');
    $this->form_validation->set_rules('re_password', $data['strPasswordConfirmed'], 'required');
 
	
 	if($this->form_validation->run() == FALSE){
        $this->load->view('auth/register_v',$data);
 	}else{		 
		
			if(!function_exists('password_hash')){
				$this->load->helper('password');
			}
			$hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
	 
			$this->load->model('user_m');
			$this->user_m->add(array(
				'email'=>$this->input->post('email'),
				'password'=>$hash,
				'user_name'=>$this->input->post('user_name')
			));
	 
			$this->session->set_flashdata('message', '회원가입에 성공했습니다.');
			$this->load->helper('url');
			redirect('/');
 	}
 }
 
 public function user_id_check($user_id){

  $this->load->database();

  if($user_id){
    $result=array();
    $sql = "SELECT user_id FROM USERS WHERE user_id='".$user_id."'";
    $query = $this->db->query($sql);
    $result = @$query->row();
    
    
    if($result){
      $this->form_validation->set_message('user_id_check', $user_id.'은(는) 중복된 아이디입니다.');
      return FALSE;
    }
    else{
      return TRUE;
    }
  }
 } 	
 
 
 }		
 
 