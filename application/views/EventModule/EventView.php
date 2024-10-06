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
    }
</style>

<body>

    <div class="container">
    <a href="<?= base_url() ?>"><i class="fas fa-home" style="font-size: 15px;"></i></a>
        <div class="card m-3 p-2">
            <div class="card-header">
                <span><b><?= $event->EventName ?></b></span>
                <span style="float: right;">
                    <?php if (!empty(_checkUserEvent($_SESSION['username'], $event->EventId))):
                        $token = strtoupper(hash ( "sha256", $_SESSION['username'].date("Y-m-d") ))
                        ?>
                        <i class="fas fa-qrcode" id="generate"></i>
                    <?php else: 
                        ?>
                        <i class="fas fa-calendar-check" style="color:green"></i>
                    <?php endif; ?>
                </span>
            </div>
            <div class="body">

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
                    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>Save changes</button>
      </div> -->
                </div>
            </div>
        </div>

    </div>

    <?= _footerLayout(['main-view']) ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>

    <script>
        $(document).ready(function() {
            var base_url = "<?= base_url() ?>";
            var username = "<?= $_SESSION['username'] ?>";
            var token    = "<?= $token ?>";
            $("#generate").click(function() {
                $('#qrcodeModal').modal('show');
                var event_name = "<?= $event->EventName ?>";
                var event_id = "<?= $event->EventId ?>";
                var username = btoa(username);
             
                var link = base_url + "scan-event/login/" + event_id + "/?username=" + username + '&token=' + token;
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