<?=
// var_dump($_SESSION);die;
_headerLayout(['main-view'], 'EVENT | MAIN VIEW')
?>
<style>
    .border-line-left {
        border-left: 1px solid #80808045;
    }

    .border-line-right {
        border-right: 1px solid #80808045;
    }

    .display-content {
        display: contents;
    }

    .th_class {
        text-align: center;
    }

    .active_tab {
        color: #ffc632 !important;
    }

    .event-action:hover {
        color: #800000 !important;
        transform: scale(1.3);
    }

    .event-delete {
        color: #ff5858 !important;
    }

    .event-edit {
        color: #3b71ca;
    }

    .hover_event_list:hover {
        background-color: #fffc9c61 !important;
        color: #800000 !important;
        cursor: pointer;
    }

    @media screen and (max-width: 768px) {
        .hover_event_list {
            background-color: #fffc9c61 !important;
            color: #800000 !important;
        }
        .hover_event_list_ongoing{
            background-color: #a4ff9c9e !important;
            color: #800000 !important;
        }
    }
</style>

<body style="background-color: #fbfbef;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #800000;">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="#"> <img width="30" style="background-color: white;border-radius: 50%;" src="<?= IMG_LOGO ?>" alt=""></a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link tab-link  active_tab" data-content="home" id="nav_home" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-content="event" id="nav_event" href="#">Event List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-content="calendar" id="nav_calendar" href="#">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-content="contact" id="nav_contact" s href="#">Contact</a>
                    </li>
                </ul>

                <!-- Dropdown -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle"
                                height="50" alt="Avatar" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><b><?= strtoupper($this->session->userdata('username')) ?></b></a></li>
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" style="color:red" href="<?= base_url() ?>logout" id="" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (empty($user_data->Username)): ?>
        <!-- Button trigger modal -->
        <div class="container justify-content-center">
            <br>
            <br>
            <center>
                <i>Please setup your account before accessing this module</i><br>
                <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#newUserModal" data-mdb-backdrop="static">
                    New user Setup
                </button>
            </center>

            <!-- Modal -->
            <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New User Setup</h5>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="#" method="post" id="newUserForm" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-outline" data-mdb-input-init>
                                    <input class="form-control" id="formControlReadonly" type="text" value="<?= $_SESSION['email']  ?>" aria-label="readonly input example" readonly />
                                    <label class="form-label" for="formControlReadonly">Email</label>
                                </div>
                                <br>
                                <div class="form-outline " data-mdb-input-init>
                                    <input type="text" id="fname" name="fname" class="form-control user_setup_input" />
                                    <label class="form-label" for="fname"><span style="color : red">*</span> First Name</label>
                                </div>
                                <br>
                                <div class="form-outline " data-mdb-input-init>
                                    <input type="text" id="mname" name="mname" class="form-control " />
                                    <label class="form-label" for="mname">Middle Name (Optional)</label>
                                </div>
                                <br>
                                <div class="form-outline " data-mdb-input-init>
                                    <input type="text" id="lname" name="lname" class="form-control user_setup_input" />
                                    <label class="form-label" for="typeText"><span style="color : red">*</span> Lastname</label>
                                </div>
                                <br>
                                <select class="form-select user_setup_input" name="gender" aria-label="Select gender">
                                    <option disabled selected>-- Select Gender --</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Nonbinary and/or Intersex.</option>
                                </select>
                                <br>
                                <select class="form-select user_setup_input" name="course" aria-label="Select gender">
                                    <option disabled selected>-- Select Course --</option>
                                    <?php foreach ($courses as $key => $value): ?>
                                        <option value="<?= $value->CourseId ?>"><?= $value->CourseTitle . '(' . $value->CourseCode . ')' ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="user_accept_policy" checked />
                                    <label class="form-check-label" for="user_accept_policy">I accept the terms and Privacy policy</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button> -->
                                <button type="sumbit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Content -->
        <div class="container-fluid ">
            <div class="content_div justify-content-center" id="home_content">
                <div class="row">
                    <div class="col-md-3 border-line-right">
                        <div class="card m-3 p-2 ">
                            <div class="d-flex">
                                <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle"
                                    height="50" alt="Avatar" loading="lazy" />
                                <div class="d-flex align-items-center w-100 ps-3">
                                    <div class="w-100">
                                        <span class="d-block mb-1"><?= empty(_getUserFullName($_SESSION['username'])) ? 'default_user.jpg' : _getUserFullName($_SESSION['username']) ?></span ?>
                                        <span class="text-muted small">College of Computer Studies</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 p-2">
                            <center>
                                <h6>MY EVENT</h6>
                            </center>
                            <hr>
                            <div id="home_event_list_join">
                                <ol class="list-group list-group-light list-group-numbered">
                                    <?php foreach ($my_event as $key => $value): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold"><?= $value->EventName ?></div>
                                                <p><?= date('M j, Y h A', strtotime($value->EventStart)) ?></p>
                                            </div>
                                            <a target="_blank" href="<?= base_url() ?>view-event/<?= $value->EventId ?>"><span class="badge badge-primary rounded-pill">view event</span></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="card-body border-bottom pb-2 shadow-lg m-3 p-5" style="border-radius: 14px;background-color: white">
                                <div class="d-flex">
                                    <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle "
                                        height="50" alt="Avatar" loading="lazy" />
                                    <div class="d-flex align-items-center w-100 ps-3">
                                        <div class="w-100">
                                            <div data-mdb-input-init class="form-outline w-100">
                                                <textarea class="form-control" id="textAreaExample" rows="2"></textarea>
                                                <label class="form-label" for="textAreaExample">What's happening</label>
                                            </div>
                                            <div class="m-3">
                                                <button type="button" style="float: inline-end;" class="btn btn-primary btn-sm">Post</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <!-- all news feed here -->
                            <div class="row mt-5 shodow-lg  display-content" id="home_content_feed"></div>
                            <div>
                                <center><a class="btn btn-primary" id="load_more">Load more feed</a></center>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 border-line-left">
                    <div class="card m-3 p-2">
                            <center>
                                <h6>EVENT LOG</h6>
                            </center>
                            <hr>
                            <div id="home_event_list_join">
                                <ol class="list-group list-group-light list-group-numbered">
                                    <?php foreach ($my_event as $key => $value): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold"><?= $value->EventName ?></div>
                                                <p><?= date('M j, Y ', strtotime($value->EventStart)) ?></p>
                                            </div>
                                            <a target="_blank" href="<?= base_url() ?>view-event/<?= $value->EventId ?>"><span class="badge badge-primary rounded-pill">Time in</span></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_div mt-2" id="event_content" style="display: none;">
                <?php if (!empty(_getWorkgroupAccess('ViewEvent'))): ?>
                    <div id="event_list_div" class="card m-3">
                        <div class="card-header p-3">
                            <span><b>EVENT LIST</b></span>
                            <?php if (!empty(_getWorkgroupAccess('CreateEvent'))): ?>
                                <span style="float: right;"> <button class="btn btn-success btn-sm" id="create_event"><i class="far fa-calendar-plus"></i></button></span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">

                                <!-- old reservation table  -->
                            <table class=" nowrap" style="width:100%" id="event_table_list">
                                <thead class="bg-light table-light">
                                    <tr>
                                        <th class="th_class">EVENT NAME</th>
                                        <th class="th_class">EVENT START</th>
                                        <th class="th_class">ORGANIZER</th>
                                        <th class="th_class">CAPACITY</th>
                                        <th class="th_class">EVENT STATUS</th>
                                        <th class="th_class">RESERVED END</th>
                                        <th class="th_class">QUICK RESERVED</th>
                                        <th class="th_class">ACTION</th>
                                        <th class="th_class">Full Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($event_list as $key => $value) : ?>
                                        <tr class=" <?= _getDateStatus($value->EventStart) == 1 ? 'hover_event_list_ongoing':'hover_event_list' ?>">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1"><?= strtoupper($value->EventName) ?></p>
                                                        <p class="text-muted mb-0"> <?= $value->Description ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-3">
                                                        <p class="fw-normal mb-1">Start :<?= date('M j, Y hA', strtotime($value->EventStart));  ?> </p>
                                                        <p class="fw-normal mb-1">End : <?= date('M j, Y', strtotime($value->EventEnd));  ?></p>
                                                        <p class="text-muted mb-0">Location : <?= $value->LocationName ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($value->EventOrganizer) ?>"
                                                        alt=""
                                                        style="width: 45px; height: 45px"
                                                        class="rounded-circle shadow-sm" />
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1"><?= strtoupper(_getUserFullName($value->EventOrganizer)) ?></p>
                                                        <p class="text-muted mb-0"><?= _getUserRole($value->EventOrganizer) ?></p>
                                                    </div>
                                                </div>


                                            </td>
                                            <td>
                                                <center><?= $value->AttendeeCount . '/' . $value->EventSlot ?></center>
                                            </td>
                                            <td>
                                                <?= _getStatusBadge($value) ?>
                                            </td>
                                            <td>
                                                <?php if (_getDateStatus($value->EventReservationEnd)  ==  0):

                                                    if (_getDateStatus($value->EventReservationStart) == 1):
                                                ?>
                                                        <center><?= date('M j, Y', strtotime($value->EventReservationEnd));  ?></center>
                                                    <?php
                                                    else:
                                                    ?>
                                                        <center>--</center>
                                                    <?php
                                                    endif;
                                                else: ?>
                                                    <center>
                                                        <button type="button" class="btn btn-secondary btn-sm btn-rounded">
                                                            Closed
                                                        </button>
                                                    </center>
                                                <?php endif; ?>

                                            </td>
                                            <td>
                                                <?php if (_getDateStatus($value->EventReservationEnd)  ==  1):  ?>
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded view_event" data-start="<?= _getDateStatus($value->EventReservationStart) ?>" data-status="0" data-end="<?= _getDateStatus($value->EventReservationEnd) ?>" data-rowdata="<?= base64_encode(json_encode($value)) ?>" data-reservedata="<?= $value->ReserveData ?>" data-eventid="<?= $value->EventId ?>">
                                                        Participants
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn <?= _getDateStatus($value->EventReservationStart) == 1 ? 'btn-success' : 'btn-primary' ?> btn-sm btn-rounded view_event" data-start="<?= _getDateStatus($value->EventReservationStart) ?>" data-status="1" data-end="<?= _getDateStatus($value->EventReservationEnd) ?>" data-rowdata="<?= base64_encode(json_encode($value)) ?>" data-reservedata="<?= $value->ReserveData ?>" data-eventid="<?= $value->EventId ?>">
                                                        <?= _getDateStatus($value->EventReservationStart) == 1 ? 'RESERVE NOW' : 'Start Soon'  ?>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (in_array($_SESSION['username'], [$value->EventOrganizer, $value->CreatedBy]) && _getDateStatus($value->EventReservationEnd)  ==  0): ?>
                                                    <i class="fas fa-edit event-edit event-action" data-mdb-ripple-init
                                                        data-mdb-tooltip-init
                                                        data-mdb-html="true"
                                                        title="Edit" data-rowdata="<?= base64_encode(json_encode($value)) ?>"></i>
                                                    <i class="fas fa-trash event-delete event-action" data-mdb-ripple-init
                                                        data-mdb-tooltip-init
                                                        data-mdb-html="true"
                                                        title="delete" data-eventid="<?= $value->EventId ?>"></i>
                                                <?php else: ?>
                                                    <center>--</center>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url() ?>view-event/<?= $value->EventId ?>" target="frame">
                                                    <i class="fas fa-eye event-view event-action" data-mdb-ripple-init
                                                        data-mdb-tooltip-init
                                                        data-mdb-html="true"
                                                        title="View"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                                <!-- old reservation table end  -->
                            <center>
                                <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#viewEventModal" data-mdb-backdrop="static" hidden>

                                </button>
                            </center>

                            <!-- Modal -->
                            <div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- <form action="#" method="post" id="newUserForm" enctype="multipart/form-data"> -->
                                        <div class="modal-body">

                                            <div id="event_description" class="mb-3 card p-3" style="background-color: beige;"></div>
                                            <hr>
                                            <div id="attendees_list">
                                                <h5>Attendees :</h5>
                                                <table id="attendees_list_table" class="table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>NAME</th>
                                                            <th>name</th>
                                                            <th>Reserved date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="attendees_list_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer" id="reserve_event_slot_div">
                                            <!-- <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button> -->
                                            <!-- <button type="sumbit" class="btn btn-primary">Save changes</button> -->
                                        </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#editEventModal" hidden>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #800000;color: yellow">
                                            <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                                            <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#" method="post" id="editEventForm" enctype="multipart/form-data">
                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="text" id="edit-event-name" name="edit-event-name" class="form-control" value="" required/>
                                                            <label class="form-label" for="edit-event-name">EVENT NAME</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <select class="mdb-select form-select" name="edit-event-location" id="edit-event-location" required>
                                                                <option value="" disabled selected>Choose Location</option>
                                                                <?php foreach (_getAllLocation() as $key => $value): ?>
                                                                    <option value="<?= $value->id ?>"><?= $value->LocationName ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">

                                                        <div class="form-group">
                                                            <label> Organizer</label>
                                                            <select class="mdb-select form-select" name="edit-event-organizer" id="edit-event-organizer" required>
                                                                <option value="" disabled selected>Choose Organizer</option>
                                                                <?php foreach (_getAllUsers() as $key => $user): ?>
                                                                    <option value="<?= $user->Username ?>"><?= strtoupper($user->Lname . ' ' . $user->Fname . ', ' . (empty($user->Mname) ? '_' : substr($user->Mname, 0, 1) . '.')) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>EVENT SLOT</label>
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="number" id="edit-event-slot" name="edit-event-slot" class="form-control" value="" required/>
                                                            <label class="form-label" for="edit-event-slot">EVENT SLOT</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-start" name="edit-event-start" class="form-control datepicker date-input" required/>
                                                            <label class="form-label" for="edit-event-start">EVENT START</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-end" name="edit-event-end" class="form-control datepicker date-input" required/>
                                                            <label class="form-label" for="edit-event-end">EVENT END</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-reservation_start" name="edit-event-reservation_start" class="form-control datepicker date-input" required/>
                                                            <label class="form-label" for="edit-event-reservation_start">RESERVATION START</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-reservation_end" name="edit-event-reservation_end" class="form-control datepicker date-input" required/>
                                                            <label class="form-label" for="edit-event-reservation_end">RESERVATION END</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <Label>Description</Label>
                                                        <textarea class="summernote" id="edit-event-description" name="edit-event-description" required></textarea>
                                                    </div>
                                                    <input type="hidden" name="edit-event-id" id="edit-event-id">
                                                    <hr>
                                                 
                                                </div>
                                            </div>
                                  
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="save_update" data-mdb-ripple-init>Save Update</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end edit event -->

                            <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#addEventModal" hidden>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #800000;color: yellow">
                                            <h5 class="modal-title" id="addEventModalLabel">CREATE EVENT</h5>
                                            <button type="button" class="btn-close" style="color:yellow" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="#" method="post" id="newEventForm" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="text" id="new-event-name" name="new-event-name" class="form-control" value="" />
                                                            <label class="form-label" for="new-event-name">EVENT NAME</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="form-group">
                                                            <label>Location</label>
                                                            <select class="mdb-select form-select" name="new-event-location" id="new-event-location">
                                                                <option value="" disabled selected>Choose Location</option>
                                                                <?php foreach (_getAllLocation() as $key => $value): ?>
                                                                    <option value="<?= $value->id ?>"><?= $value->LocationName ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">

                                                        <div class="form-group">
                                                            <label> Organizer</label>
                                                            <select class="mdb-select form-select" name="new-event-organizer" id="new-event-organizer">
                                                                <option value="" disabled selected>Choose Organizer</option>
                                                                <?php foreach (_getAllUsers() as $key => $user): ?>
                                                                    <option value="<?= $user->Username ?>"><?= strtoupper($user->Lname . ' ' . $user->Fname . ', ' . (empty($user->Mname) ? '_' : substr($user->Mname, 0, 1) . '.')) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>EVENT SLOT</label>
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="number" id="new-event-name" name="new-event-name" class="form-control" value="" />
                                                            <label class="form-label" for="new-event-name">EVENT SLOT</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="new-event-start" name="new-event-start" class="form-control datepicker date-input" />
                                                            <label class="form-label" for="new-event-start">EVENT START</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="new-event-end" name="new-event-end" class="form-control datepicker date-input" />
                                                            <label class="form-label" for="new-event-end">EVENT END</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="new-event-reservation_start" name="new-event-reservation_start" class="form-control datepicker date-input" />
                                                            <label class="form-label" for="new-event-reservation_start">RESERVATION START</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="new-event-reservation_end" name="new-event-reservation_end" class="form-control datepicker date-input" />
                                                            <label class="form-label" for="new-event-reservation_end">RESERVATION END</label>
                                                        </div>
                                                    </div>




                                                    <div class="col-md-12 mb-3">
                                                        <Label>Description</Label>
                                                        <textarea class="summernote" id="new-event-description" name="new-event-description"></textarea>
                                                    </div>
                                                    <hr>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="">ADD IMAGE (Optional)</label>
                                                        <br>
                                                        <input type="file" name="file" id="fileInput" accept="image/*">
                                                        <br><br>
                                                        <div>
                                                            <center>
                                                                <img id="imagePreview" src="#" alt="Image Preview" style="display:none;width:60%">
                                                            </center>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">SAVE EVENT</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php else: ?>
                    <br>
                    <center>no access for this tab</center>
                <?php endif; ?>
            </div>
            <div class="content_div" id="calendar_content" style="display: none;">
                <div id="calendar"></div>
            </div>
        </div>
    <?php endif; ?>
    <script>
        var new_user = `<?= empty($user_data->Username) ? 1 : 0 ?>`;
        var username = `<?= $_SESSION['username'] ?>`;
    </script>

    <?= _footerLayout(['main-view']) ?>

    <script>
        $(document).ready(function() {

            if (new_user == 1) {
                $('#newUserModal').modal('show');
            }

            var content = sessionStorage.getItem("nav" + username);
            if (content !== null) {
                $(".content_div").hide();
                $('.tab-link').removeClass('active_tab');
                $('#nav_' + content).addClass('active_tab');

                $("#" + content + "_content").show();
            } else {
                console.log('Content does not exist in sessionStorage');
            }

        })
    </script>
    <?php if (!empty($user_data->Username)): ?>
        <script src="<?php echo base_url('assets/js/main-view-home.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/event-list.js'); ?>?refresher=<?= date('YmdHis') ?>"></script>
    <?php endif; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300, // set editor height
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                placeholder: 'Add description...',
                tabsize: 2,
                fontSizes: ['8', '9', '10', '11', '12', '14', '18'],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                callbacks: {
                    onChange: function(contents, $editable) {},
                    onInit: function() {}
                }
            });

            $('#fileInput').change(function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                if (file && file.type.match('image.*')) {
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Please select an image file');
                    $('#fileInput').val('');
                    $('#imagePreview').hide();
                }
            });

        });
    </script>
</body>

</html>