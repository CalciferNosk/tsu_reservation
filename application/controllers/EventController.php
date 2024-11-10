<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventController extends CI_Controller
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
        $this->load->model('EventModel', 'event_m');
        $this->load->model('MainModel', 'main_m');
        if (!isset($_SESSION['username'])) {
            redirect();
        }
    }
    public function viewEvent($id)
    {   

        $data['event'] = $this->event_m->getEvent((int)$id);
        $data['attendees'] =$this->main_m->getAttendees((int)$id);
        // var_dump('<pre>',$data);die;
        $this->load->view('EventModule/EventView', $data);
    }

    public function scanQr($id){
        $data['event_id'] = $id;
        $this->load->view('EventModule/QrScannerView', $data);
    }
    public function qrStaffEvent($time_data , $event_id){
        $username = base64_decode($_GET['username']);
        $valid_user = (int)_getStaffEvent($username,$event_id) ? 1 : 0;
        $check_decode = $username == 'undefined' ? 1 : 0;
        if($check_decode == 1 || $valid_user == 0){
            $message = "invalid link";
            redirect("invalid-link?result=0&message=$message");
            exit();
        }
        $username = $_SESSION['username'];
        $check_log_in = (int) $this->event_m->checkUserLog($event_id, $username, 'IN');
        if ($time_data == 'IN') {
           
            if (empty($check_log_in)) {
                $data = [
                    "EventId" => $event_id,
                    "Username" => $username,
                    "GeneratedId" => date('YmdHis'),
                    "TimeEvent" => $time_data
                ];
                $store = $this->event_m->timeLog($data);
                if ($store) {
                    $message = "Successfully Time In";
                    redirect("success-time-inresult=0&message=$message");
                    exit();
                } else {
                    $message = "Failed Time In";
                    redirect("invalid-link?result=1&message=$message");
                    exit();
                }
            } else {
                $message = "Already Time IN";
                redirect("invalid-link?result=0&message=$message");
                exit();
            }
       }
       else if($time_data == 'OUT'){
        $check_log_out = (int) $this->event_m->checkUserLog($event_id, $username, 'OUT');

        if(empty($check_log_in)){
            $message = "Please Time In First";
            redirect("invalid-link?result=0&message=$message");
            exit();
        }else{
            $check_log_out = (int) $this->event_m->checkUserLog($event_id, $username, 'OUT');
            if(empty($check_log_out)){
                $data = [
                    "EventId" => $event_id,
                    "Username" => $username,
                    "GeneratedId" => date('YmdHis'),
                    "TimeEvent" => $time_data
                ];
                $store = $this->event_m->timeLog($data);
                if ($store) {
                    $message = "Successfully Time Out";
                    redirect("invalid-link?result=1&message=$message");
                    exit();
                } else {
                    $message = "Failed Time Out";
                    redirect("invalid-link?result=0&message=$message");
                    exit();
                }
            }
            else{
                $message = "Already Time Out";
                redirect("invalid-link?result=0&message=$message");
                exit();
            }
        }

       }
       else{
        $message = "Invalid Data";
        redirect("invalid-link?result=0&message=$message");
        exit();
       }
       var_dump($time_data);die;
    }
    public function timeInStudentEvent($event_id){

        if($_GET['event_id'] != $event_id){
            $message = "You Scan different Event";
            redirect("invalid-link?message=$message");
            exit();
        }
        $username = base64_decode($_GET['username']);
        $check_decode = $username == 'undefined' ? 1 : 0;
        $check_valid_user = $username == $_SESSION['username'] ? 1 : 0;
        $message = "invalid link"; 
        $result = 0;
        // $valid_user = in_array((int)_checkUserDatByUsername($username,'Role'),[1,2,3]) ? 1 : 0;
        $valid_user = (int)_getStaffEvent($username,$event_id) ? 1 : 0;
        $check_valid_user = 0;
        // var_dump(!$check_decode ,!$check_valid_user ,$valid_user == 1);die;
        if(!$check_decode && !$check_valid_user && $valid_user == 1){
            $validateStudentEvent = $this->event_m->validateStudentEvent($event_id, $username); 
            $message = "Already Time In";
            if(empty($validateStudentEvent)){
                $time_in = $this->event_m->timeInStudentEvent($event_id,$_SESSION['username']);
                $result += $time_in;
                $message =$result > 0 ? "Time in  success" : "Time in failed";
            }
        }else{
            $message = 'Only Generated by staff is allowed';
        }

        $data['message'] =  $message;
        $data['result'] = $result;
        if($result == 1){
            redirect('success-time-in');
        }
        else{
            redirect("invalid-link?message=$message");
        }
        $this->load->view('ScannerResult/TImeInEventView', $data);
    }

    public function successTimeIn(){
        $data['result'] =1;
        $this->load->view('ScannerResult/TImeInEventView', $data);
    }
    public function invalidLink(){
        $data['result'] =0;
        $this->load->view('ScannerResult/TImeInEventView', $data);
    }
    public function addEvent()
    {
        $store_data = [
            "EventName" => $_POST['event_name'],
            "Description" => $_POST['description'],
            "EventLocationId" => $_POST['location'],
            "EventOrganizer" => $_POST['organizer'],
            "EventSlot" => $_POST['event_slot'],
            "EventStart" => $_POST['event_start'],
            "EventEnd"    => $_POST['event_end'],
            "EventReservationStart" => $_POST['reservation_start'],
            "EventReservationEnd" => $_POST['reservation_end'],
            "CreatedBy" => $_SESSION['username'],
            "CreatedDate" => date('Y-m-d H:i:s'),
            "GeneratedId" => date('YmdHis')
        ];

        $store = $this->event_m->insertEvent($store_data);
        $data['result'] = 0;
        $data['upload_status'] = 0;
        if ($store) {
            $content_image = "";
            if (!empty($_FILES)) {
                $file_name = $_FILES['file']['name'];
                $file_type = $_FILES['file']['type'];
                $file_tmp_name = $_FILES['file']['tmp_name'];
                $file_error = $_FILES['file']['error'];
                $file_size = $_FILES['file']['size'];

                // You can then use these variables to upload the file to your server
                // For example:
                $target_dir = "./assets/feed_images/";
                $target_file = $target_dir . basename($file_name);

                if (move_uploaded_file($file_tmp_name, $target_file)) {
                    $content_image = basename($file_name);
                    $data['upload_status'] = 1;
                } else {
                    // Handle the error
                }
            }

            $feed_content = [
                "ContentTitle" => $_POST['event_name'],
                "Description"   => $_POST['description'],
                "ContentImage" => $content_image,
                "PostCreatedby" => $_SESSION['username'],
                "CommentAction" => 0,
                "EventId" => $store
            ];

            $store_feed = $this->event_m->insertFeedContent($feed_content);

            if ($store_feed) {
                $data['result'] = 1;
            }
        }

        echo json_encode($data);
    }

    public function addBookmark(){


        $check =  _checkBookmarkByEventId($_POST['event_id'],1);

       if($check == 1){
            $result = $this->event_m->updatedBookmark($_POST['event_id'],$_SESSION['username'],$_POST['bookmark']);
       }
       else{
            $result = $this->event_m->insertBookmark($_POST['event_id'],$_SESSION['username']);
       }
       echo json_encode($result);

    }
}
