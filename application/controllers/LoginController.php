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
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$data['status'] = 400;
		$data['result'] = false;
		$data['message'] = 'Login Failed';

		// var_dump($user);die;	
		if($user == 'student'){
			$api_result = $this->userAPICheck($email,$pass);

			if(!empty($api_result)){
				$data['message'] = 'Login Success';
				$data['status'] = 200;
				$data['result'] = $api_result;
			}
			$data['result'] = $api_result;
			
		}

		echo json_encode($data);
        
    }
    public function loginSuperAdmin(){

        $this->load->view('LoginModule/LoginSuperAdminView');
    }

	private function userAPICheck($email,$pass){
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $pass;
		$_SESSION['username'] = $email;
		return true;
	}
	public function logout(){
	$this->session->unset_userdata();
		redirect('login');
	}
}
