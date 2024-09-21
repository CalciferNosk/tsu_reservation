<?= _headerLayout(['main-view'], 'Main View') ?>

<body>

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
                        <a class="nav-link active" data-content="home" id="nav_home" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-content="event" href="#">Event List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-content="calendar" href="#">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <!-- Dropdown -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <?= $this->session->userdata('username') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
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
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <div class="row">
                            <div class="card-body border-bottom pb-2 shadow-lg mt-3 p-5" style="border-radius: 14px;">
                                <div class="d-flex">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
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
                            <div class="row mt-5 shodow-lg" id="home_content_feed"></div>

                        </div>
                        <div class="col-md-3"></div>
                    </div>

                </div>
                <div class="content_div" id="event_content" style="display: none;">
                    event
                </div>
                <div class="content_div" id="calendar_content" style="display: none;">
                    <div id="calendar"></div>
                </div>

            </div>
        <?php endif; ?>


        <?= _footerLayout(['main-view']) ?>
        <?php if (!empty($user_data->Username)): ?>
            <script src="<?php echo base_url('assets/js/main-view-home.js'); ?>"></script>
        <?php endif; ?>
        <script>
            $(document).ready(function() {
                $new_user = `<?= empty($user_data->Username) ? 1 : 0 ?>`;

                if ($new_user == 1) {
                    $('#newUserModal').modal('show');
                }
            })
        </script>
</body>

</html>