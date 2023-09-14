<?php
session_start();
$uploadOk=0;
?>
    <!DOCTYPE html>
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
            .form-elegant .font-small {
                font-size: 0.8rem; }

            .form-elegant .z-depth-1a {
                -webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
                box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25); }

            .form-elegant .z-depth-1-half,
            .form-elegant .btn:hover {
                -webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
                box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15); }
            table,th,td{
                font-size: 1.2rem!important;
            }
        </style>
    </head>
<body>
<div class="blue-gradient-rgba">
<?php
include "Header.php";
if (!$_SESSION['is_login']) {
    # code...
    die("<div class='alert alert-success mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
}else {
    $uploadOk=1;
    echo "<div class='alert alert-success mt-3' role='alert'>";
    echo('Welcome! <strong>' . $_SESSION['name'] . '</strong></div>');
}
if($_SESSION['is_login']){
    echo "<main>";
    echo "<br/><br/>";
    ?><?php
    require 'Connection.php';
    if ((isset($_POST["add_btn"])) || (isset($_GET['counter']))) {
        echo "Logging In";
        $uploadOk = 0;
        require 'Connection.php';
        if (isset($_GET['counter'])) {
            $counter = $_GET['counter'];
            $i = 1;
            while ($i <= $counter) {
                /*echo "In Me 2";*/
                $content = 'id';
                $content = $content . $i;
                /*echo $content.' My Content';*/
                $data5 = "SELECT IMAGE FROM food WHERE F_ID =" . $_GET[$content] . ";";
//$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
                $result5 = mysqli_query($conn, $data5);
                $row5 = mysqli_fetch_array($result5);
                $imageFileName = $row5["IMAGE"];
                $path = "img/" . $imageFileName;
                unlink($path);
                $data4 = "DELETE FROM food WHERE F_ID=" . $_GET[$content] . ";";
                if ($conn->query($data4) === TRUE) {
                    echo $imageFileName;
                } else {
                    echo "Error: " . $data4 . "<br>" . $conn->error;
                }
                $i++;
            }
            $uploadOk = 1;
        }
        if (isset($_POST["add_btn"])) {
            echo "I'm Pressed";
            $encrypted = 1;
            $key = 1;
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
            // die($_POST["hideme"]);
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                /*echo "File is an image - " . $check["mime"] . ".";*/
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

// Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 2000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "JPG"
            ) {
                echo "Sorry, only JPG files are allowed.";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            if ($uploadOk == 1) {
                $name = $_FILES["fileToUpload"]["name"];
                /*echo $_FILES["fileToUpload"]["name"];*/
                /* $search = '.jpg';
                 $trimmed = str_replace($search, '', $name);*/
                /*  $data3 = "SELECT COUNT(F_ID) FROM FOOD;";
                  $result3 = mysqli_query($conn, $data3);
                  $row3 = mysqli_fetch_array($result3);
                  $foodNum = $row3["COUNT(F_ID)"] + 1;*/
                $sql1 = "SELECT * FROM food ORDER BY F_ID;";
                $result = $conn->query($sql1);
                $allRows = $result->num_rows;
                if ($result->num_rows > 0) {
                    $counter = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        if ($counter == $allRows - 1) {
                            $foodNum = $row["F_ID"];
                            break;
                        }
                        $counter++;
                    }
                }
                $foodNum++;
                echo $foodNum . " ORDERS";
                /* echo "<img src='img/".$_FILES["fileToUpload"]["name"]."'>";*/
                $data2 = "INSERT INTO food VALUES('" . $_POST["Name"] . "'," . $foodNum . "," . $_POST["Price"] . ",1,'" . $_FILES["fileToUpload"]["name"] . "');";
                if ($conn->query($data2) === TRUE) {
                    /* echo "New record created successfully";*/
                } else {
                    echo "Error: " . $data2 . "<br>" . $conn->error;
                }
            }
        } else {
            if ($uploadOk != 1) {
                /*$data = "SELECT AD_PASSWORD FROM admin WHERE AD_EMAIL ='" . $_POST["Email"] . "';";
    //$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
                $result2 = mysqli_query($conn, $data);
                $row2 = mysqli_fetch_array($result2);
                $key = $row2["AD_PASSWORD"];
                $encrypted = sha1($_POST["Password"]);*/

            } else {
                $encrypted = 1;
                $key = 1;
            }
        }
    }
        if (($uploadOk == 1)||($_SESSION['is_login']) ){
            /*echo "<h3>CORRECT PASSWORD</h3>";*/
            ?>
            <div class="row">
                <!--<div class="col-md-2">

                </div>-->
                <div class='col-md-8 container'>
                    <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab"
                               aria-controls="home-md" aria-selected="true">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add Food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab"
                               aria-controls="profile-md" aria-selected="false"><i class="fa fa-minus-circle"
                                                                                   aria-hidden="true"></i> Delete
                                Food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab"
                               aria-controls="contact-md" aria-selected="false">Order Details</a>
                        </li>
                    </ul>
                    <div class="tab-content card pt-5" id="myTabContentMD">
                        <div class="tab-pane fade show active" id="home-md" role="tabpanel"
                             aria-labelledby="home-tab-md">
                            <form action="Admin_panel.php" method="post" enctype="multipart/form-data">
                                <section class="form-elegant">

                                    <!--Form without header-->
                                    <div class="card">

                                        <div class="card-body mx-4">

                                            <!--Header-->
                                            <div class="text-center">
                                                <h3 class="dark-grey-text mb-5"><strong>Fill in Details</strong></h3>
                                            </div>

                                            <!--Body-->
                                            <div class="md-form">
                                                <input type="text" id="Form-email1" name="Name" class="form-control">
                                                <label for="Form-email1">Food Name</label>
                                            </div>

                                            <div class="md-form pb-3">
                                                <input type="number" name="Price" id="Form-pass1" class="form-control">
                                                <label for="Form-pass1">Price</label>
                                            </div>

                                            <div class="md-form">
                                                <div class="row">
                                                    <div class="col">
                                                        <i>Select image to upload:</i>&nbsp;&nbsp;
                                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="text-center mb-3">
                                                <button type="submit" name="add_btn"
                                                        class="btn blue-gradient btn-block btn-rounded z-depth-1a"><i
                                                            class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    Add Food
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                    <!--/Form without header-->
                                </section>
                                <input type="hidden" name="Email" value=" <?php echo $_POST["Email"]; ?>"/>
                            </form>
                            <br/>
                            <div class="justify-content-center text-center">
                                <a id="abc2" href="Admin_Approve.php" target="_blank">
                                    <button class="btn btn-success">Approve Order</button>
                                </a>
                                <form action="Clients_list.php" target="_blank" method="get">
                                    <button class="btn btn-outline-dark-green btn-rounded" type="submit" name="clientslist_btn">View Clients</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
                            <div class="row">
                                <div class="col">
                                    <table id="dtVerticalScrollExample"
                                           class="table table-striped table-bordered table-sm text-center"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th class="th-sm">Food
                                            </th>
                                            <th class="th-sm">Food ID
                                            </th>
                                            <th class="th-sm">Price
                                            </th>
                                            <th class="th-sm">Confirm
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr> <?php
                                            $sql = "SELECT * FROM food ORDER BY F_ID;";
                                            $result = $conn->query($sql);
                                            $allRows = $result->num_rows;
                                            if ($result->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<td>" . $row["NAME"] . "</td>";
                                                    echo "<td>" . $row["F_ID"] . "</td>";
                                                    echo "<td>" . $row["PRICE"] . "</td>";
                                                    echo "<td class>";
                                                    echo "<button type='button' class='btn btn-danger btn-rounded btn-sm m-0' onclick='remove(" . $row["F_ID"] . ")'><i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i> Remove</button>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                /*Close result set*/
                                                mysqli_free_result($result);
                                            } else {
                                                /*echo "You have no Item in Cart";*/
                                                echo "<div class='alert alert-warning' role='alert'>";
                                                echo "You have no pending <strong>Request</strong>.";
                                                echo "</div>";
                                            }
                                            echo "</tbody>";
                                            echo "<tfoot class='rgba-grey-slight'>";
                                            echo "<tr>";
                                            echo "<th class='th-sm'>Food</th>";
                                            echo "<th class='th-sm'>Food ID</th>";
                                            echo "<th class='th-sm'>Price</th>";
                                            echo "<th class='th-sm'>Confirm</th>";
                                            echo "</tr>";
                                            echo "</tfoot>";
                                            echo "</table>";
                                            ?>
                                </div>
                            </div>
                            <div class="justify-content-center text-center">
                                <a id="abc" href="Admin_panel.php">
                                    <button class="btn btn-success" onclick="count()">Done</button>
                                </a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
                            <div class="row">
                                <div class="col">
                                    <table id="dtVerticalScrollExample"
                                           class="table table-striped table-bordered table-sm text-center"
                                           cellspacing="0"
                                           width="100%">
                                        <thead>
                                        <tr>
                                            <th class="th-sm">Food Name
                                            </th>
                                            <th class="th-sm">Sold Quantity
                                            </th>
                                            <th class="th-sm">Sold Amount
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr> <?php
                                            $sql4 = "SELECT NAME,SUM(QUANTITY),SUM(PRICE_TOTAL) FROM (ORDER_INFO JOIN FOOD ON FNAME=NAME) WHERE FLAG='PROCESSED' GROUP BY NAME;";
                                            $result4 = $conn->query($sql4);
                                            if ($result4->num_rows > 0) {
                                                $total = 0;
                                                $itemSold = 0;
                                                while ($row4 = mysqli_fetch_array($result4)) {
                                                    echo "<td>" . $row4["NAME"] . "</td>";
                                                    echo "<td>" . $row4["SUM(QUANTITY)"] . "</td>";
                                                    echo "<td>" . $row4["SUM(PRICE_TOTAL)"] . "৳</td>";
                                                    echo "</tr>";
                                                    $total += $row4["SUM(PRICE_TOTAL)"];
                                                    $itemSold += $row4["SUM(QUANTITY)"];
                                                }
                                                /*Close result set*/
                                                mysqli_free_result($result4);
                                            } else {
                                                /*echo "You have no Item in Cart";*/
                                                echo "<div class='alert alert-warning' role='alert'>";
                                                echo "You have no sold <strong>Item</strong>.";
                                                echo "</div>";
                                            }
                                            echo "</tbody>";
                                            echo "<tfoot class='rgba-grey-slight'>";
                                            echo "<tr>";
                                            echo "<th class='th-sm'>Food Name</th>";
                                            echo "<th class='th-sm'>Sold Quantity</th>";
                                            echo "<th class='th-sm'>Sold Amount</th>";
                                            echo "</tfoot>";
                                            echo "</table>";
                                            $data6 = "SELECT MAX(T) FROM (SELECT SUM(QUANTITY) AS T,FNAME AS F FROM ORDER_INFO AS O WHERE FLAG='PROCESSED' GROUP BY FNAME) AS A;";
                                            //$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
                                            $result6 = mysqli_query($conn, $data6);
                                            $row6 = mysqli_fetch_array($result6);
                                            $maxSoldQuantity = $row6["MAX(T)"];
                                            $data7 = "SELECT F FROM (SELECT SUM(QUANTITY) AS T,FNAME AS F FROM ORDER_INFO AS O WHERE FLAG='PROCESSED' GROUP BY FNAME) AS A WHERE T=".$maxSoldQuantity.";";
                                            //$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
                                            $result7 = mysqli_query($conn, $data7);
                                            $row7 = mysqli_fetch_array($result7);
                                            $maxSoldItem = $row7["F"];
                                            echo "<h4 class='text-center text-secondary text-uppercase'>Total Amount Sold <strong>" . $total . "৳</strong></h4>";
                                            echo "<h4 class='text-center text-secondary'>Total Item Sold: <b>" . $itemSold . "</b>&nbsp;&nbsp;&nbsp;&nbsp;Highest Sold: <b>" . $maxSoldItem . "</b></h4>";
                                            $conn->close();
                                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  <div class="col-md-2">

                  </div>-->
            </div>
            <?php
        }
}
    ?>
    <br/> <br/> <br/><br/><br/>
    </main>
    <footer>
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
</div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script type="text/javascript">
    link='Admin_panel.php?';
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
</body>
</html>
<?php

?>
