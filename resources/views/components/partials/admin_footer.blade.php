<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">&copy; copyright @
            <?php echo date('Y'); ?> by <span>No name</span></span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ URL::asset('Dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ URL::asset('Dashboard/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('Dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('Dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/dataTables.select.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ URL::asset('Dashboard/js/off-canvas.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/hoverable-collapse.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/template.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/settings.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ URL::asset('Dashboard/js/dashboard.js') }}"></script>
<script src="{{ URL::asset('Dashboard/js/Chart.roundedBarCharts.js') }}"></script>
<!-- End custom js for this page-->
</body>

</html>
