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
                    <li class="nav-item" >
                        <a class="nav-link active" data-content="home" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" data-content="event" href="#">Event List</a>
                    </li>
                    <li class="nav-item" >
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
                            <li><a class="dropdown-item" style="color:red" id="logout" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="container mt-5">
        <div class="content_div" id="home_content">
            home_content
        </div>
        <div class="content_div" id="event_content" style="display: none;">
            event
        </div>
        <div class="content_div" id="calendar_content" style="display: none;">
        <div id="calendar"></div>
        </div>

    </div>
    <?= _footerLayout(['main-view']) ?>
</body>

</html>