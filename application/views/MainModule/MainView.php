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

        .hover_event_list_ongoing {
            background-color: #a4ff9c9e !important;
            color: #800000 !important;
        }
    }

    .rounded-circle {
        border-radius: 50%;
        object-fit: cover;
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
                        <a class="nav-link tab-link" data-content="calendar" id="nav_calendar" href="<?= base_url() ?>calendar">Calendar</a>
                    </li>
                    <?php if ($_SESSION['role'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-content="game" id="nav_game" s href="#">Generate Game</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link tab-link" data-content="contact" id="nav_contact"  href="#">Contact Us</a>
                    </li>
                    <?php if ($_SESSION['role'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link tab-link" data-content="report" id="nav_report"  href="<?= base_url() ?>report-view">Generate Report</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Dropdown -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle shadow-sm" style="width: 45px; height: 45px" alt="Avatar" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><b><?= strtoupper($this->session->userdata('username')) ?></b></a></li>
                            <li><a class="dropdown-item" target="_blank" href="<?= base_url() ?>account-setting">Account Settings</a></li>
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
                                <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle shadow-sm" style="width: 45px; height: 45px" alt="Avatar" loading="lazy" />
                                <div class="d-flex align-items-center w-100 ps-3">
                                    <div class="w-100">
                                        <span class="d-block mb-1"><?= empty(_getUserFullName($_SESSION['username'])) ? 'default_user.jpg' : _getUserFullName($_SESSION['username']) ?></span ?>
                                        <span class="text-muted small"><?= _getCoursesById($CourseId) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 p-2">
                            <center>
                                <i class="bookmark-icon">
                                    <svg id="bookmark-i" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                </i>

                                <h6>Bookmarked</h6>
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
                                    <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="rounded-circle " class="rounded-circle shadow-sm" style="width: 45px; height: 45px" alt="Avatar" loading="lazy" />
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
                                <?php
                                if (empty($weekly_data)) {
                                    echo "<cente> No data found </center>";
                                } else {
                                ?>
                                    <ol class="list-group list-group-light ">

                                        <?php

                                        foreach ($weekly_data as $key => $value): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-start row" style="padding: 2px;">
                                                <div class="ms-2 me-auto col-md-4">
                                                    <div class="fw-bold" style="font-size: 12px;"><?= _getEventDataById($value->EventId)->EventName ?></div>
                                                    <span style="font-size: 10px;"><?= date('M j, Y ', strtotime($value->CreatedDate)) ?></span>
                                                </div>
                                                <div class="col-md-5">
                                                    <?php if (!empty($value->TimeInLog)): ?>
                                                        <span class="badge badge-success rounded-pill">Time in | <?= date('h:i:s', strtotime($value->TimeInLog)) ?></span>
                                                    <?php endif; ?>
                                                    <br>
                                                    <?php if (!empty($value->TimeOutLog)): ?>
                                                        <span class="badge badge-primary rounded-pill">Time Out | <?= date('h:i:s', strtotime($value->TimeOutLog)) ?></span>
                                                    <?php endif; ?>
                                                </div>

                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php } ?>
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
                                        <th class="th_class">EVENT STATUS</th>
                                        <th class="th_class">ACTION</th>
                                        <th class="th_class">Full Details</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($event_list as $key => $value) : ?>
                                        <tr class=" <?= _getDateStatus($value->EventStart) == 1 ? 'hover_event_list_ongoing' : 'hover_event_list' ?>">
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
                                                <?= _getStatusBadge($value) ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url() ?>view-event/<?= $value->EventId ?>" target="frame">
                                                    <i class="fas fa-eye event-view event-action" data-mdb-ripple-init
                                                        data-mdb-tooltip-init
                                                        data-mdb-html="true"
                                                        title="View"></i>
                                                </a>
                                                <?php if (in_array($_SESSION['username'], [$value->EventOrganizer, $value->CreatedBy])): ?>
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
                                                            <input type="text" id="edit-event-name" name="edit-event-name" class="form-control" value="" required />
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
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-start" name="edit-event-start" class="form-control datepicker date-input" required />
                                                            <label class="form-label" for="edit-event-start">EVENT START</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-outline" data-mdb-input-init>
                                                            <input type="date" id="edit-event-end" name="edit-event-end" class="form-control datepicker date-input" required />
                                                            <label class="form-label" for="edit-event-end">EVENT END</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <Label>Short Description</Label>
                                                        <input class="form-control" id="edit-event-description" name="edit-event-description" type="text" placeholder="Short Description">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <Label>Full Details Description</Label>
                                                        <textarea class="summernote" id="edit-event-details" name="edit-event-details"></textarea>
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
                                                    <div class="col-md-6 mb-3">
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

                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group">
                                                            <label> Organizer</label>
                                                            <select class="mdb-select form-select" name="new-event-organizer" id="new-event-organizer">
                                                                <option value="" disabled selected>Choose Organizer</option>
                                                                <?php foreach (_getAllUsers() as $key => $user): ?>
                                                                    <option value="<?= $user->Username ?>" <?= ($_SESSION['username'] == $user->Username ? 'selected' : '') ?>><?= strtoupper($user->Lname . ' ' . $user->Fname . ', ' . (empty($user->Mname) ? '_' : substr($user->Mname, 0, 1) . '.')) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
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
                                                    <div class="col-md-12 mb-3">
                                                        <Label>Short Description</Label>
                                                        <input class="form-control" id="new-event-description" name="new-event-description" type="text" placeholder="Short Description">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <Label>Full Details Description</Label>
                                                        <textarea class="summernote" id="new-event-details" name="new-event-details"></textarea>
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
                <center><a href="<?= base_url('calendar') ?>">Got to Calendar</a></center>
            </div>

            <div class="content_div" id="report_content" style="display: none;">
               
            </div>
            <div class="content_div" id="game_content" style="display: none;">
                <div class="container-fluid">
                    <div class="card m-5">
                        <div class="card-header">
                            <h3>Game generator</h3>
                        </div>
                        <div class="body p-3">
                            <h4>Sport to play</h4>

                            <select class="mdb-select form-select" name="sport" id="sport" style="width: 40%;">
                                <option value="" disabled selected>Choose Sport</option>
                                <option value="BasketBall"> Basketball</option>
                                <option value="Volleyball"> Volleyball</option>
                                <option value="Badminton"> Badminton</option>
                                <option value="Sepak Takraw"> Sepak Takraw</option>
                                <option value="Football"> Football</option>
                                <option value="Footsalt">Fotsalt</option>
                            </select>
                            <hr>
                            <h4>Select Course to generate</h4>
                            <?php foreach (_getAllCourses() as $key => $value):  ?>
                                <div class="form-check form-switch">
                                    <input class="form-check-input courses_check" type="checkbox" role="switch" id="course<?= $key ?>" value="<?= $value->CourseCode ?>" />
                                    <label class="form-check-label" for="course<?= $key ?>"><?= $value->CourseTitle ?></label>
                                </div>
                            <?php endforeach;  ?>
                            <br>
                            <hr>
                            <h4>Game Mode</h4>
                            <!-- Default radio -->
                            <div class="form-check">
                                <input class="form-check-input game_mode" type="radio" name="gmode" id="single1" value="1" checked />
                                <label class="form-check-label" for="single1">Single elimination</label>
                            </div>
                            <!-- Default checked radio -->
                            <div class="form-check">
                                <input class="form-check-input game_mode" type="radio" name="gmode" value="2" id="roundrobin2" />
                                <label class="form-check-label" for="roundrobin2"> Round Robin</label>
                            </div>

                            <hr>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-outline">
                                        <input name="request_date" type="date" id="start_date" class="form-control" value="<?= (new DateTime())->modify('+1 days')->format('Y-m-d') ?>" />
                                        <label class="form-label" for="date">Start Date</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-outline" data-mdb-input-init style="width: 10%;">
                                    <input type="number" id="match_per_day" class="form-control" value="1" />
                                    <label class="form-label" for="match_per_day">Match Per Day</label>
                                </div>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-primary" id="generateGame">Generate</button>
                        </div>

                        <div class="row m-5">
                            <h5>Result:</h5>
                            <span id="result_match"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content_div" id="contact_content" style="display: none;">
                <div class="container-fluid">
                    <div class="card p-2 m-2">
                        <h3>Contact Us </h3>
                        <p>Create ticker for your concern</p>

                        <div class="row m-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div>
                                        <button type="button" class="btn btn-primary" id="addNewContact">Create New +</button>
                                    </div>

                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Created Date </th>
                                            </tr>
                                        </thead>
                                        <tbody id="contactTable">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="ContactModal" tabindex="-1" aria-labelledby="ContactModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ContactModalLabel">Create Concern</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <!-- <form action="#" method="post" id="newUserForm" enctype="multipart/form-data"> -->
                            <form action="" method="post" id="newContactForm">
                                <div class="modal-body">
                                    <div class="form-outline">
                                        <input name="request_date" type="text" id="date" class="form-control" value="<?= date('Y-m-d') ?>" readonly />
                                        <label class="form-label" for="date">request date</label>
                                    </div>
                                    <div>
                                        <label>Category</label>
                                        <select name="category" class="form-select" id="cat">
                                            <option value="1">Event</option>
                                            <option value="2">System</option>
                                            <option value="3">Profile</option>
                                            <option value="4">Workgroup/Access</option>
                                            <option value="5">Update Profile</option>
                                            <option value="6">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-outline">
                                        <label for=""> Description</label>
                                        <textarea name="description" class="summernote" id=""></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer" id="reserve_event_slot_div">
                                    <!-- <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button> -->
                                    <button type="sumbit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>

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
            $(document).on('click', '#generateGame', function() {
                var courses = [];
                $.each($('.courses_check'), function(index, value) {
                    if ($(this).is(':checked')) {
                        courses.push($(this).val());
                    }
                })

                var game_mode = $('input[name="gmode"]:checked').val();
                var game = $('#sport').val();
                var start_date = $('#start_date').val();
                var match_per_day = $('#match_per_day').val();
                if (game == '' || game == null) {
                    alert('Please select a game');
                    return false;
                }
                if (courses.length < 2) {
                    alert('Please select at least 2 courses');
                    return false;
                }
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, generate and save!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url + "generate-game",
                            type: "POST",
                            data: {
                                courses: courses,
                                game_mode: game_mode,
                                game: game,
                                start_date: start_date,
                                match_per_day: match_per_day
                            },
                            dataType: "json",
                            success: function(response) {
                                $('#generateGame').hide();
                                console.log(response);
                                $('#result_match').html(response.result.display);
                            }
                        })
                    }
                });

            })


            $(document).on('click', '#addNewContact', function() {
                $('#ContactModal').modal('show');
            })
            if (new_user == 1) {
                $('#newUserModal').modal('show');
            }


            var content = sessionStorage.getItem("nav" + username);
            if (content !== null) {
                $(".content_div").hide();
                $('.tab-link').removeClass('active_tab');
                $('#nav_' + content).addClass('active_tab');

                $("#" + content + "_content").show();
                if (content == 'calendar') {
                    $('#nav_home').trigger('click');
                }
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