
<?=
_headerLayout([], 'EVENT | CALENDAR')
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src='<?= base_url() ?>assets/dist/index.global.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var event_data = JSON.parse(`<?= $event_data ?>`);
    var calendar = new FullCalendar.Calendar(calendarEl, {
      height: '100%',
      expandRows: true,
      slotMinTime: '08:00',
      slotMaxTime: '20:00',
      headerToolbar: {  
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      initialView: 'dayGridMonth',
      initialDate: `<?= $initialDate ?>`,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: event_data
    });

    calendar.render();
  });

</script>
<style>

  html, body {
    overflow: hidden;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    /* margin: px; */
    margin-top: 70px;
  }

  .fc-header-toolbar {
    /*
    the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  }

</style>
</head>
<body>
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
                        <a class="nav-link tab-link  " data-content="home" id="nav_home" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tab-link active" data-content="calendar" id="nav_calendar" href="<?= base_url() ?>calendar">Calendar</a>
                    </li>
                    
                </ul>
                <center>
                <h2 style="color:#fec530">EVENT CALENDAR</h2></center>
                <!-- Dropdown -->
                <!-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
                </ul> -->
            </div>
        </div>
    </nav> 
<br>

<br>
<div>

     <div id='calendar-container'>
    <div id='calendar'></div>
  </div>
</div>
 

</body>
</html>
