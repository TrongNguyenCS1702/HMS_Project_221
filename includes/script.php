    <!-- jQuery (with AJAX) -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap JS (with Popper.JS)-->
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery Custom Scroller -->
    <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>
    <!-- jQuery DataTables -->
    <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <!-- Custom JS -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>