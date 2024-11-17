<!DOCTYPE html>
<html>

<head>
    <title>DataTables Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/toastify.min.css">
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
                        <a class="nav-link tab-link active" data-content="calendar" id="nav_calendar" href="#">Report</a>
                    </li>

                </ul>
                <center>
                    <h2 style="color:#fec530">ATTENDANCE REPORT</h2>
                </center>
            </div>
        </div>
    </nav>
    <div class="card m-5 p-5">
        <h4>Gerenate Attendance Report</h4>
        <div class="row" id="filter">

            <div class="col-md-3">
                <div class="form-outline" data-mdb-input-init>
                    <input type="date" id="date-from" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" />
                    <label class="form-label" for="date-from">Date From</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline" data-mdb-input-init>
                    <input type="date" id="date-to" class="form-control form-control-sm" value="<?= date('Y-m-d') ?>" />
                    <label class="form-label" for="date-to">Date To</label>
                </div>
            </div>
            <?php if (in_array($_SESSION['role'], [2, 3])): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="mdb-select form-select" name="user" id="user">
                            <option value="" disabled selected>Choose User</option>
                            <option value="All" >All</option>
                            <?php foreach (_getAllUsers() as $key => $user): ?>
                                <!-- <option value="" disabled selected> Select User</option> -->
                                <option value="<?= $user->Username ?>"><?= strtoupper($user->Lname . ' ' . $user->Fname . ', ' . (empty($user->Mname) ? '_' : substr($user->Mname, 0, 1) . '.')) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php else: ?>
                <input type="hidden" id="user" value="<?= $_SESSION['username'] ?> " class="form-control form-control-sm" />
            <?php endif; ?>

            <div class="col-md-3">
                <button class="btn btn-primary" id="generate-report">
                    generate
                </button>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <table id="report" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Name</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                    </tr>
                </thead>
                <tbody id="data_attendance">

                </tbody>
            </table>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/mdb.min.js'); ?>"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
        var base_url = `<?= base_url() ?>`;
        $(document).ready(function() {



            $(document).on('click', '#generate-report', function() {
                var from = $('#date-from').val();
                var to = $('#date-to').val();
                var user = $('#user').val();
                if (from == '' || to == '' || user == null) {
                    alert('Please fill all fields');
                    return false;
                }

                var formdata = new FormData();
                formdata.append('from', from);
                formdata.append('to', to);
                formdata.append('user', user)

                $.ajax({
                    url: base_url + "get-attendance",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        var html = '';

                        $.each(response, function(k, v) {
                            html += `<tr>
                                        <td>${v.EventName}</td>
                                        <td>${v.fullname}</td>
                                        <td>${v.TimeInLog == null ? 'no time in' : v.TimeInLog}</td>
                                        <td>${v.TimeOutLog == null ? 'no time out' : v.TimeOutLog}</td>
                                        
                                    </tr>
                                     `
                        })

                        $('#data_attendance').html(html)
                        $('#filter').html(`<center>Data is ready.Refresh page to generate new record</center>`);
                        new DataTable('#report', {
                            layout: {
                                topStart: {
                                    buttons: [{ 
                                        extend: 'excelHtml5',
                                        text: 'Export to Excel',
                                        filename: 'report',
                                        exportOptions: {
                                            columns: ':visible'
                                        }
                                    }]
                                }
                            }
                        });
                    },
                });
            })

        });
    </script>

</body>

</html>