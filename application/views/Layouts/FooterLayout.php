
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>

<script src="<?php echo base_url('assets/js/mdb.min.js'); ?>"></script>

<!-- <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar-all.min.js"></script> -->
 

<script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
<script src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>
<script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
 
<script src="<?php echo base_url('assets/js/toastify.min.js'); ?>"></script>
    <?php  foreach($custom_js as $key => $value): ?>
        <script src="<?= base_url(); ?>assets/js/<?= $value ?>.js"></script>
    <?php endforeach; ?>
    