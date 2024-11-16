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

	public function saveProfile()
	{
		
		// Define the upload directory
		$upload_dir = './assets/user_profile/';
		$result =0;
		// Check if the upload directory exists, if not create it
		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0777, true);
		}

		// Check if the file was uploaded
		if ($_FILES['profile']['error'] == 0) {
			// Get the file name and extension
			// $file_name = $_FILES['profile']['name'];
			$file_name = $_SESSION['username'] . '_' . date('Ymd') . '.' . pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

			// Check if the file is allowed (e.g. only images)
			$allowed_ext = array('jpg', 'jpeg', 'png', 'gif','jfif');
			if (in_array($file_ext, $allowed_ext)) {
				// Move the uploaded file to the upload directory
				$new_file_name = $upload_dir . $file_name;
				if (move_uploaded_file($_FILES['profile']['tmp_name'], $new_file_name)) {
					$data['error'] = "File uploaded successfully!";
					$data['result'] =$this->main_m->updateProfile($file_name);
				} else {
					$data['error']  =  "Error uploading file.";
				}
			} else {
				$data['error'] =  "Only images are allowed.";
			}
		} else {
			$data['error'] =  "Error uploading file.";
		}
		echo json_encode($data);
	}

	public function changePassword(){
		$password = $this->main_m->getUsersDataById($_SESSION['username'])->Password;

		if(password_verify($_POST['current'], $password)){
			
			$result = $this->main_m->updatePassword($_POST['newpassword']);
			echo json_encode(1);
		}
		else{
			echo json_encode(0);
		}
	}
	public function updateDetails(){
		
		 $result = $this->main_m->updateDetails($_POST);

		 echo json_encode($result);
	}

	public function getCalendar(){
		$data['initialDate'] = date('Y-m-d');
		$event_list = $this->main_m->getEventList($data);

		$event = [];
		foreach ($event_list as $key => $value) {
			array_push($event,(object)[
				"title" => $value->EventName . ' : '. $value->Description,
				"start" => $value->EventStart,
				"end" => $value->EventEnd
			]);
		}
		$data['event_data'] = json_encode($event);
		$this->load->view('HomeModule/CalendarView',$data);
	}

	public function createConcern(){


		$data = [
			'Title' =>  _getConcernCategoryById($_POST['category']).' | '. $_SESSION['username'],
			'Category' => $_POST['category'],
			'Description' => $_POST['description'],
			'Requestor' => $_SESSION['username'],
			'CreatedBy' => $_SESSION['username']
		];

		$result = $this->main_m->createConcern($data);

		echo json_encode($result);
	}

	public function getAllMyConcerns(){

		$data['concern_list'] = $this->main_m->getAllMyConcerns();
		echo json_encode($data);
	}
	public function viewConcern($id){
		
		$data['result'] = $this->main_m->getAllMyConcerns($id);
	
		$this->load->view('MainModule/ViewConcernView', $data);
	}

	public function generateGame(){
		if(isset($_POST['game_mode'])){
			$teams = $_POST['courses'];
			$game = $_POST['game'];
			$date_start = $_POST['start_date'];
			$team_count = count($teams);

			if($_POST['game_mode'] == 1){
				$data['result'] = $this->SingleElimination($teams, $date_start);
			}
			if($_POST['game_mode'] == 2){
				$data['result'] = $this->RoundRobin($teams, $date_start);
			}
			$data['store'] = $this->main_m->storeSchedule($data['result']['schedule'],$game);
			$content_store = $this->main_m->storeContent($data['result']['display'], $game);
		}

		echo json_encode($data);
	}

	private function RoundRobin($teams, $date_start){
		$matches = _roundRobin($teams);
		$result_test = '';
		$matche_data = [];
		$schedule = [];
		$current_date = strtotime($date_start);
		$matches_per_day = 2;
		$match_count = 0;
	
		foreach ($matches as $key => $match) {
			if($match['team1'] == $match['team2']) continue;
			$display = "Match: {$match['team1']} vs {$match['team2']}<br>";
			$result_test .= $display;
			array_push($matche_data, $match['team1'] . ' vs '. $match['team2'] );
	
			// Add match to schedule
			$date = date('Y-m-d', $current_date);
			if (!isset($schedule[$date])) {
				$schedule[$date] = [];
			}
			$schedule[$date][] = $match;
	
			// Increment date if we've reached the matches per day limit
			$match_count++;
			if ($match_count >= $matches_per_day) {
				$current_date += 86400; // add 1 day
				$match_count = 0;
			}
		}
	
		return ["display" => $result_test, "matches" => $matche_data, "schedule" => $schedule];
	}
	private function SingleElimination($teams, $date_start)
	{
		$bracket = _generateBracket($teams);
		$result_test = '';
		$matche_data = [];
		shuffle($bracket['matches']); // Randomize the order of the matches
		$schedule = [];
		$current_date = strtotime($date_start);
		$matches_per_day = 2;
	
		foreach ($bracket['matches'] as $match) {
			if($match['team1'] == $match['team2']) {
				$display = "Match: {$match['team1']} - waiting <br>";
				$result_test .= $display;
			}else{
				$display = "Match: {$match['team1']} vs {$match['team2']}<br>";
				$result_test .= $display;
				array_push($matche_data, $match['team1'] . '-' . $match['team2']);
	
				// Add match to schedule
				$date = date('Y-m-d', $current_date);
				if (!isset($schedule[$date])) {
					$schedule[$date] = [];
				}
				$schedule[$date][] = $match;
	
				// Increment date if we've reached the matches per day limit
				if (count($schedule[$date]) >= $matches_per_day) {
					$current_date += 86400; // add 1 day
				}
			}
		}
	
		return ["display" => $result_test, "matches" => $matche_data, "schedule" => $schedule];
	}
}
