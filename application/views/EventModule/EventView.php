<?=
_headerLayout(['event-view'], 'EVENT | VIEW EVENT')
?>

<style>
    #qr1 {
        width: 100%;
    }

    .sacramento-regular {
        /* font-family: "Sacramento", cursive; */
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-style: normal;
        font-size: 50px;
        margin: unset;
        /* display: none; */
    }

    @font-face {
        font-family: 'Poppins';
        src: url('path/to/poppins.woff') format('woff');
    }

    @media screen and (max-width: 768px) {
        .sacramento-regular {
            font-size: 30px !important;
        }

        #qr_div {
            width: 100%;
            margin: auto;
        }
    }

    #qr_div {
        width: 80%;
        margin: auto;
    }

    .bookmark-icon:hover {
        transform: scale(1.06);
    }
</style>

<body>
    <div class="container">
        <a href="<?= base_url() ?>"><i class="fas fa-home" style="font-size: 15px;"></i></a>
        <div class="card m-3 p-2">
            <div class="card-header">
                <!-- <span><b><?= $event->EventName ?></b></span> -->
                <i class="bookmark-icon" data-isbookmarked="<?= _checkBookmarkByEventId($event->EventId,0) ?>" data-eventid="<?= $event->EventId ?>">
                    <svg id="bookmark-i" width="24" height="24" viewBox="0 0 24 24" fill="<?= _checkBookmarkByEventId($event->EventId,0) == true ? '#fec530' : 'none' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                </i>

                <span style="float: right;">
                    <?php if (_getStaffEvent($_SESSION['username'], $event->EventId)):  ?>
                        <select name="time" id="time" class="form-group">
                            <option value="IN">IN</option>
                            <option value="OUT">OUT</option>
                        </select>
                    <?php endif ?>
                    <?php if (!empty(_checkUserEvent($_SESSION['username'], $event->EventId))):
                        $token = strtoupper(hash("sha256", $_SESSION['username'] . date("Y-m-d")))
                    ?>
                        <div class="btn-group shadow-0 mb-2">
                            <button
                                class="btn btn-secondary dropdown-toggle"
                                type="button"
                                id="dropdownMenuButton"
                                data-mdb-dropdown-init
                                data-mdb-ripple-init
                                aria-expanded="false">
                                <i class="fas fa-qrcode"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a target="_blank" class="dropdown-item" href="<?= BASE_URL_SSL ?>/scan-qr/<?= $event->EventId ?>"><i class="fa-regular fa-square"></i>Scan QR</a></li>
                                <?php if (_getStaffEvent($_SESSION['username'], $event->EventId)):  ?>
                                    <li><a class="dropdown-item" href="#" id="organizer_qr"> <i class="fas fa-qrcode"></i> Staff QR</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="#" id="generate"> <i class="fas fa-qrcode"></i> Generate QR</a></li>
                                <?php endif ?>
                            </ul>
                        </div>
                    <?php else:
                    $token = '';
                    ?>
                        <i class="fas fa-calendar-check" style="color:green"></i>
                    <?php endif; ?>
                </span>
            </div>
            <div class="body">
                <div id="<?= $event->EventId ?>">
                    <?php if (!empty(_getEventPhoto($event->EventId))):  ?>
                        <figure>
                            <center>
                                <img style="width: 50%;" src="<?= base_url() ?>assets/feed_images/<?= _getEventPhoto($event->EventId) ?>" alt="">
                            </center>
                        </figure>

                    <?php endif ?>
                </div>
                <table>
                    <tr>
                        <td><b>Event Name</b></td>
                        <td>: <?= $event->EventName ?></td>
                    </tr>
                    <tr>
                        <td><b>Start</b></td>
                        <td>: <?= date('M j, Y hA', strtotime($event->EventStart)) ?></td>
                    </tr>
                    <tr>
                        <td><b>End</b></td>
                        <td>: <?= date('M j, Y hA', strtotime($event->EventEnd)) ?></td>
                    </tr>
                    <tr>
                        <td><b>Location</b></td>
                        <td>: <?= $event->EventLocationId ?></td>
                    </tr>
                    <tr>
                        <td><b>Organizer</b></td>
                        <td>: <?= $event->EventOrganizer ?></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td>: <?= $event->Description ?></td>
                    </tr>
                </table>

            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#qrcodeModal" hidden>

        </button>

        <!-- Modal -->
        <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrcodeModalLabel">Gatepass QR Code</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="qr_div"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#qrStaff" hidden>

        </button>

        <!-- Modal -->
        <div class="modal fade" id="qrStaff" tabindex="-1" aria-labelledby="qrStaffLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrStaffLabel">Gatepass QR Code</h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="qr_div_staff"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>

    <script>
        $(document).ready(function() {
            const base_url = "<?= base_url() ?>";
            const token = "<?= $token ?>";
            const username = "<?= $_SESSION['username'] ?>";

            $("#generate").click(function() {
                $('#qrcodeModal').modal('show');
                var event_name = "<?= $event->EventName ?>";
                var event_id = "<?= $event->EventId ?>";
                console.log(username);
                var username_link = btoa(username);

                var link = base_url + "scan-event/login/" + event_id + "/?username=" + username_link + '&token=' + token;

                $("#qr_div").html(` <center>
                                            <p class="sacramento-regular"><b>${event_name}</b></p>
                                          
                                            <qr-code id="qr1" contents="${link}" module-color="black" position-ring-color="black" position-center-color="black" style="background-color: #fff;">
                                                <img style="width: 100%" src="<?= base_url() ?>/assets/image/tsu-logo.png" slot="icon" />
                                            </qr-code>
                                              <p class="sacramento-regular">Scan me</p>
                                        </center>`);
                var animation = 'FadeInTopDown';


                genereteQRCode(animation);

            })

            $(document).on('click', '.bookmark-icon', function() {
                var bookmark = $(this).data('isbookmarked');
                var event_id = $(this).data('eventid');
               ;
                if(bookmark == 1){
                    $(this).children().attr('fill','none')
                    $(this).attr('data-isbookmarked',0)
                }else{
                    $(this).children().attr('fill','#fec530')
                    $(this).attr('data-isbookmarked',1)
                }
                $.ajax({
                    url: base_url+'add-bookmark',
                    method: 'POST',
                    data: {
                        bookmark: $(this).attr('data-isbookmarked'),
                        event_id: $(this).attr('data-eventid')
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    }
                })
               
            })
            function isbookmark(animation) {
                var bookmark = $(this).data('isbookmarked');
            }
            $(document).on('click', '#organizer_qr', function() {
                var time = $('#time').val();
                var event_name = "<?= $event->EventName ?>";
                var event_id = "<?= $event->EventId ?>";
                var username_link = btoa(username);
                var date = `<?= base64_encode(date('Y-m-d H:i:s')) ?>`
                var link = base_url + "qr-staff-event/" + time + "/" + event_id + "/?username=" + username_link + '&token=' + token + '&validity=' + date;
                $("#qr_div_staff").html(` <center>
                            <p class="sacramento-regular"><b>${event_name}</b></p>
                          
                            <qr-code id="qr1" contents="${link}" module-color="black" position-ring-color="black" position-center-color="black" style="background-color: #fff;">
                                <img style="width: 100%" src="<?= base_url() ?>/assets/image/tsu-logo.png" slot="icon" />
                            </qr-code>
                              <p class="sacramento-regular">Scan to ${time}</p>
                        </center>`);
                var animation = 'FadeInTopDown';
                $('#qrStaff').modal('show')
                console.log(link);
                genereteQRCode(animation);

            })
        })


        // source code animation
        // https://github.com/bitjson/qr-code
        function genereteQRCode(animation) {
            document.getElementById('qr1').addEventListener('codeRendered', () => {
                document.getElementById('qr1').animateQRCode(animation);
                // document.getElementById('qr1').animateQRCode('FadeInTopDown');
                // document.getElementById('qr1').animateQRCode('RadialRipple');
                // document.getElementById('qr1').animateQRCode('FadeInCenterOut');
                // document.getElementById('qr1').animateQRCode('MaterializeIn');
                // document.getElementById('qr1').animateQRCode('RadialRippleIn');

            });
            document
                .getElementById('qr1')
                .animateQRCode((targets, _x, _y, _count, entity) => ({
                    targets,
                    from: entity === 'module' ? Math.random() * 200 : 200,
                    duration: 500,
                    easing: 'cubic-bezier(.5,0,1,1)',
                    web: {
                        opacity: [1, 0],
                        scale: [1, 1.1, 0.5]
                    },
                }));
        }
    </script>
</body>

</html>