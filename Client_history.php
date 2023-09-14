<?php
session_cache_limiter('private, must-revalidate');
session_cache_expire(3);
session_start();
?><!DOCTYPE html>
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
    <style>
        table,th,td{
            font-size: 1.9rem!important;
        }
    </style>
</head>

<body>
<div class="bg-white">
<?php
include 'Header.php';
if (!$_SESSION['is_login']) {
    # code...
    die("<div class='alert alert-success mt-0 mb-0' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
}else{
    echo "<div class='alert alert-success mt-0 mb-0' role='alert'>";
    echo ('Welcome! <strong>'.$_SESSION['name'].'</strong>');
    echo "</div>";
}
if(isset($_POST['history_btn'])) {
    ?>
        <main>
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2 info-color"><i
                    class="fa fa-calendar" aria-hidden="true"></i> Order History</h3>
            <div class="row">
                <div class="col">
                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm text-center wow fadeInDownBig"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">Food Name
                            </th>
                            <th class="th-sm">Price Total
                            </th>
                            <th class="th-sm">Quantity
                            </th>
                            <th class="th-sm">Order No
                            </th>
                            <th class="th-sm">Order Date
                            </th>
                            <th class="th-sm">Image
                            </th>
                        </tr>
                        </thead>
                        <row>
                            <col>
                            <?php
                            require 'Connection.php';
                            $sql = "SELECT NAME,PRICE_TOTAL,QUANTITY,ORDER_NO,ORDER_DATE,IMAGE FROM (FOOD INNER JOIN ORDER_INFO ON NAME=FNAME) WHERE EMAIL='".$_SESSION['name']."' AND FLAG='PROCESSED' ORDER BY ORDER_NO DESC ;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $allRows = $result->num_rows;
                                $toatl = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<td>" . $row["NAME"] . "</td>";
                                    echo "<td>" . $row["PRICE_TOTAL"] . "</td>";
                                    echo "<td>" . $row["QUANTITY"] . "</td>";
                                    echo "<td>" . $row["ORDER_NO"] . "</td>";
                                    echo "<td>" . $row["ORDER_DATE"] . "</td>";
                                    $img=$row["IMAGE"];
                                    if(strpos($img,".")==false){
                                        /*echo $img;*/
                                     $img=$img.'.jpg';
                                    }
                                    /*echo $img;*/
                                    echo "<td>";
                                    echo " <div class=\"col-md-12 container\">";
                                    echo "<img src=\"img/".$img."\" class=\"img-fluid z-depth-1 rounded-circle\" style=\"height:10rem;\" alt=\".$img.\">";
                                    /*echo "<img  class='card-img-top img-thumbnail' src='img/". $img."' style='width:310px; height: 256px;' alt='Card image cap'>";*/
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $toatl += $row["PRICE_TOTAL"];
                                }
                                echo "<h4 class='text-center text-secondary text-uppercase mt-4'>Quantity Bought " . $allRows . " And Amount Bought " . $toatl . "৳</h4>";
                                /*Close result set*/
                                mysqli_free_result($result);
                            } else {
                                /*echo "You have no Item in Cart";*/
                                echo "<div class='alert alert-warning' role='alert'>";
                                echo "You have no pending <strong>Request</strong>.";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            echo "</tbody>";
                            echo "<tfoot class='rgba-blue-grey-slight'>";
                            echo "<tr>";
                            echo "<th class='th-sm'>Name</th>";
                            echo "<th class='th-sm'>Price Total</th>";
                            echo "<th class='th-sm'>Quantity</th>";
                            echo "<th class='th-sm'>Order No</th>";
                            echo "<th class='th-sm'>Order Date</th>";
                            echo "<th class='th-sm'>Image</th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "</table>";
                            $conn->close();
                            ?>
                            </col>
                        </row>
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
                $("#profile").hide();
            });
            new WOW().init();
        </script>
    </div>
    </body>
    </html>
    <?php
}
else{
    echo "Not Available";
}
?>