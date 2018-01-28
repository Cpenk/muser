      <hr>

      <footer>
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== 
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
    <script src="<?=base_url('assets/bootstrap/jquery.min.js')?>"></script>
<!--    <script>window.jQuery || document.write('<script src="<?=base_url("assets/bootstrap/assets/js/vendor/jquery.min.js")?>"><\/script>')</script>
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>

    <script src="<?=base_url('assets/bootstrap/assets/js/ie10-viewport-bug-workaround.js')?>"></script>-->
    <script src="<?=base_url('assets/bootstrap/offcanvas.js')?>"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <!-- pace -->
    <script src="<?=base_url('assets/plugins/pace/pace.min.js')?>"></script>
    <!-- select 2 -->
    <script src="<?=base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
        <!-- InputMask -->
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js');?>"></script>
    <script src="<?=base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js');?>"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>

    <!-- bootstrap color picker -->
    <script src="<?=base_url('assets/plugins/colorpicker/bootstrap-colorpicker.min.js');?>"></script>
    <!-- bootstrap time picker -->
    <script src="<?=base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
    <!-- SlimScroll -->
    <script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?=base_url('assets/plugins/fastclick/fastclick.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/dist/js/app.min.js')?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
    <!-- page script -->
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
    <script type="text/javascript">
      // To make Pace works on Ajax calls
      $(document).ajaxStart(function() { Pace.restart(); });
        $('.ajax').click(function(){
            $.ajax({url: '#', success: function(result){
                $('.ajax-content').html('<hr>Ajax Request Completed !');
            }});
        });
    </script>

    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

  </body>
</html>
