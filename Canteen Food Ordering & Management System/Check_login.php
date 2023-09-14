<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Canteen Management System</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        img {
            width: 128px;
            height: 128px;
        }
        table,td,th{
            font-size: xx-large;
        }
    </style>
</head>
<body>
<div class="bg">
    <?php
    /**
     * Created by PhpStorm.
     * User: HP
     * Date: 11/19/2018
     * Time: 9:59 PM
     */
    include 'Header.php';
    if (!$_SESSION['is_login']) {
        # code...
        die("<div class='alert alert-success mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
    }else {
        echo "<div class='alert alert-success mt-3' role='alert'>";
        echo('Welcome! <strong>' . $_SESSION['name'] . '</strong>');
        echo "</div>";
    }
    echo "<main>";
   //if(isset($_POST["submit_btn"])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Canteen";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            /*echo "Connected";*/
        }
    if(isset($_POST["recharge_btn"])) {
        $data6 = "UPDATE clients SET AMOUNT=AMOUNT+" . $_POST["rechargeAmount"] . " WHERE EMAIL='" . $_SESSION["name"] . "';";
        if ($conn->query($data6) === TRUE) {
            echo "Amount Recharged successfully";
        } else {
            echo "Error: " . $data6 . "<br>" . $conn->error;
        }
    }
        /*$data="SELECT PASSWORD FROM clients WHERE EMAIL ='".$_POST["Email"]."';";
//$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
        $result1 = mysqli_query($conn, $data);
        $row1=mysqli_fetch_array($result1);
        $key=$row1["PASSWORD"];
        $encrypted=sha1($_POST["Password"]);
        if($encrypted==$key) {
            $_SESSION['is_login']=true;
            $_SESSION['name']=$_POST['Email'];
            /*echo "<h3>CORRECT PASSWORD</h3>";*/
            $sql = "SELECT * FROM food ORDER BY F_ID";
            $result = $conn->query($sql);
            $allRows = $result->num_rows - 1;
            $shift = 0;
            if ($result->num_rows > 0) {
                $i = 1;
                $link = "";
                echo "<div class='row'>";
                while ($row = mysqli_fetch_array($result)) {
                    if ($i == ($shift + 1)) {
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
                                    if(strpos($img,".")==false){
                                        /*echo $img;*/
                                     $img=$img.'.jpg';
                                    }
                                    /*echo $img;*/
                                    echo "<img  class='card-img-top img-thumbnail' src='img/". $img."' style='width:310px; height: 256px;' alt='Card image cap'>";
                                    ?> <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <form method="get" action="">
                                <!-- Card content -->
                                <div class="card-body card-body-cascade">
                                    <?php
                                    echo "<h5 class='pink-text pb-2 pt-1'><i class='fa fa-cutlery'></i> " . $row["NAME"] . "</h5>";
                                    /* echo "<input type='hidden' name='P_id' value='" . $row['F_ID'] . "'>";*/ ?>
                                    <!-- Title -->
                                    <h4 class="font-weight-bold card-title"></h4>
                                    <!-- Text -->
                                    <?php
                                    echo "<p class='card-text' style='font-size: 130%'><strong>" . $row["PRICE"] . "৳</strong></p>";
                                    /*<!-- Button -->*/
                                    echo "<a class='btn btn-unique' href='Test.php?name=" . $row["NAME"] . "&email=" . $_SESSION['name'] . "&price=" . $row["PRICE"] . "'><i class='fa fa-cart-arrow-down' aria-hidden='true'></i> Add to Cart</a>";
                                    echo "<div class='d-flex justify-content-center'>";
                                    echo "</div>";
                                    ?>

                                </div>
                                </form>
                            </div>
                            <!-- Card Regular -->
                        </div>
                    </div> <?php
                    if ($i % 4 == 0 || $i == $allRows) {
                        $shift = $i;
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
        /*}
    else{
            echo "<h3>INCORRECT PASSWORD</h3>";
        }*/
        echo "</main>";
    //}
    ?>
    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
    <div class="row">
        <div class="col z-depth-2 container">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Background color -->
                <div class="card-up secondary-color lighten-1"></div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="img/user-account.jpg" class="rounded-circle" alt="woman avatar">
                </div>

                <!-- Content -->
                <div class="card-body">
                    <?php
                    echo "<h5 class='card-title'>Email: ".$_SESSION["name"]."</h5>";
                    $data2="SELECT FNAME,LNAME,AMOUNT FROM clients WHERE EMAIL ='".$_SESSION["name"]."';";
                    $result2 = mysqli_query($conn, $data2);
                    $row2=mysqli_fetch_array($result2);
                    echo "<h4 class='card-title'>".$row2["FNAME"]." ".$row2["LNAME"]."</h4>";
                    echo "<hr/>";
                    if($row2["AMOUNT"]<=100){
                        echo "<div class='alert alert-danger mt-3' role='alert'>Insufficient Balannce <strong>Please Recharge</strong></div>";
                    }
                    echo"<p><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i></i> <b>Balance: </b>".$row2["AMOUNT"]."৳</p>";
                    ?>
                </div>
                   <form method="post" action="Client_history.php" class="text-center mt-0 md-0 pt-0 pd-0">
                       <button type="submit" class="btn btn-primary btn-sm" name="history_btn">Order History</button>
                   </form>
            </div>
            <!-- Card -->
        </div>
    </div>
            </div>
        </div>
    </div>
    <?php
    $conn->close();
    echo "<div class=\"text-center\">";
    echo "<a type=\"button\" class=\"btn btn-success btn-rounded\" data-toggle='modal' data-target=\"#centralModalSm\"><i class=\"fa fa-bank\" aria-hidden=\"true\"> Recharge</i></a>";
    echo "</div>";
    ?>
<footer>
    <!-- Central Modal Small -->
    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-sm" role="document">
            <form action="Check_login.php" method="post">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <!-- Default input -->
                                <label for="exampleForm2">Enter Amount <i class="fa fa-credit-card" aria-hidden="true"></i> <i class="fa fa-cc-visa" aria-hidden="true"></i> <i class="fa fa-cc-amex" aria-hidden="true"></i>
                                    <i class="fa fa-paypal" aria-hidden="true"></i>
                                </label>
                                <input type="number" class="form-control" id="exampleForm2" name="rechargeAmount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="recharge_btn">Recharge Now</button>
                    </div>
        </div>
        </form>
    </div>
    <!-- Central Modal Small -->
</footer>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript">
    new WOW().init();
</script>
</body>
</html>

<?php
?>