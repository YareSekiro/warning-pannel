<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jun#6666">

    <title>iFive Panel</title>

    <!-- Custom fonts for this template-->
    <link href="../../Extra/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../Extra/css/sb-admin-2.css" rel="stylesheet">
    <style>
        tr:hover{
            background-color:#4e73df;
            color:white;
        }
        i:hover{
            color:green;

        }
        i{
            cursor:pointer;
            margin-left:2%;
            transition-duration:1000ms;
        }
    </style>
    <style>

        * {
            box-sizing: border-box;
        }

        #myInput {
            /*background-image: url('/css/searchicon.png');*/
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color:#4e73df;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?redirect=panel">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">iFive<sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">



        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Home
        </div>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php?redirect=panel">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        <div id="fonction">

            <div class="sidebar-heading">
                Intra
            </div>


            <?php
            if($_SESSION['AVERTO_PERM'] == 1) {
                echo '
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                  <i class="fas fa-fw fa-folder"></i>
                  <span>Utilisateurs</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Fonctions :</h6>
                    <a class="collapse-item" href="index.php?redirect=user&f=list">User list</a>
                    <a class="collapse-item" href="index.php?redirect=user&f=add">Add new user</a>
                    <a class="collapse-item" href="index.php?redirect=user&f=delete">Delete user</a>
            
                  </div>
                </div>
              </li>';
            }
                ?>




        </div>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">



                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo'<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$_SESSION['AVERTO_USER'].'</span>'; ?>
                            <?php echo'<img class="img-profile rounded-circle" src="'.$_SESSION['AVERTO_IMG'].'">';?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?= $_get; ?>

            </div>
            <!-- /.container-fluid -->
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
            </div>

            </div> <!-- End of container fluid -->
            </div> <!-- End of row -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; iFive Panel 2019-2020</span>
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
<script src="../../Extra/vendor/jquery/jquery.min.js"></script>
<script src="../../Extra/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../Extra/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../Extra/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../Extra/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../Extra/js/demo/chart-area-demo.js"></script>


<script src="../../Extra/js/demo/chart-pie-demo.js"></script>
<?php
if(isset($_GET['redirect'])){
    if($_GET['redirect'] == "panel"){
        echo'
        <script src = "../../Extra/js/Warning/panel.js"></script>
        ';
    }

    if($_GET['redirect'] == "warning"){
        echo'
        <script src = "../../Extra/js/Warning/warning.js"></script>
        ';
    }

    if($_GET['redirect'] == "user"){
        echo'
        <script src = "../../Extra/js/Warning/user.js"></script>
        ';
    }

}
?>


<script>

    var deletedmotherfucker = '<?php if(isset($_GET['s'])){echo $_GET['s'];}?>';
    if(deletedmotherfucker)
    {
        $('#valid').modal('toggle');
    }

</script>



<script>

    add_new_user_averto = `<?php if(isset($_GET['add'])){echo $_GET['add'];}?>`;
    if(add_new_user_averto)
    {
        $('add_user_good').modal('toggle');
    }
</script>

    </body>

    </html>
