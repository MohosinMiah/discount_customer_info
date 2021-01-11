 <!-- Footer -->
 <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <strong> <a href="https://www.discounta2z.com/">DISCOUNTA2Z</a> &copy; All Right Researved.</strong>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="{{ URL::asset('/dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ URL::asset('/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ URL::asset('/dashboard/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ URL::asset('/dashboard/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ URL::asset('/dashboard/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ URL::asset('/dashboard/js/demo/chart-pie-demo.js') }}"></script>

{{-- Dashboard Script --}}
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


  {{-- Javascript  For Tool Tip *************************    --}}
  <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

</body>

</html>