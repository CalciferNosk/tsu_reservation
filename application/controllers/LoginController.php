<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct(){

		parent::__construct();
		$this->load->model('LoginModel','log_m');
		if(isset($_SESSION['username'])){
            redirect('main-view');
        }
	}

	public function index()
	{
		$this->load->view('LoginModule/LoginStudentView');
	}
    public function loginAuth($user){

		if(!($_POST)){
			echo 'invalid request';
			exit;
		}
		$input_email = $this->input->post('email');
		$input_pass = $this->input->post('password');
		$data['status'] = 400;
		$data['result'] = false;
		$data['message'] = 'Login Failed';

	
		if($user == 'student'){
			#check user if exist in table
			$user_check = $this->log_m->checkUserExist($input_email);
			
			# if not exist in table validate email in tsu api
			if(empty($user_check)){
				$api_result = $this->userAPICheck($input_email,$input_pass);

				#check if api result is true
				if(!empty($api_result)){
					$this->log_m->addUser($input_email,$input_pass);
					$data['message'] = 'USER VERIFIED';
					$data['status'] = 200;
					$data['result'] = $api_result;
					#session start
					$this->startSession($input_email,$input_pass);
				}
				$data['result'] = $api_result;
			}
			else{
				if (password_verify($input_pass, $user_check->Password)) {
					$data['message'] = 'LOGIN SUCCESS';
					$data['status'] = 200;
					$data['result'] = $user_check;
					#session start
					$username = empty($user_check->Username) ? $input_email : $user_check->Username;
					$role = $user_check->Role;
					$this->startSession($input_email ,$input_pass,$username,$role);
				}
				else{
					$data['message'] = 'Password Failed';
				}
			}
			
			
			
		}

		echo json_encode($data);
        
    }
    public function loginSuperAdmin(){

        $this->load->view('LoginModule/LoginSuperAdminView');
    }


	private function startSession($email,$pass,$username = null,$role = 6){
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $pass;
		$_SESSION['username'] = empty($username) ? $email : $username;
		$_SESSION['role'] = (int)$role;
	}
	private function userAPICheck($email,$pass){
		#add api call for tsu api
		return true;
	}

	public function logout(){
	 	$this->session->unset_userdata();
		redirect('login');
	}
}
