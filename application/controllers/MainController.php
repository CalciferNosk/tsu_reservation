<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{

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
	public function __construct()
	{

		parent::__construct();
		$this->load->model('LoginModel', 'log_m');
		$this->load->model('MainModel', 'main_m');
		if (!isset($_SESSION['username'])) {
			redirect();
		}
	}

	public function mainView()
	{
		// var_dump($_SESSION);die;
		$result = $this->log_m->checkUserExist($_SESSION['email']);
		$data['user_data'] = $result;
		// var_dump($_SESSION);die;
		if (empty($result->Username)) {
			$data['courses'] = $this->main_m->getCourses();
		}
		else{
			$event_control = [];
			$event_data = $this->main_m->getEventList($event_control);
			foreach ($event_data as $key => $event) {
				$reserve_data =$this->main_m->getAttendees($event->EventId);
				$event->AttendeeCount = count($reserve_data);
				$event->ReserveData = base64_encode(json_encode($reserve_data));
			}
			$data['event_list'] = $event_data;
			$data['my_event'] = $this->main_m->getMyEvent($result->Username);
			
		}
		// var_dump('<pre>',$data['event_list']);die;

		$this->load->view('MainModule/MainView', $data);
	}

	public function userSetup()
	{
		$username =  strtoupper(substr($_POST['fname'], 0, 1)) . strtolower($_POST['lname']);
		$data['error_msg'] = '';
		$data['status'] = 400;
		$data_store = [
			'Username' => $username,
			'Fname' => $_POST['fname'],
			'Lname' => $_POST['lname'],
			'mname' => isset($_POST['mname']) ? $_POST['mname'] : '',
			'GenderId' => isset($_POST['gender']) ? $_POST['gender'] : '',
			'CourseId' => isset($_POST['course']) ? $_POST['course'] : '',
			'UpdatedBy' => $username,
			'UpdatedDate' => date('Y-m-d H:i:s'),
			'Role'				=> 5
		];

		$insert_result = $this->main_m->insertUser($data_store,$_SESSION['email']);

		if ($insert_result) {
			$data['error_msg'] = 'User Updated Successfully';
			$_SESSION['username'] = $username;
			$data['status'] = 200;
		} else {
			$data['error_msg'] = 'User Update Failed';
		}

		echo json_encode($data);
	}

	public function fetchHomeContent(){
		#get if from post
		$ids_input = empty($_POST['ids']) ? '' : $_POST['ids'];
		
		$result = $this->main_m->getContent($ids_input);
		$ids=[];
		foreach ($result as $key => $value) {
			array_push($ids, $value->ContentId);
			$value->comments = $this->main_m->getComments($value->ContentId);
		}
		if(!empty($_POST['ids'])){
			$ids = array_merge($ids,explode(',', $ids_input));
		}
		
		// var_dump($result);die;
		$data['result'] = $result;
		$data['ids'] = empty($ids) ? $ids_input  : implode(',', $ids);
		$data['html'] = $this->load->view('HomeModule/HomeContentView', $data, true);

		echo json_encode($data);

	}

	public function reserveEventSlot(){
		$attendees_count = $this->checkEventSlot($_POST['event_id']);
		$slot = (int) $_POST['slot'];
		$data['reserve_status'] = 0;
		$data['result']  		= 0;
		if($attendees_count < $slot){
			$data['result'] = $this->main_m->reserveEventSlot($_POST['event_id'],$_SESSION['username']);
			$data['reserve_status'] = 1;
		}
		echo json_encode($data);
	}

	private function checkEventSlot($event_id){
		$get_reserve_attendees = $this->main_m->getAttendees($event_id);

		return count($get_reserve_attendees);
	}
	public function deleteEvent(){
		$event_id = $_POST['event_id'];
		$result = $this->main_m->deleteEvent($event_id);

		echo json_encode($result);
	}

	public function accountSetting(){
		$data['user_data'] = $this->main_m->getUsersDataById($_SESSION['username']);

		// var_dump('<pre>',$data);die;
		$this->load->view('MainModule/AccountSettingView',$data);
	}


}
