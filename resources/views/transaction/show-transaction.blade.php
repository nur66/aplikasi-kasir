@include('transaction.template.component.header')


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('transaction.template.component.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        @include('transaction.template.content.show_transaction')
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('transaction.template.component.modal_logout')

    @include('transaction.template.component.cdn_script')

</body>

</html>