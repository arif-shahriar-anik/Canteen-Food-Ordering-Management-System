<?php
session_start();
if (isset($_POST['logIn_btn'])) {
    require 'Connection.php';
    $data = "SELECT AD_PASSWORD FROM admin WHERE AD_EMAIL ='" . $_POST["Email"] . "';";
//$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
            $result2 = mysqli_query($conn, $data);
            $row2 = mysqli_fetch_array($result2);
            $key = $row2["AD_PASSWORD"];
            $encrypted = sha1($_POST["Password"]);
            if($encrypted==$key){
                $_SESSION['is_login'] = true;
                $_SESSION['name'] = $_POST['Email'];
                $_SESSION['error']=false;
                header('Location: Admin_panel.php');
                die('passed :)');
            }
            else{
                $_SESSION['error']=true;
                header('Location: index.php');
                die('passed :)');
            }
            $conn->close();
}elseif(isset($_POST["signUp_btn"])) {
    require 'Connection.php';
    echo "Signing Up <br/>";
    if($_POST["Password"]==$_POST["Password_match"]){
        $sql = "INSERT INTO admin VALUES('" . $_POST["Email"] . "','" . sha1($_POST["Password"]) . "',null);";
        if ($conn->query($sql) === TRUE) {
            /*echo "New record created successfully";*/
            $_SESSION['error']=false;
            header('Location: index.php');
            die('passed :)');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    else{
        $_SESSION['error']=true;
        header('Location: index.php');
        die('passed :)');
    }
}
else {
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
    </head>
    <body>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        </script>-->
    <div class="blue-gradient-rgba">
        <!-- Start your project here-->
        <header>
            <!--Navbar-->
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark indigo container-fluid">
                    <div class="container">
                        <!--Sign Up Button-->
                        <!-- Navbar brand -->
                        <a class="navbar-brand wow shake" href="#"><h2>Canteen</h2></a>

                        <!-- Collapse button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#basicExampleNav"
                                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Collapsible content -->
                        <div class="collapse navbar-collapse" id="basicExampleNav">
                            <!-- Links -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Pricing.php">Pricing</a>
                                </li>

                                <!-- Dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">Panels</a>
                                    <div class="dropdown-menu dropdown-primary"
                                         aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modalLRForm">Admin
                                            Panel</a>
                                        <a class="dropdown-item" href="Login.php">User Panel</a>
                                    </div>
                                </li>
                            </ul>
                            <!-- Links -->
                            <a style="color: white" href="#signUpForm">
                                <button type="button" class="btn btn-white btn-rounded z-depth-2 wow fadeInDown"
                                        style="background-color: #6100FF!important; color: white!important;">Apply Now
                                </button>
                            </a>
                            <form class="form-inline" action="Search.php" target="_blank" method="get">
                                <div class="md-form my-0">
                                    <input class="form-control mr-sm-2" type="text" name="Search" placeholder="Search"
                                           aria-label="Search" style="color: white">
                                    <button class="btn btn-info btn-rounded z-depth-2" type="submit" name="search_btn" style="background-color: #6100FF!important"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
                                </div>
                            </form>
                            &nbsp;&nbsp;&nbsp;<a href="Login.php">
                                <button type="button" class="btn btn-white btn-rounded z-depth-2 wow fadeInDown"
                                        style="background-color: #6100FF!important; color: white!important;">Log In
                                </button>
                            </a>
                            <!--<button type="button" class="btn aqua-gradient z-depth-2" style="background-color: #6100FF!important;"><a href="LogIn.html">Log In</a></button>-->
                            <!--Buttons-->
                        </div>
                        <!-- Collapsible content -->
                    </div>
                </nav>
                <!--/.Navbar-->
            </div>
        </header>
        <main>
            <div class="row">
                <div class="col-md-12 mb-3">

                    <img src="img/CoffeeHD1.jpg" class="img-fluid z-depth-1" alt="Responsive image">

                </div>
            </div>
            <?php
            if(array_key_exists('error',$_SESSION)) {
                if ($_SESSION['error']) {
                    echo "<div class='alert alert-danger mt-3' role='alert'>INCORRECT PASSWORD</div>";
                }
                unset($_SESSION['error']);
            }
            ?>
            <br/>
            <div class="row">
                <!-- Classic tabs -->
                <div class="classic-tabs mx-2 white m-3 w-100 z-depth-2">

                    <ul class="nav tabs-indigo" id="myClassicTabShadow" role="tablist">
                        &nbsp;
                        <li class="nav-item">
                            <a class="nav-link  waves-light active show" id="profile-tab-classic-shadow"
                               data-toggle="tab" href="#profile-classic-shadow" role="tab"
                               aria-controls="profile-classic-shadow" aria-selected="true"><b>Opening Hours</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-light" id="follow-tab-classic-shadow" data-toggle="tab"
                               href="#follow-classic-shadow" role="tab" aria-controls="follow-classic-shadow"
                               aria-selected="false"><b>Follow Us</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link waves-light" id="contact-tab-classic-shadow" data-toggle="tab"
                               href="#contact-classic-shadow" role="tab" aria-controls="contact-classic-shadow"
                               aria-selected="false"><b>Contact</b></a>
                        </li>
                    </ul>
                    <div class="tab-content card p-3 w-100" id="myClassicTabContentShadow">
                        <div class="tab-pane fade active show" id="profile-classic-shadow" role="tabpanel"
                             aria-labelledby="profile-tab-classic-shadow">
                            <p class="text-success" style="font-size: 120%;">Welcome! We open at 9:30AM and close at
                                6:00PM. We are closed on Friday. </p>
                        </div>
                        <div class="tab-pane fade" id="follow-classic-shadow" role="tabpanel"
                             aria-labelledby="follow-tab-classic-shadow">
                            <p class="text-success" style="font-size: 120%;">Please like and follow us on Facebook to
                                get the latest updates about Food Menus.</p>
                            <a style="color: lightseagreen; font-size: 150%;"
                               href="https://www.facebook.com/BRACUniversity/" target="_blank">BRAC Caffee</a>
                        </div>
                        <div class="tab-pane fade" id="contact-classic-shadow" role="tabpanel"
                             aria-labelledby="contact-tab-classic-shadow">
                            <p class="text-success" style="font-size: 120%;">You can contact us via phone number <span
                                    style="font-size: 130%; color: #0e4377">(+880) 02-893778</span> or email address
                                <span style="font-size: 130%;color: #0e4377">arifanik28@gmail.com</span></p>
                            <p class="text-success" style="font-size: 120%;">Find us at <strong>UB-3</strong> and
                                <strong>UB-2</strong> at <span style="font-size: 130%; color: #0e4377">BRAC University,66/Mohakhali</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Classic tabs -->
            <div class="row">
                <div class="col-md-8">
                    <!-- Default form register -->
                    <form class="text-center p-3" action="Login.php" method="post" name="signUpForm" id="signUpForm">
                        <h4 style="color: white">Didn't join our family? Join now.</h4>
                        <hr/>
                        <div class="form-row mb-4">
                            <div class="col">
                                <!-- First name -->
                                <input type="text" id="defaultRegisterFormFirstName" class="form-control" name="Fname"
                                       placeholder="First name">
                            </div>
                            <div class="col">
                                <!-- Last name -->
                                <input type="text" id="defaultRegisterFormLastName" class="form-control" name="Lname"
                                       placeholder="Last name">
                            </div>
                        </div>

                        <!-- E-mail -->
                        <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" name="Email"
                               placeholder="E-mail">

                        <!-- Password -->
                        <input type="password" id="defaultRegisterFormPassword" class="form-control"
                               placeholder="Password" name="Password"
                               aria-describedby="defaultRegisterFormPasswordHelpBlock">
                        <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                        </small>
                        <div class="form-row mb-4">
                            <div class="col">
                                <input type="number" id="Payment" class="form-control mb-3" placeholder="Enter Amount"
                                       name="Amount">
                            </div>
                            <div class="col">
                                <div class="panel panel-default credit-card-box container col">
                                    <div class="panel-heading display-table">
                                        <div class="row display-tr">
                                            <h3 class="panel-title display-td">We only accept</h3>
                                            <div class="display-td">
                                                <img class="img-responsive pull-right"
                                                     src="http://i76.imgup.net/accepted_c22e0.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Payment Gateway-->
                            </div>
                        </div>
                        <!--In Same Line-->
                        <!-- Sign up button -->
                        <button class="btn btn-indigo my-4 btn-block" type="submit" name="submitttt">Sign Up Now
                        </button>
                    </form>
                    <!-- Default form register -->
                </div>
                <div class="col-md-4">
                    <br/>
                    <div class="card m-3">
                        <div class="card-header indigo text-center">
                            <p style="color: white">Popular Menus</p>
                        </div>
                        <ul class="list-group list-group-flush text-center">
                            <li class="list-group-item">Burger</li>
                            <li class="list-group-item">Lunch Set Menu</li>
                            <li class="list-group-item">B-B-Q Chicken & Tanduri</li>
                            <li class="list-group-item">Hyderabadi Biryani</li>
                            <li class="list-group-item">Pizza</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- Section: Products v.1 -->
                    <section class="text-center my-5">

                        <!-- Section heading -->
                        <div class="card-header indigo text-center z-depth-2 container-fluid">
                            <p style="color: white">
                            <h2 class="embed-responsive-4by3" style="color: white"><strong>Our Bestsellers</strong>
                            </h2></p>
                        </div>

                        <hr/>
                        <!-- Grid row -->
                        <div class="row">

                            <!-- Grid column -->
                            <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                                <!-- Card -->
                                <div class="card card-cascade narrower card-ecommerce">
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img src="img/drink-1.jpg" class="img-fluid img-thumbnail"
                                             style="width:300px; height: 256px;"
                                             alt="Orange juice">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <!-- Card image -->
                                    <!-- Card content -->
                                    <div class="card-body card-body-cascade text-center">
                                        <!-- Category & Title -->
                                        <a href="" class="grey-text">
                                            <h5>Bevarage</h5>
                                        </a>
                                        <h4 class="card-title">
                                            <strong>
                                                <a href="">Orange Juice</a>
                                            </strong>
                                        </h4>
                                        <!-- Description -->
                                        <p class="card-text">Pure and refreshing orange juice...Energize yourself!
                                        </p>
                                        <!-- Card footer -->
                                        <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>20৳</strong>
            </span>
                                        </div>
                                    </div>
                                    <!-- Card content -->
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
                                <!-- Card -->
                                <div class="card card-cascade narrower card-ecommerce">
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img src="img/Pizza-1.jpg" class="img-fluid img-thumbnail mx-auto"
                                             style="width:300px;height: 256px;"
                                             alt="Pizza photo">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <!-- Card image -->
                                    <!-- Card content -->
                                    <div class="card-body card-body-cascade text-center">
                                        <!-- Category & Title -->
                                        <a href="" class="grey-text">
                                            <h5>Pizza</h5>
                                        </a>
                                        <h4 class="card-title">
                                            <strong>
                                                <a href="">Six Seasons Pizza</a>
                                            </strong>
                                        </h4>
                                        <p class="card-text">Six Seasons Pizza served with Chicken, Cheese & Mushrooms.
                                        </p>
                                        <!-- Card footer -->
                                        <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>350৳</strong>
            </span>
                                        </div>
                                    </div>
                                    <!-- Card content -->
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-lg-3 col-md-6 mb-md-0 mb-4">
                                <!-- Card -->
                                <div class="card card-cascade narrower card-ecommerce">
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img src="img/Biriani.jpg" class="img-fluid img-thumbnail"
                                             style="height: 256px;">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <!-- Card image -->
                                    <!-- Card content -->
                                    <div class="card-body card-body-cascade text-center">
                                        <!-- Category & Title -->
                                        <a href="" class="grey-text">
                                            <h5>Biriani</h5>
                                        </a>
                                        <h4 class="card-title">
                                            <strong>
                                                <a href="">Chicken Bar-B-Q Biriani</a>
                                            </strong>
                                        </h4>
                                        <!--Rating-->
                                        <p class="card-text">Chicken Bar-b-q Biriani served hot with drinks.
                                        </p>
                                        <!-- Card footer -->
                                        <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>150৳</strong>
            </span>
                                        </div>
                                    </div>
                                    <!-- Card content -->
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-lg-3 col-md-6">
                                <!-- Card -->
                                <div class="card card-cascade narrower card-ecommerce">
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img src="img/Burger-1.jpg" class="img-fluid img-thumbnail pl-3"
                                             style="width:300px; height: 256px;" alt="Burger_image">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                    <!-- Card image -->
                                    <!-- Card content -->
                                    <div class="card-body card-body-cascade text-center">
                                        <!-- Category & Title -->
                                        <a href="" class="grey-text">
                                            <h5>Burger</h5>
                                        </a>
                                        <h4 class="card-title">
                                            <strong>
                                                <a href="">Chicken Cheese Delight</a>
                                            </strong>
                                        </h4>
                                        <!-- Description -->
                                        <p class="card-text">Chicken Burger with large patty filled wiith cheese.
                                        </p>
                                        <!-- Card footer -->
                                        <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>120৳</strong>
            </span>
                                        </div>
                                    </div>
                                    <!-- Card content -->
                                </div>
                                <!-- Card -->
                            </div>
                            <!-- Grid column -->

                        </div>
                        <!-- Grid row -->

                    </section>
                    <!-- Section: Products v.1 -->
                </div>
            </div>
        </main>

        <footer>
            <div class="row">
                <div class="col">
                    <!--Modal: Login / Register Form-->
                    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!--Content-->
                            <div class="modal-content">

                                <!--Modal cascading tabs-->
                                <div class="modal-c-tabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i
                                                    class="fa fa-user mr-1"></i>
                                                Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i
                                                    class="fa fa-user-plus mr-1"></i>
                                                Register</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panels -->
                                    <div class="tab-content">
                                        <!--Panel 7-->
                                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                                            <form action="index.php" method="post">

                                                <!--Body-->
                                                <div class="modal-body mb-1">
                                                    <div class="md-form form-sm mb-5">
                                                        <i class="fa fa-envelope prefix"></i>
                                                        <input type="email" name="Email" id="modalLRInput10"
                                                               class="form-control form-control-sm validate">
                                                        <label data-error="wrong" data-success="right"
                                                               for="modalLRInput10">Your email</label>
                                                    </div>

                                                    <div class="md-form form-sm mb-4">
                                                        <i class="fa fa-lock prefix"></i>
                                                        <input type="password" name="Password" id="modalLRInput11"
                                                               class="form-control form-control-sm validate">
                                                        <label data-error="wrong" data-success="right"
                                                               for="modalLRInput11">Your password</label>
                                                    </div>
                                                    <div class="text-center mt-2">
                                                        <button type="submit" name="logIn_btn" class="btn btn-info">Log
                                                            in <i class="fa fa-sign-in ml-1"></i></button>
                                                    </div>
                                                </div>
                                                <!--Footer-->
                                                <div class="modal-footer">
                                                    <div class="options text-center text-md-right mt-1">
                                                        <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                                                        <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                                                    </div>
                                                    <button type="button"
                                                            class="btn btn-outline-info waves-effect ml-auto"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--/.Panel 7-->

                                        <!--Panel 8-->
                                        <div class="tab-pane fade" id="panel8" role="tabpanel">

                                            <!--Form-->
                                            <form action="index.php" method="post">
                                                <!--Body-->
                                                <div class="modal-body">
                                                    <div class="md-form form-sm mb-5">
                                                        <i class="fa fa-envelope prefix"></i>
                                                        <input type="email" name="Email" id="modalLRInput12"
                                                               class="form-control form-control-sm validate">
                                                        <label data-error="wrong" data-success="right"
                                                               for="modalLRInput12">Your email</label>
                                                    </div>

                                                    <div class="md-form form-sm mb-5">
                                                        <i class="fa fa-lock prefix"></i>
                                                        <input type="password" name="Password" id="modalLRInput13"
                                                               class="form-control form-control-sm validate">
                                                        <label data-error="wrong" data-success="right"
                                                               for="modalLRInput13">Your password</label>
                                                    </div>

                                                    <div class="md-form form-sm mb-4">
                                                        <i class="fa fa-lock prefix"></i>
                                                        <input type="password" name="Password_match" id="modalLRInput14"
                                                               class="form-control form-control-sm validate">
                                                        <label data-error="wrong" data-success="right"
                                                               for="modalLRInput14">Repeat password</label>
                                                    </div>

                                                    <div class="text-center form-sm mt-2">
                                                        <button type="submit" name="signUp_btn" class="btn btn-info">
                                                            Sign up <i class="fa fa-sign-in ml-1"></i></button>
                                                    </div>

                                                </div>
                                                <!--Footer-->
                                                <div class="modal-footer">
                                                    <div class="options text-right">
                                                        <p class="pt-1">Already have an account? <a href="#"
                                                                                                    class="blue-text">Log
                                                                In</a></p>
                                                    </div>
                                                    <button type="button"
                                                            class="btn btn-outline-info waves-effect ml-auto"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!--/.Panel 8-->
                                    </div>

                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!--Modal: Login / Register Form-->

                    <!--<div class="text-center">
                        <a href="" class="btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#modalLRForm">Launch
                            Modal LogIn/Register</a>
                    </div>-->
                </div>
            </div>
            <div class="row">
                <div class="pos-f-t">
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="bg-dark p-4">
                            <h4 class="text-white">Collapsed content</h4>
                            <span class="text-muted">Toggleable via the navbar brand.</span>
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>

                                <!-- Dropdown -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2"
                                       data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">Dropdown</a>
                                    <div class="dropdown-menu dropdown-primary"
                                         aria-labelledby="navbarDropdownMenuLink2">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <nav class="navbar navbar-dark indigo">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent"
                                aria-controls="navbarToggleExternalContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
            </div>

        </footer>
        <!--<div style="height: 100vh">
          <div class="flex-center flex-column">

            <h1 class="text-hide animated fadeIn mb-4" style="background-image: url('https://mdbootstrap.com/img/logo/mdb-transparent-250px.png'); width: 250px; height: 90px;">MDBootstrap</h1>
            <h5 class="animated fadeIn mb-3">Thank you for using our product. We're glad you're with us.</h5>

            <p class="animated fadeIn text-muted">MDB Team</p>
          </div>
        </div>
      -->  <!-- /Start your project here-->

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
            new WOW().init();
        </script>
    </div>
    </body>
    </html>
    <?php
}
?>