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
        if (!isset($_SESSION['username'])) {
            redirect();
        }
    }
    public function viewEvent($id)
    {   

        $data['event'] = $this->event_m->getEvent((int)$id);
        $this->load->view('EventModule/EventView', $data);
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
}
