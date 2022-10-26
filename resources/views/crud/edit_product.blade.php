@include('crud.template.component.header')


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('crud.template.component.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        @include('crud.template.content.edit_product')
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('crud.template.component.modal_logout')

    @include('crud.template.component.cdn_script')

</body>

</html>