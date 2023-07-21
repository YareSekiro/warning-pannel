<?php

session_start();
if(isset($_SESSION['user']) && isset($_SESSION['mdp']) && !empty($_SESSION['user']) && !empty($_SESSION['mdp']))
{
  
}
else
{
  header('location:../index.html');

}

require('bdd.php');
ini_set('display_errors','off');

$sql_request = 'SELECT img FROM users WHERE login="'.$_SESSION['user'].'"';
$sql_exec = mysqli_query($connexion , $sql_request);
foreach($sql_exec as $img)
{
  $img_profil = $img['img'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
<style>
tr:hover{
  background-color:#4e73df;
  color:white;
}
</style>
  <style>

* {
  box-sizing: border-box;
}
</style>
</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="panel.php">
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
    Accueil
  </div>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="panel.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  <hr class="sidebar-divider">

<div id="fonction">
  <!-- Heading -->
  <div class="sidebar-heading">
    Interne
  </div>

<?php 
if($_SESSION['perm'] == '3')
{

 echo'<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Utilisateurs</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Fonctions :</h6>
        <a class="collapse-item" href="user.php?f=list">Liste utilisateur</a>
        <a class="collapse-item" href="user.php?f=add">Ajouter un utilisateur</a>
        <a class="collapse-item" href="user.php?f=suppr">Supprimer un utilisateur</a>

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
            <?php echo'<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$_SESSION['user'].'</span>'; ?>
            <?php echo'<img class="img-profile rounded-circle" src="'.$img_profil.'">';?>
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo str_replace("_"," ",$_GET['player']);?></h1>
          </div>

            
<!-- Modal -->
<div class="modal fade" id="valid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">La bdd a bien été vidé.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add_user_good" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">L'avertossement a bien été ajouté !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
  </div>
</div>
         

          <!-- Content Row -->
          <div class="row">



         <!-- Begin Page Content -->
         <div class="container-fluid">
         <button type="button" id="add" onclick="showAddUser()" class="btn btn-outline-success btn-user btn-block">Ajouter un avertissement</button>


         <div class="container" id="add_user" style="display:none">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image:url(../img/wow.gif)"></div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">LE METAGAMING C MAL</h1>
              </div>
            <div id="form_user">
              <?php echo '<form class="user" action="add_new_averto_touser.php?player='.$_GET['player'].'" method="POST" >';?>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="number" name="number" placeholder="Numéro de l'avertissement" required autofocus>
                </div>
                <div class="form-group">
                <input type="text" class="form-control form-control-user" id="reason" name="reason" placeholder="Motif de la sanction" required autofocus>
                </div>
                <div class="form-group">
                <input type="text" class="form-control form-control-user" id="staff" name="staff" placeholder="Staff s'occupant de l'avertissement" required>
                </div> <hr>
                <button type="submit" class="btn btn-primary btn-user btn-block">Add User</button>
                  
                <hr>
              </form>
            </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4" style="margin-top:1%">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Compte rendu des avertissements</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Numéro</th>
            <th>Raisons</th>
            <th>Staff</th>
            <th>Date d'attribution</th>
            <th>Date de suppression</th>
          </tr>
        </thead>
        <tbody>
        <?php


        $sql_request = 'SELECT * FROM averto WHERE player="'.$_GET['player'].'"';
		$sql_exec = mysqli_query($connexion , $sql_request);



         foreach($sql_exec as $advert)//Pour chaque résultat
          {
             $play[] = $advert['player'];//On met un benef dans un tableau
             $number[] = $advert['number'];
             $reason[] = $advert['reason'];
			 $staff[] = $advert['staff'];
			 $date_last_avert[] = $advert['date_s'];
			 $date_suppr_avert[] = $advert['date_e'];
						
          }

         

          $size_of_total = sizeof($staff);


        for($i = 0; $i<$size_of_total ; $i++)//Boucle qui s'exécute sur le nombre de joueur total
        {
          
          echo'<tr><td class="column1">'.str_replace("_"," ",$number[$i]).'</td>
          <td class="column2">'.str_replace("_"," ",$reason[$i]).'</td>
          <td class="column3">'.str_replace("_"," ",$staff[$i]).'</td>
          <td class="column4">'.str_replace("_"," ",$date_last_avert[$i]).'</td>
          <td class="column5">'.str_replace("_"," ",$date_suppr_avert[$i]).'</tr>';


        }

        mysqli_close($connexion);

    /*

		$totaladvert;
		$sql_request = 'SELECT * FROM averto WHERE player="'.$player[$i].'"';
		$sql_exec = mysqli_query($connexion , $sql_request);



         foreach($sql_exec as $advert)//Pour chaque résultat
          {
             $play[] = $advert['player'];//On met un benef dans un tableau
			 $staff[] = $advert['staff'];
			 $date_last_avert[] = advert['date_s'];
			 $date_suppr_avert[] = advert['date_e'];
						
          }
					

		for($i = 0 ; i<$size_of_total ; $i++)
		{
		$last_advert = $totaladvert - 1;
		$date_last_avert;

		                       echo'<tr style="cursor:pointer" onClick=document.location.href="averto.php?player='.str_replace(" ","_",$player[$i]).'"><td class="column1">'.$player[$i].'</td>
		                        <td class="column2">'.$taille.'</td>
		                        <td class="column3">'.$date_last_avert.'</td>
		                        <td class="column4">'.$date_suppr_avert.'</td></tr>';
		}

mysqli_close($connexion);
*/



                                    ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <ul id="myUL">
      <?php

      for($i = 0 ; $i < $size_of_total ; $i++)
      {
        //echo'<div class="text-center" id="voitures">'.$vehicles[$i].'</div>';
        echo'<li><a style="onfocus:mouse" href="averto.php?player='.$player_list[$i].'">Nom : '.$player_list[$i].' | Nb avertissement : '.$player_nbaverto[$i].'</a></li>';
      }


      ?>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>





</div>
<!-- /.container-fluid -->

              
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; iFive Concess 2019</span>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sûr de vouloir vous déconnectez?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>  
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../js/demo/chart-area-demo.js"></script>
  <script src="../../js/demo/chart-pie-demo.js"></script>
  <script>
    var perm = '<?php echo $_SESSION['perm'];?>';
    if(perm !== '3')
    {
        document.getElementById("fonction").style.display = "none";
        document.getElementById("gestionemployé").style.display = "none";

    }

    var deletedmotherfucker = '<?php if(isset($_GET['s'])){echo $_GET['s'];}?>';
    if(deletedmotherfucker)
    {
      $('#valid').modal('toggle');
    }

    </script>

<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    
    filter = input.value.toUpperCase();
    console.log(filter);
    ul = document.getElementById("myUL");
    console.log(ul);
    li = ul.getElementsByTagName("li");
    console.log(li);
    
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
<script>

function showAddUser()
{
  document.getElementById('add_user').style.display = "block";


}

</script>

<script>

add_new_user_averto = `<?php if(isset($_GET['add'])){echo $_GET['add'];}?>`;
if(add_new_user_averto)
{
  $('add_user_good').modal('toggle');
}
</body>

</html>
