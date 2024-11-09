<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ADMIN DASHBOARD</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/image/tsu-logo.png') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/admin.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>

        
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="#" class="list-group-item list-group-item-action py-2 active nav-action" data-nav="main" data-mdb-ripple-init aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 nav-action" data-nav="analytics" data-mdb-ripple-init><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 nav-action" data-nav="user" data-mdb-ripple-init><i
                            class="fas fa-users fa-fw me-3"></i><span>Users</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 nav-action" data-nav="event" data-mdb-ripple-init><i
                            class="fas fa-calendar fa-fw me-3"></i><span>Events</span></a>
                            <a href="#" class="list-group-item list-group-item-action py-2 nav-action" data-nav="workgroup" data-mdb-ripple-init><i
                            class="fas fa-user-group fa-fw me-3"></i><span>Workgroup</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="<?= IMG_LOGO ?>" height="25" alt="" loading="lazy" /> | ADMIN DASHBOARD
                </a>
                <!-- Search form -->

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                            role="button" data-mdb-dropdown-init aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else</a>
                            </li>
                        </ul>
                    </li>

            
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown" role="button"
                            data-mdb-dropdown-init aria-expanded="false">
                            <i class="united kingdom flag m-0"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="poland flag"></i>Polski</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="china flag"></i>中文</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="japan flag"></i>日本語</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="germany flag"></i>Deutsch</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="france flag"></i>Français</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="spain flag"></i>Español</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="russia flag"></i>Русский</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#"><i class="portugal flag"></i>Português</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
                                alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <!--Section: Minimal statistics cards-->
            <section class="dashboard-content " id="dashboard-main">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h3 class="text-info"><?= $event_count?></h3>
                                        <p class="mb-0">Event Count</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-calendar text-danger fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                        <i class="fas fa-pencil-alt text-info fa-3x"></i>
                                    </div>
                                    <div class="text-end">
                                        <h3>278</h3>
                                        <p class="mb-0">New Posts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                        <i class="far fa-comment-alt text-warning fa-3x"></i>
                                    </div>
                                    <div class="text-end">
                                        <h3>156</h3>
                                        <p class="mb-0">New Comments</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div class="align-self-center">
                                        <i class="fas fa-map-signs text-danger fa-3x"></i>
                                    </div>
                                    <div class="text-end">
                                        <h3>423</h3>
                                        <p class="mb-0">Total Visits</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h3 class="text-success"><?= count($student) ?></h3>
                                        <p class="mb-0">Student Count</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="far fa-user text-success fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h3 class="text-success"><?= count($staff) ?></h3>
                                        <p class="mb-0">Staff Count</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="far fa-user text-success fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h3 class="text-success"><?= count($professor) ?></h3>
                                        <p class="mb-0">professor Count</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="far fa-user text-success fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                        <h3 class="text-success"><?= count($guest)?></h3>
                                        <p class="mb-0">Guest Count</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="far fa-user text-success fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--Section: Minimal statistics cards-->
            <section class="dash  board-content " id="dashboard-anlytics" style="display: none;">
                <!-- Section: Main chart -->
                <section class="mb-4">
                    <div class="card">
                        <div class="card-header py-3">
                            <h5 class="mb-0 text-center"><strong>Event</strong></h5>
                        </div>
                        <div class="card-body">
                            <canvas class="my-4 w-100" id="myChart" height="380"></canvas>
                        </div>
                    </div>
                </section>
                <!-- Section: Main chart -->
            </section>
            <!--Section: Statistics with subtitles-->
            <section class="dashboard-content " id="dashboard-user" style="display: none;">
                <div class="row">
                    <table class="table align-middle mb-0 bg-white" id="usertable">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all_user as $user) :  ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img
                                            src="<?=base_url()?>assets/user_profile/<?= $user->ProfilePhoto ?>"
                                            alt=""
                                            style="width: 45px; height: 45px"
                                            class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?= empty($user->Fname) || empty($user->Lname) ? 'invalid user' :  strtoupper($user->Fname . ' ' . $user->Lname) ?></p>
                                            <p class="text-muted mb-0"><?= $user->Username ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $user->Email ?></p>
                                    <p class="text-muted mb-0"><?= $user->CourseId ?></p>
                                </td>
                                <td>
                                    <span class="badge badge-success rounded-pill d-inline">Active</span>
                                </td>
                                <td>
                                    <?= _getUserRole($user->Username) ?></td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded edit-user" data-user="<?= base64_encode(json_encode($user)) ?>">
                                        Edit Profile
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded reset-password" data-username="<?= $user->Username ?>" data-sysid="<?= $user->id ?>">
                                        reset password
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <!-- <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img
                                            src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                                            class="rounded-circle"
                                            alt=""
                                            style="width: 45px; height: 45px" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">Alex Ray</p>
                                            <p class="text-muted mb-0">alex.ray@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">Consultant</p>
                                    <p class="text-muted mb-0">Finance</p>
                                </td>
                                <td>
                                    <span class="badge badge-primary rounded-pill d-inline">Onboarding</span>
                                </td>
                                <td>Junior</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-link btn-rounded btn-sm fw-bold"
                                        data-mdb-ripple-color="dark">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img
                                            src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                                            class="rounded-circle"
                                            alt=""
                                            style="width: 45px; height: 45px" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">Kate Hunington</p>
                                            <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">Designer</p>
                                    <p class="text-muted mb-0">UI/UX</p>
                                </td>
                                <td>
                                    <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
                                </td>
                                <td>Senior</td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-link btn-rounded btn-sm fw-bold"
                                        data-mdb-ripple-color="dark">
                                        Edit
                                    </button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </section>
            <!--Section: Statistics with subtitles-->

            <section class="dashboard-content " id="dashboard-event" style="display:none">
                <div class="row">
                <table class=" nowrap" style="width:100%" id="event_table_list" >
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
                                    <?php foreach ($events as $key => $value) : ?>
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
                                                        <!-- <p class="fw-normal mb-1">End : <?= date('M j, Y', strtotime($value->EventEnd));  ?></p> -->
                                                        <p class="text-muted mb-0">Location : <?= $value->EventLocationId ?></p>
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
                                                <center><?= 0 ?></center>
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
                                                ---
                                            </td>
                                            <td>
                                                <?php if (in_array($_SESSION['admin_username'], [$value->EventOrganizer, $value->CreatedBy]) && _getDateStatus($value->EventReservationEnd)  ==  0): ?>
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
                </div>
            </section>
            <section class="dashboard-content " id="dashboard-workgroup" style="display:none">
                <div class="row">
                  <table class="table display">
                    <thead>
                      <tr>
                        <th scope="col">Workgroup</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($workgroup as $value):  ?>
                            <tr>
                                <td><?= $value->WorkgroupName ?></td>
                                <td><?= $value->CreatedBy ?></td>
                                <td><button>Edit</button></td>
                            </tr>
                            <?php endforeach;  ?>
                    </tbody>
                  </table>
                </div>
            </section>
        </div>

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#EditUser" id="btn_edit_user" hidden>
</button>

