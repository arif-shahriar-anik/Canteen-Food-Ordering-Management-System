<?php
session_start();
/*$_SESSION['is_login']=false;*/
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
<body class="bg">
<div>
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
                                <a class="nav-link" href="index.php">Home
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
                                    <a class="dropdown-item" href="Login.php">User Panel</a>
                                </div>
                            </li>
                        </ul>
                        <!-- Links -->
                        <form class="form-inline">
                            <div class="md-form my-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search"
                                       aria-label="Search">
                            </div>
                        </form>
                        &nbsp;&nbsp;
                    </div>
                    <!-- Collapsible content -->
                </div>
            </nav>
            <!--/.Navbar-->
        </div>
    </header>
<?php
if(isset($_POST["submit_btn"])){
   /* echo "POST";*/
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
    $data="SELECT PASSWORD FROM clients WHERE EMAIL ='".$_POST["Email"]."';";
//$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
    $result1 = mysqli_query($conn, $data);
    $row1=mysqli_fetch_array($result1);
    $key=$row1["PASSWORD"];
    $encrypted = sha1($_POST["Password"]);
    if ($encrypted == $key) {
        $_SESSION['is_login'] = true;
        $_SESSION['name'] = $_POST['Email'];
        header('Location: Check_login.php');
        die('passed :)');
        } else {
        echo "<div class='alert alert-danger mt-3' role='alert'>";
        echo "<h3>INCORRECT PASSWORD</h3>";
        echo "</div>";
        /*echo "<h3>INCORRECT PASSWORD</h3>";*/
        }
}
elseif(isset($_POST["submitttt"])){
    /*
     * Created by PhpStorm.
     * User: HP
     * Date: 11/16/2018
     * Time: 8:15 PM
     */
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
        echo "Connected";
    }

    $sql = "INSERT INTO clients VALUES('" . $_POST["Fname"] . "','" . $_POST["Lname"] . "','" . $_POST["Email"] . "','" . sha1($_POST["Password"]) . "'," . $_POST["Amount"] . ",1);";
    if ($conn->query($sql) === TRUE) {
        echo "<h3>New record created successfully</h3>";
        echo "<strong>Sign Up Complete</strong> <a href=\"Login.php\"><button type=\"button\" class=\"btn btn-success btn-rounded z-depth-2 wow fadeInDown\">Log In Now</button></a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
else{
    ?>
        <main>
            <div class="row">
                <div class="col">
                    <!-- Default form login -->
                    <div class="container-fluid info-color p-0 m-0 z-depth-2">
                        <h5 class="card-header info-color white-text text-center py-4 mt-2 mb-2">
                            <strong>Did not sign up??</strong>
                            <a href="index.php" target='_blank'><button type="button" class="btn btn-success btn-rounded z-depth-2 wow fadeInDown">Apply Now</button></a>
                        </h5>
                    </div>
                    <div class="card container mt-4">
                        <div class="card-body px-lg-5 pt-lg-5">
                            <form class="text-center border border-light p-5" action="Login.php" method="post">
                                <!--Email-->
                                <div class="md-form">
                                    <input type="text" id="inputIconEx1" name="Email" class="form-control">
                                    <label for="inputIconEx1"><i class="fa fa-user-circle" aria-hidden="true"
                                                                 style="font-size: 1.2rem;"></i> E-mail address</label>
                                </div>
                                <!--Password-->
                                <div class="md-form">
                                    <input type="password" id="inputMDEx" name="Password" class="form-control">
                                    <label for="inputMDEx"></i><i class="fa fa-unlock-alt" aria-hidden="true"
                                                                  style="font-size: 1.2rem;"></i> Enter Password</label>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div>
                                        <!-- Remember me -->
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                   id="materialLoginFormRemember">
                                            <label class="form-check-label" for="materialLoginFormRemember">Remember
                                                me</label>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Forgot password -->
                                        <a href="">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Sign in button -->
                                <button type="submit" class="btn btn-outline-info waves-effect my-4 container-fluid"
                                        name="submit_btn"><i class="fa fa-user-circle" aria-hidden="true"></i> Sign In
                                </button>


                                <!-- Social login -->
                                <p>Like our page:</p>

                                <a href="https://www.facebook.com/" target="_blank">
                                    <button type="button" class="btn btn-blue btn-fb z-depth-2"><i
                                                class="fa fa-facebook pr-1"></i> Facebook
                                    </button>
                                </a>

                            </form>
                        </div>
                        <!-- Default form login -->
                    </div>
                    <!--Card-->
                </div>
                <!--column-->
            </div>

            <br><br><br>
        </main>
        <footer>

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
    </div>
    </body>
    </html>
  <?php
}
?>