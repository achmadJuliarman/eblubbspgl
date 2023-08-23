<footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
    <div class="footer-copyright">
        <div class="container"><span>&copy; 2023 <a href="https://geologi.esdm.go.id" target="_blank">Badan Geologi | BBSPGL</a></span></div>
    </div>
</footer>

<script src="<?php echo base_url();?>assets/new_design/js/vendors.min.js"></script>

<script src="<?php echo base_url();?>assets/new_design/vendors/formatter/jquery.formatter.min.js"></script>

<!-- <script src="<?php echo base_url();?>assets/new_design/vendors/quill/katex.min.js"></script>
<script src="<?php echo base_url();?>assets/new_design/vendors/quill/highlight.min.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/new_design/vendors/quill/quill.min.js"></script> -->
<script src="<?php echo base_url();?>assets/new_design/vendors/select2/select2.full.min.js"></script>

<!-- <script src="<?php echo base_url();?>assets/new_design/vendors/data-tables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/new_design/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/new_design/vendors/data-tables/js/dataTables.select.min.js"></script> -->

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<script src="<?php echo base_url();?>assets/new_design/js/plugins.js"></script>
<script src="<?php echo base_url();?>assets/new_design/js/search.js"></script>
<script src="<?php echo base_url();?>assets/new_design/js/custom/custom-script.js"></script>
<script src="<?php echo base_url();?>assets/new_design/js/scripts/form-elements.js"></script>
<script src="<?php echo base_url();?>assets/new_design/js/scripts/form-masks.js"></script>


<script src="<?php echo base_url();?>assets/new_design/js/scripts/form-select2.js"></script>
<script src="<?php echo base_url();?>assets/new_design/js/scripts/advance-ui-modals.js"></script>
<!-- <script src="<?php echo base_url();?>assets/new_design/js/scripts/data-tables.js"></script> -->
<script src="<?php echo base_url();?>assets/new_design/js/scripts/form-editor.js"></script>
<script src="<?php echo base_url();?>assets/new_design/tinymce/js/tinymce/tinymce.min.js"></script>

<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/table/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/paste/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/spellchecker/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/autolink/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/anchor/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/tinymce/js/tinymce/plugins/emoticons/plugin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script src="<?php echo base_url(); ?>assets/new_design/js/scripts/form-validation.js"></script>


<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script type="text/javascript">
tinymce.init({
selector: 'textarea#basic-example',
height: 200,
menubar: false,
plugins: [
  'advlist autolink lists link image charmap print preview anchor',
  'searchreplace visualblocks code fullscreen',
  'insertdatetime media table paste code help wordcount'
],
toolbar: 'undo redo | formatselect | ' +
'bold italic backcolor | alignleft aligncenter ' +
'alignright alignjustify | bullist numlist outdent indent | ' +
'removeformat | help',
content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
<script>
tinymce.init({selector:'textarea'});
(function($) {
    $(function() {
        $('input.timepicker').timepicker();
    });
})(jQuery);
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.timepicker').timepicker();
    $('#example').DataTable( {
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": false
    });
    $('#print').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>
</body>

</html>
