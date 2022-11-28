
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://dexignzone.com/" target="_blank">DexignZone</a> 2021</p>
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