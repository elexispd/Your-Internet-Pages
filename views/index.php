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
                  <h4 class="text-secondary">Attendance</h4>
                  <div class="card-body">
                    <div class="table-responsive pt-3">
                      <div id="alert"></div>
                      <table class="table table-striped project-orders-table" id="table_id">
                        <thead>
                          <tr>
                            <th class="ml-5">ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                          </tr>
                        </thead>

                        <tbody>                          
                          <?php 
                            if ($users["status"] == 200) {  $count = 0;
                              foreach ($users["message"] as $value) { ?>
                                <tr>
                                  <td><?= ++$count; ?></td>
                                  <td><?= $value["first_name"] . " " . $value["last_name"]; ?></td>
                                  <td>
                                    <div>
                                      <form action="../handlers/allHandlers.php" method="post" id="mark">
                                          <input type="" name="user_id" value="<?= $value["user_id"]; ?>" hidden id="uid">
                                          <button class="badge badge-primary border-0 p-2" type="submit" name="mark" value="present">
                                            <i class="fa fa-check"></i>
                                                Present
                                          </button>
                                          <button class="badge badge-danger border-0 p-2" type="submit" name="mark" value="absent">
                                            <i class="fa fa-times"></i>
                                                Absent
                                          </button>
                                      </form>
                                      
                                    </div>
                                  </td>
                              </tr>
                             <?php  }
                            ?>
                              
                            <?php } elseif ($users["status"] == 301) {
                                echo $user["message"];
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#success-alert").hide();
  $("button[name='mark']").click(function(){
    var mark = $(this).val();
    var user_id = $(this).siblings('input[name=user_id]').val(); 
    event.preventDefault();
    $.ajax({
      url: "../handlers/allHandlers.php",
      type: "POST",
      data: {user_id: user_id, mark: mark},
      success: function(response){
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
          $("#alert").slideUp(500);
        });
        console.log(response);
        var data = JSON.parse(response);
        $("#alert").html("<div class='alert alert-success'> <strong>Message! </strong>"+data["message"]+"</div>")
      }
    });
    return false;
  });
});
</script>



</body>
</html>

