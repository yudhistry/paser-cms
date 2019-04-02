<!-- Vendor -->
<script src="<?php echo base_url('assets/admin/vendor/jquery/jquery.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/popper/umd/popper.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/common/common.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/nanoscroller/nanoscroller.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/magnific-popup/jquery.magnific-popup.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-placeholder/jquery-placeholder.js');?>"></script>

<!-- Specific Page Vendor -->
<script src="<?php echo base_url('assets/admin/vendor/select2/js/select2.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/pnotify/pnotify.custom.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-ui/jquery-ui.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jquery-maskedinput/jquery.maskedinput.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-timepicker/bootstrap-timepicker.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/fuelux/js/spinner.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/dropzone/dropzone.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-markdown/js/markdown.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-markdown/js/to-markdown.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-markdown/js/bootstrap-markdown.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/lib/codemirror.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/addon/selection/active-line.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/addon/edit/matchbrackets.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/mode/javascript/javascript.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/mode/xml/xml.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/mode/htmlmixed/htmlmixed.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/codemirror/mode/css/css.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/summernote/summernote-bs4.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-maxlength/bootstrap-maxlength.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/ios7-switch/ios7-switch.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/datatables/media/js/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/autosize/autosize.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/pnotify/pnotify.custom.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/jstree/jstree.js');?>"></script>
<script src="<?php echo base_url('assets/admin/vendor/isotope/isotope.js');?>"></script>
<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url('assets/admin/js/theme.js');?>"></script>
<!-- Theme Initialization Files -->
<script src="<?php echo base_url('assets/admin/js/theme.init.js');?>"></script>
<!-- Examples -->
<script src="<?php echo base_url('assets/admin/js/examples/examples.treeview.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.notifications.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.advanced.form.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.modals.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.datatables.default.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.modals.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/examples/examples.lightbox.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //datatables
        $('#datatable-default').DataTable({
            "deferRender": true,
            "responsive": true ,
            "paging": true,
            "searching": true,
            "select": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "destroy": true,
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo $ajax_list;?>",
                "type": "POST",
                "data": function ( data ) {
                    data.ID = $('#ID').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
            {
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],
        });
        //check all
        $("#check-all").click(function () {
            $(".data-check").prop('checked', $(this).prop('checked'));
        });

    });
    $.fn.dataTable.ext.errMode = 'throw';
</script>
