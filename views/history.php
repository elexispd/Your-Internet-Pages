<?php 
  include_once "../handlers/allHandlers.php";
  if(!isset($_SESSION['admin'])) {
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="css/vertical-layout-light/custom.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css ">
</head>
<body>
  
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once 'partials/navbar.php'; ?>
    <script type="text/javascript">
      const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      const m = new Date();
      var month = months[m.getMonth()];
      document.querySelector('.date').innerHTML = "Today : " + month + " " + m.getDate();
    </script>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper mt-5">
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include_once 'partials/sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-secondary">Absentees' Salary</h4>
                  <div class="card-body">
                    <div class="table-responsive pt-3">
                      <table class="table table-striped project-orders-table" id="table_id">
                        <thead>
                          <tr>
                            <th class="ml-5">ID</th>
                            <th>Name</th>
                            <th>Salary</th>
                          </tr>
                        </thead>

                        <tbody>
                           <?php 
                            if ($absent["status"] == 200) {  $count = 0;
                              $current_salary = 10000;
                              $wage = 10000/20; //assuming there are 5 working days in a week
                              foreach ($absent["message"] as $value) { 
                                  $current_salary = $current_salary - $wage;
                              ?>
                                <tr>
                                  <td><?= ++$count; ?></td>
                                  <td><?= $value["full_name"] ?></td>
                                  <td><?= $current_salary; ?></td>
                              </tr>
                             <?php  }
                            ?>
                              
                            <?php } elseif ($absent["status"] == 301) {
                                echo $absent["message"];
                            } else {
                              echo "Something went wrong";
                            }
                            
                          ?>
                        </tbody>

                       <tbody>
                      
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once 'partials/footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
 
 
  <script src="js/dashboard.js"></script>
  
</body>

</html>

