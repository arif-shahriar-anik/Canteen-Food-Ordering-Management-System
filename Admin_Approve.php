<?php
        session_start();
require "Connection.php";
if(isset($_GET['counter'])) {
    $counter = $_GET['counter'];
    $i = 1;
    while ($i <= $counter) {
        /*echo "In Me 2";*/
        $content = 'id';
        $content = $content . $i;
        /*echo $content.' My Content';*/
        $data3="UPDATE order_info SET FLAG='PROCESSED' WHERE ORDER_NO=".$_GET[$content].";";
        if ($conn->query($data3) === TRUE) {
            /*echo "New amount updated successfully";*/
        } else {
            echo "Error: " . $data3 . "<br>" . $conn->error;
        }
        $i++;
    }
}
?><!DOCTYPE html>
<html lang="en" xmlns:https="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Approval</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .table-wrapper-scroll-y {
            display: block;
            max-height: 200px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            font-size: 1.2rem!important;
        }
        th,td{
            font-size: 1.4rem!important;
        }
        table.dataTable thead>tr>th {
            padding-right: 30px
        }
        table.dataTable thead {
            cursor: pointer;
            position: relative
            bottom: .5em;
            display: block;
            opacity: .3
        }
    </style>
</head>
<body>
<div class="bg-white">
<header>
    <?php include "Header.php";
    if (!$_SESSION['is_login']) {
        # code...
        die("<div class='alert alert-success mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
    }else {
        $uploadOk=1;
        echo "<div class='alert alert-success mt-3' role='alert'>";
        echo('Welcome! <strong>' . $_SESSION['name'] . '</strong></div>');
    }
    echo "<div class='text-center mt-2'>";
    echo "<h4 class=\"card-header text-center font-weight-bold py-2 z-depth-2 mt-2 success-color\">Order for <bold>" . date("Y-m-d") ." ".date("l") . "</bold></h4>";
    /*echo "<h2 class='text-info'>Order for <bold>" . date("Y-m-d") . "</bold></h2><br>";*/
    echo "</div>";
    if(isset($_POST['select_btn'])){

        foreach ($_POST['uname'] as $selectedOption)
            $data5="SELECT AMOUNT FROM clients WHERE EMAIL='".$selectedOption."';";
        $result5 = mysqli_query($conn, $data5);
        $row5=mysqli_fetch_array($result5);
        $amount=$row5["AMOUNT"];
        $data6="SELECT SUM(PRICE_TOTAL) FROM ORDER_INFO WHERE EMAIL='".$selectedOption."' AND FLAG='UNPROCESSED';";
        $result6 = mysqli_query($conn, $data6);
        $row6=mysqli_fetch_array($result6);
        $total=$row6["SUM(PRICE_TOTAL)"];
        $newAmount=$total+$amount;
        echo $amount." WAS BALANCE<br/>";
        echo $total." WAS EXPENDITURE";
        echo $newAmount." IS BALANCE NOW";
        $data7="UPDATE clients SET AMOUNT=".$newAmount." WHERE EMAIL='".$selectedOption."';";
        if ($conn->query($data7) === TRUE) {
            echo "New amount updated successfully";
        } else {
            echo "Error: " . $data7 . "<br>" . $conn->error;
        }
        $data4="DELETE FROM order_info WHERE EMAIL='".$selectedOption."' AND FLAG='UNPROCESSED';";
        if ($conn->query($data4) === TRUE) {
            echo "Food Deleted successfully";
        } else {
            echo "Error: " . $data4 . "<br>" . $conn->error;
        }
        echo $selectedOption."<br/>";
    }
    else if(isset($_POST['process_btn'])){
        foreach ($_POST['uname'] as $selectedOption)
            $data5="UPDATE order_info SET FLAG='PROCESSED' WHERE EMAIL='".$selectedOption."';";
        if ($conn->query($data5) === TRUE) {
            echo "FLAG updated successfully";
        } else {
            echo "Error: " . $data5 . "<br>" . $conn->error;
        }
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>
</header>
<main>
    <form action="Admin_Approve.php" method="post">
        <div class="row">
            <div class="col-md-5 container">
                <select name="uname[]" class="mdb-select md-form rgba-blue-grey-slight" multiple>
                    <option value="" disabled selected>Choose Client</option>
    <?php
    $sql3 = "SELECT COUNT(EMAIL),EMAIL FROM ORDER_INFO WHERE FLAG='UNPROCESSED' GROUP BY EMAIL;";
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
    $allRows3 = $result3->num_rows;
    while ($row3 = mysqli_fetch_array($result3)) {
      echo "<option value='".$row3["EMAIL"]."'>".$row3["EMAIL"]." (".$row3['COUNT(EMAIL)']."</span> Orders)</option>";
    }
    }
    else{
        echo "<div class='alert alert-warning' role='alert'>";
        echo "You no results for <strong>Select</strong>.";
        echo "</div>";
    }
    ?>
       <!-- <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>-->
    </select>
    <label>Select Client Cart</label>
    <button class="btn-save btn btn-danger tn-sm" type="submit" name="select_btn">Delete Cart</button>
                <button class="btn-save btn btn-outline-dark-green tn-sm" type="submit" name="process_btn">Process Cart</button>
    </div>
    </div>
    </form>
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2 mt-2 info-color"><i class="fa fa-user-plus" aria-hidden="true"></i> Pending Orders</h3>
    <div class="row">
        <div class="col">
            <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="th-sm">Email
                    </th>
                    <th class="th-sm">Food Name
                    </th>
                    <th class="th-sm">Order No
                    </th>
                    <th class="th-sm">Quantity
                    </th>
                    <th class="th-sm">Price Total
                    </th>
                    <th class="th-sm">Confirm
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr><?php
                  $sql = "SELECT * FROM order_info WHERE FLAG='UNPROCESSED' AND  ORDER_DATE='".date("Y-m-d")."' ORDER BY ORDER_NO;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $allRows = $result->num_rows;
                        while ($row = mysqli_fetch_array($result)){
                            echo "<td>".$row["EMAIL"]."</td>";
                            echo "<td>".$row["FNAME"]."</td>";
                            echo "<td>".$row["ORDER_NO"]."</td>";
                            echo "<td>".$row["QUANTITY"]."</td>";
                            echo "<td>".$row["PRICE_TOTAL"]."</td>";
                            echo "<td class>";
                            echo "<button type='button' class='btn btn-teal btn-rounded btn-sm m-0' onclick='remove(".$row["ORDER_NO"].")'>Process</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo $allRows;
                        /*Close result set*/
                        mysqli_free_result($result);
                    }else {
                        /*echo "You have no Item in Cart";*/
                        echo "<div class='alert alert-warning' role='alert'>";
                        echo "You have no pending <strong>Request</strong>.";
                        echo "</div>";
                    }
                    echo "</tbody>";
                    echo "<tfoot class='rgba-blue-grey-slight'>";
                    echo "<tr>";
                    echo "<th class='th-sm'>Email</th>";
                    echo "<th class='th-sm'>Food Name</th>";
                    echo "<th class='th-sm'>Order No</th>";
                    echo "<th class='th-sm'>Quantity</th>";
                    echo "<th class='th-sm'>Price Total</th>";
                    echo "<th class='th-sm'>Confirm</th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                    echo "<br/>";
//                    ?>
                    <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2 info-color"><i class="fa fa-calendar" aria-hidden="true"></i> Order History</h3>
                    <div class="row">
                        <div class="col">
                            <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="th-sm">Email
                                    </th>
                                    <th class="th-sm">Food Name
                                    </th>
                                    <th class="th-sm">Order No
                                    </th>
                                    <th class="th-sm">Quantity
                                    </th>
                                    <th class="th-sm">Price Total
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                    $sql = "SELECT * FROM order_info WHERE FLAG='PROCESSED' AND  ORDER_DATE='".date("Y-m-d")."'ORDER BY ORDER_NO;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $allRows = $result->num_rows;
                        $toatl=0;
                        while ($row = mysqli_fetch_array($result)){
                            echo "<td>".$row["EMAIL"]."</td>";
                            echo "<td>".$row["FNAME"]."</td>";
                            echo "<td>".$row["ORDER_NO"]."</td>";
                            echo "<td>".$row["QUANTITY"]."</td>";
                            echo "<td>".$row["PRICE_TOTAL"]."</td>";
                            echo "</tr>";
                            $toatl+=$row["PRICE_TOTAL"];
                        }
                        echo $allRows;
                        echo "<h4 class='text-center text-secondary text-uppercase'>Total Amount Sold ".$toatl."৳</h4>";
                        /*Close result set*/
                        mysqli_free_result($result);
                    }else {
                        /*echo "You have no Item in Cart";*/
                        echo "<div class='alert alert-warning' role='alert'>";
                        echo "You have no pending <strong>Request</strong>.";
                        echo "</div>";
                    }
                    echo "</tbody>";
                    echo "</tbody>";
                    echo "<tfoot class='rgba-blue-grey-slight'>";
                    echo "<tr>";
                    echo "<th class='th-sm'>Email</th>";
                    echo "<th class='th-sm'>Food Name</th>";
                    echo "<th class='th-sm'>Order No</th>";
                    echo "<th class='th-sm'>Quantity</th>";
                    echo "<th class='th-sm'>Price Total</th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "</table>";
                    echo "</table>";
                    $conn->close();
                    ?>
        </div>
    </div>
</main>
<footer>
    <div class="justify-content-center text-center">
    <a id="abc" href="Admin_Approve.php"><button class="btn btn-success" onclick="count()">Done</button></a>
    </div>
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
                                echo "<hr/>";
                                echo"<p><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i></i> Currently in charge of Approval and has Admin privilleges </p>";
                                ?>
                            </div>

                        </div>
                        <!-- Card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    link='Admin_Approve.php?';
    counter=0;
    function remove(val) {
        counter++;
        link=link+'id'+counter+'='+val;
        link=link+'&';
        document.getElementById('abc').href=link;
        alert(val+link);

    }
    function count() {
        temp=link+'counter='+counter;
        document.getElementById('abc').href=temp;
    }
</script>


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
</script>
</div>
</body>
</html>
<?php

?>