<?php
 include('session.php');

 $sql = "SELECT * FROM tanks;";
if (mysqli_query($db, $sql))
{
   echo "";
}
 else
{
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}
$result = mysqli_query($db, $sql);
 $count = 0;
if (mysqli_num_rows($result) > 0)
 {
   // output data of each row

   while($row = mysqli_fetch_assoc($result))
 {
      $count++;
  }
 }
   else
  {
   echo "0 results";
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Water Level Monitoring System</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript">
            .carousel-inner{
              max-width:80%;
              max-height: 800px !important;
            }
        </script>
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="index.php"><h3>Water Level Monitoring System</h3><a>
                </div>

                <ul class="list-unstyled components">
                    <p>DashBoard</p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">SYSTEM ACTION</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                          <li><a href="current_tanks.php">CURRENT TANKS</a></li>
                        </ul>
                    </li>
                    <li>
                      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">SYSTEM MONITORING</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                          <li><a href="tanks_not_filled.php">TANKS FILLED</a></li>
                        </ul>

            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a >Welcome <?php echo $login_session; ?></a></li>
                                <li><a href="tank_details.html">Tanks Details</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="row">
                 <div class="col-sm-4" >
                   <div class="card  mb-3" style="max-width: 36rem;">
                     <div class="card-body">
                       <h3 class="card-title">Numbers of tanks</h3>
                       <p class="card-text"><h3><?php echo  $count; ?></h3></p>
                       <a href="current_tanks.php" class="btn btn-info">View Details</a>
                     </div>
                   </div>
                 </div>

                 <div class="col-sm-4">
                  <div class="card ">
                    <div class="card-body">
                      <h3 class="card-title">Supporting Area</h3>
                      <p class="card-text"><h4>click to see the details of supporting area and regions which we cover</h4></p>
                      <a href="buildings.php" class="btn btn-info">View Details</a>
                    </div>
                  </div>
                </div>

               </div>
  </div>
</div>






        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
