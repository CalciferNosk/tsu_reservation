
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url('assets/js/mdb.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<!-- <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar-all.min.js"></script> -->
 

<script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
<script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
 
<script src="<?php echo base_url('assets/js/toastify.min.js'); ?>"></script>
    <?php  foreach($custom_js as $key => $value): ?>
        <script src="<?= base_url(); ?>assets/js/<?= $value ?>.js"></script>
    <?php endforeach; ?>
    