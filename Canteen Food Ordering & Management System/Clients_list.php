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
    <title>User List</title>
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
<div class="bg-light">
    <?php
    include 'Header.php';
    if (!$_SESSION['is_login']) {
        # code...
        die("<div class='alert alert-success mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
    }else {
        $uploadOk=1;
        echo "<div class='alert alert-success mt-3' role='alert'>";
        echo('Welcome! <strong>' . $_SESSION['name'] . '</strong></div>');
    }
    if(isset($_GET['clientslist_btn'])) {
    ?>
    <main>
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2 info-color"><i class="fa fa-search-plus" aria-hidden="true"></i> Search Result</h3>
        <div class="row">
            <div class="col">
                <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm text-center wow fadeInDownBig"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">First Name
                        </th>
                        <th class="th-sm">Last Name
                        </th>
                        <th class="th-sm">Email
                        </th>
                        <th class="th-sm">Amount
                        </th>
                    </tr>
                    </thead>
                    <row>
                        <col>
                        <?php
                        require 'Connection.php';
                        $sql = "SELECT * FROM CLIENTS ORDER BY AMOUNT DESC ;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $allRows = $result->num_rows;
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<td>" . $row["FNAME"] . "</td>";
                                echo "<td>" . $row["LNAME"] . "</td>";
                                echo "<td>" . $row["EMAIL"] . "</td>";
                                echo "<td>" . $row["AMOUNT"] . "</td>";
                                echo "</tr>";
                            }
                            echo "<h4 class='text-center text-secondary text-uppercase mt-4'>" . $allRows ." Results Found</h4>";
                            /*Close result set*/
                            mysqli_free_result($result);
                        } else {
                            /*echo "You have no Item in Cart";*/
                            echo "<div class='alert alert-warning' role='alert'>";
                            echo "You have no <strong>Result</strong>.";
                            echo "</div>";
                        }
                        echo "</tbody>";
                        echo "</tbody>";
                        echo "<tfoot class='rgba-blue-grey-slight'>";
                        echo "<tr>";
                        echo "<th class='th-sm'>First Name</th>";
                        echo "<th class='th-sm'>Last Name</th>";
                        echo "<th class='th-sm'>Email</th>";
                        echo "<th class='th-sm'>Amount</th>";
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