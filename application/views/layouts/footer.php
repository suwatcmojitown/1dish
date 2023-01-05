
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="<?php echo base_url();?>" target="_blank">SRI BHURAPA ORCHID</a> 2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    
    
    <script src="<?php echo base_url()?>app-assets/vendor/global/global.min.js"></script>
    <script src="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url()?>app-assets/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>app-assets/js/deznav-init.js"></script>

    <script src="<?php echo base_url()?>app-assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>app-assets/js/plugins-init/select2-init.js"></script>
    
         <!-- Form validate init -->
    <script src="<?php echo base_url()?>app-assets/js/plugins-init/jquery.validate-init.js"></script>

    
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          format: 'YYYY:MM:DD',
      },
      autoApply: true,
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ถึง ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

  $('input[name="datepick"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          format: 'YYYY:MM:DD',
      },
      singleDatePicker: true,
      autoApply: true,
  });

  $('input[name="datepick"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD'));
      a = document.getElementById("groupname").value;
      
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url('bill/loadGroupname')?>',
                data: 'keysearch='+a,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#groupname").html(result);
                } 
      });
  });

  $('input[name="datepick"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

  $('input[name="datepick_2"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          format: 'YYYY:MM:DD',
      },
      singleDatePicker: true,
      autoApply: true,
  });

  $('input[name="datepick_2"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD'));
      daterange = document.getElementById("datepick_2").value;
      $.ajax({
                type: 'POST',
                url: '<?php echo base_url('dashboard/loadContentList')?>',
                data: 'daterange='+daterange,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
      
      
  });

  $('input[name="datepick_2"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});

  

</script>


   <!-- Form Steps -->
    <script src="<?php echo base_url()?>app-assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>

    <script>
        $(document).ready(function(){
            // SmartWizard initialize
            $('#smartwizard').smartWizard(); 
        });

        function onFinishCallback(){
        $('#wizard').smartWizard('showMessage','Finish Clicked');
    } 
    </script>
    
</body>
</html>