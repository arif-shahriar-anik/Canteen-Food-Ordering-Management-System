<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Pricing</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<div class="bg">
<?php
 include 'Header.php';
?>
  <!-- Start your project here-->
  <main>
      <!-- Default form login -->
          <h5 class="card-header white-text text-center p-0 mt-2 mb-2">
              <strong>Did not sign up??</strong>
              <a href="index.php" target='_blank'><button type="button" class="btn btn-success btn-rounded z-depth-2 wow fadeInDown">Apply Now</button></a>
          </h5>
      <?php
      require 'Connection.php';
      $sql = "SELECT * FROM food ORDER BY F_ID";
      $result = $conn->query($sql);
      $allRows = $result->num_rows-1;
      $shift=0;
      if ($result->num_rows > 0) {
          $i=1;
          echo "<div class='row'>";
          while ($row = mysqli_fetch_array($result)) {
              if($i==($shift+1)) {
                  echo "<div class='row'>";
              }
              ?>
              <div class="col md-4 m-2 d-flex justify-content-center text-center">
                  <!-- Card Wider -->
                  <div class="card card-cascade wider wow fadeInDown">

                      <!-- Card Narrower -->
                      <div class="card card-cascade narrower">
                          <!-- Card image -->
                          <div class="view view-cascade overlay">
                              <?php
                              $img=$row["IMAGE"];
                              $img=$row["IMAGE"];
                              if(strpos($img,".")==false){
                                  /*echo $img;*/
                                  $img=$img.'.jpg';
                              }
                              echo"<img  class='card-img-top img-thumbnail' src='img/".$img."' style='width:310px; height: 256px;' alt='Card image cap'>"
                              ?>    <a>
                                  <div class="mask rgba-white-slight"></div>
                              </a>
                          </div>

                          <!-- Card content -->
                          <div class="card-body card-body-cascade">
                              <?php
                              echo"<h5 class='pink-text pb-2 pt-1'><i class='fa fa-cutlery'></i> ".$row["NAME"]."</h5>"
                              ?>   <!-- Title -->
                              <h4 class="font-weight-bold card-title"></h4>
                              <!-- Text -->
                              <?php
                              echo "<p class='card-text' style='font-size: 130%'><strong>".$row["PRICE"]."৳</strong></p>";
                              ?>
                          </div>
                      </div>
                      <!-- Card Regular -->
                  </div>
              </div> <?php
              if($i%4==0||$i==$allRows){
                  $shift=$i;
                  echo "</div>";
              }
              $i++;
          }
          /*echo $allRows;*/
          // Close result set
          mysqli_free_result($result);
      } else {
          echo "0 results";
      }
      ?>
      ?>
  </main>
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript">
    // Material Select Initialization
    $(document).ready(function() {
       $("#logout").hide();
       $("#profile").hide();
    });
    new WOW().init();
  </script>
</div>
</body>

</html>
<?php
?>