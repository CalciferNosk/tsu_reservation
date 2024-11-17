<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

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
        $this->load->model('AdminModel','admin_m');
	}


    public function login()
    {

    	$this->load->view('AdminModule/AdminLoginView');
    }

    public function auth(){

        $data['result'] = 0;
        $data['mssg'] = 'Credentials do not match';
        $_SESSION['login_tries'] = isset($_SESSION['login_tries']) ? $_SESSION['login_tries'] : 0;
        $data['tries'] = $_SESSION['login_tries'] < 3 ?  (3 - $_SESSION['login_tries']) : 0;
        $data['tries_mssg'] = $data['tries'] == 0 ? 'You have been locked out for 5 minutes' : $_SESSION['login_tries'];
       if(isset($_POST['username']) && isset($_POST['password']) &&  $_SESSION['login_tries'] < 3){
           if($_POST['username'] === 'admin'.date('Y')){
            if($_POST['password'] === 'tsuadmin'.date('md')){
                $data['result'] = 1;
                $data['mssg'] = 'Login Successfull';
                $_SESSION['email'] = 'admin';
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['admin_username'] = 'admin';
                $_SESSION['admin_session'] = true;
                $_SESSION['role'] = (int)1;
            }
           }
       }
       $_SESSION['login_tries'] += 1;

       echo json_encode($data);
    }
    public function dashboard(){
        if((isset($_SESSION['admin_session'] ) == true) && $_SESSION['role'] == 1){
            $data['events'] = $this->admin_m->getAllEvents();
            $data['event_count'] = count($data['events']);
            $data['student'] = $this->admin_m->getAllUsers(5);
            $data['professor'] = $this->admin_m->getAllUsers(4);
            $data['staff']  = $this->admin_m->getAllUsers(3);
            $data['organizer'] = $this->admin_m->getAllUsers(2);
            $data['guest'] = $this->admin_m->getAllUsers(6);
           $data['all_user'] =  array_merge($data['student'], $data['professor'],  $data['staff'], $data['guest'], $data['organizer']);
           $data['workgroup'] = $this->admin_m->getAllWorkgroup();
            // echo '<pre>';
            // var_dump($data['all_user']);die;

            $this->load->view('AdminModule/AdminDashboardView',$data);
        }
        else{
            redirect('admin/login');
        }
    }
    public function updateUser()
{
   $result =  $this->admin_m->updateUser($_POST);

   echo json_encode($result);
}
    public function resetLock(){
        $_SESSION['login_tries'] = 0;
        echo 'reset success';
    }


}
