<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © CHENMT 2017-2018</small>
            <small>Proudly Presented by TKU IIT</small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<!--    <script src="vendor/chart.js/Chart.min.js"></script>-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="js/sb-admin-datatables.min.js"></script>
<!--<script type="text/javascript" src="/js/moment.js"></script>-->
<!--<script type="text/javascript" src="/js/tempusdominus-bootstrap-4.min.js"></script>-->
<!--    <script src="js/sb-admin-charts.min.js"></script>-->
<script>
    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var id = button.data('id');
        var recipients = button.data('recipients');
        var ptype = button.data('ptype');
        var storage = button.data('storage');
        var pid = button.data('pid');
        var timestamp_arrive = button.data('timestamp_arrive');
        var modal = $(this);
        modal.find('#rec').val(recipients);
        modal.find('#id').val(id);
        modal.find('#ptype').val(ptype);
        modal.find('#storage').val(storage);
        modal.find('#pid').val(pid);
        modal.find('.timestamp_arrive').val(timestamp_arrive);
    })
</script>