<!-- Modal -->
<div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="EditUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditUserLabel">Edit User</h5>
        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row m-1">
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="fname" name="fname" class="form-control user_setup_input" />
                    <label class="form-label" for="fname"><span style="color : red">*</span> First Name</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="lname" name="lname" class="form-control user_setup_input" />
                    <label class="form-label" for="lname"><span style="color : red">*</span> Last Name</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="email" name="email" class="form-control user_setup_input" />
                    <label class="form-label" for="email"><span style="color : red">*</span> Email</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="username" name="username" class="form-control user_setup_input" />
                    <label class="form-label" for="username"><span style="color : red">*</span> Username</label>
                </div>
            </div>
        </div>
        <div class="row m-1 mt-2">
            <div class="col-md-6">
                <div class="form-outline " data-mdb-input-init>
                    <input type="email" id="email" name="email" class="form-control user_setup_input" />
                    <label class="form-label" for="email"><span style="color : red">*</span> Email</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="lname" name="lname" class="form-control user_setup_input" />
                    <label class="form-label" for="lname"><span style="color : red">*</span> Last Name</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline " data-mdb-input-init>
                    <input type="text" id="email" name="email" class="form-control user_setup_input" />
                    <label class="form-label" for="email"><span style="color : red">*</span> Email</label>
                </div>
            </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
      </div>
    </div>
  </div>
</div>
    </main>
    <!--Main layout-->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/mdb.umd.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/admin.js"></script>


</body>

</html>