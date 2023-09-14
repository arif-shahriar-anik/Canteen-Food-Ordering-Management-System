<?php
session_start();
?>
    <!DOCTYPE html>
    <body lang="en">
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
            th,td{
                font-size: 1.4rem!important;
            }
            img {
                width: 128px;
                height: 128px;
            }
            table,td,th{
                font-size: 200%%;
                overflow-y: hidden;
            }
        </style>
    </head>
    <div class="bg">
        <header>

        </header>
        <main>

<?php
include 'Header.php';
if (!$_SESSION['is_login']) {
    # code...
    die("<div class='alert alert-success mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
}else{
    echo "<div class='alert alert-success mt-3' role='alert'>";
    echo ('Welcome! <strong>'.$_SESSION['name'].'</strong>');
    echo "</div>";

}
require 'Connection.php';
echo "<br><br>";
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 11/20/2018
 * Time: 9:04 PM
 */
/*echo $_GET['name']."<br/>";
echo $_GET['email'];*/
$data="SELECT FNAME,LNAME FROM clients WHERE EMAIL ='".$_GET['email']."';";
?><script type="text/javascript">
                var uname= "<?php echo $_GET['email']?>";
            </script> <?php
//$data="SELECT COUNT(*) FROM clients_info WHERE MECHANIC='KARIM'";
$result1 = mysqli_query($conn, $data);
$row1=mysqli_fetch_array($result1);
$fname=$row1["FNAME"];
$lname=$row1["LNAME"];

/*$data2="SELECT COUNT(ORDER_NO) FROM order_info;";
$result2 = mysqli_query($conn, $data2);
$row2=mysqli_fetch_array($result2);
$orderNum=$row2["COUNT(ORDER_NO)"]+1;*/

$sql1 = "SELECT * FROM order_info ORDER BY ORDER_NO;";
$result = $conn->query($sql1);
$allRows = $result->num_rows;
if ($result->num_rows > 0) {
    $counter=0;
    while ($row = mysqli_fetch_array($result)){
        if($counter==$allRows-1){
            $orderNum=$row["ORDER_NO"];
            break;
        }
        $counter++;
    }
}
            $orderNum++;
            echo $orderNum." ORDERS";

$data3="SELECT AMOUNT FROM clients WHERE EMAIL='".$_GET['email']."';";
$result3 = mysqli_query($conn, $data3);
$row3=mysqli_fetch_array($result3);
$amount=$row3["AMOUNT"];


echo "<h3 class='text-center text-white bg-indigo font-weight-normal text-lowercase py-4 wow heartBeat'><span class='font-weight-bold text-uppercase z-depth-2'>".$fname." ".$lname."</span><br>  Thanks for purchasing from us.</h3>";
        ?>
        <div class="card wow fadeInUp z-depth-1 dark-grey-text font-weight-bold">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2"><i class="fa fa-user-plus" aria-hidden="true"></i> Confirm Order to Cart</h3>
            <div class="alert alert-warning" role="alert">
                Please Fill in Desired quantity and click <strong>calculate</strong>.
            </div>
            <div class="card-body">
                <div id="table" class="table-editable">
                    <table class="table table-bordered table-responsive-md table-striped text-center text-dark ">
                    <tr>
                        <th class="text-center z-depth-1">Food Name</th>
                        <th class="text-center z-depth-1">Order Number</th>
                        <th class="text-center z-depth-1">Price Per Unit</th>
                        <th class="text-center z-depth-1">Quantity</th>
                        <th class="text-center z-depth-1">Total Price</th>
                        <th class="text-center z-depth-1">User Balance</th>
                        <th class="text-center z-depth-1">Confirm Quantity</th>
                    </tr>
                    <?php
                    echo "<tr>";
                    ?>
                        <?php
                    echo "<td class='pt-3-half' contenteditable='false' name='Fname' id='Fname'>".$_GET['name']."</td>";
                    echo "<td class='pt-3-half' contenteditable='false' name='Order_No' id='Order_No'>$orderNum</td>";
                    echo "<td class='pt-3-half' contenteditable='false' name='Unit_Price' id='Unit_Price'>".$_GET['price']."</td>";
                    echo "<td class='pt-3-half' contenteditable='true' name='Quantity' id='Quantity'>1</td>";
                    echo "<td class='pt-3-half' name='Price_Total' id='Price_Total'>0</td>";
                    echo "<td class='pt-3-half' name='User_Balance' id='User_Balance'>".$amount."</td>";
                    ?>
                    <td>
                        <span class="table-remove"><button type="button" class="btn btn-default btn-rounded btn-sm my-0 z-depth-1-half" onclick='calculate(); balance(); modify()'>CalculTE</button></span>
                    </td>
                    </tr>
                    </table>
            </table>
        </div>
                <span class="table-remove d-flex justify-content-center">
                        <a href="Tables.php?fname=Kachi&price=100&amount=100&orderno=1" id="abc"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 z-depth-1-half" name="submitttt">Print</button></a></span>
    <br>
        </div>
            <span class="table-remove">
                <a href="UserProfile.php?fname=Kachi&price=100&amount=100&orderno=1" id="abc2"> <button type="button" class="btn btn-default btn-rounded btn-sm my-0 z-depth-1-half">Confirm Order</button></a>
            </span>
                <!-- Editable table -->
            <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/jspdf.js"></script>
    <script type="text/javascript" src="js/libs/sprintf.js"></script>
    <script type="text/javascript" src="js/libs/base64.js"></script>
    <script type="text/javascript">
    new WOW().init();
    calculate();
    /*balance();*/
    modify();
    /*balance();*/
    function calculate() {
        orderNum=document.getElementById('Quantity').innerHTML;
        priceUnit=document.getElementById('Unit_Price').innerHTML;
        estimation=0;
        if(orderNum!=1) {
            add = priceUnit * (orderNum);
            estimation+=add;
        }
        else{
            estimation=document.getElementById('Price_Total').innerHTML;
            estimation = priceUnit * orderNum;
        }
        document.getElementById('Price_Total').innerHTML=estimation;
    }
    function balance(){
        amount=document.getElementById('User_Balance').innerHTML;
        totalPrice=document.getElementById('Price_Total').innerHTML;
        amountNow=amount-totalPrice;
        document.getElementById('User_Balance').innerHTML=amountNow;
    }
    function modify() {
        string="Tables.php?";
        data2='UserProfile.php?';
        fname=document.getElementById('Fname').innerHTML;
        totalPrice=document.getElementById('Price_Total').innerHTML;
        amountNow=document.getElementById('User_Balance').innerHTML;
        orderNum=document.getElementById('Order_No').innerHTML;
        quantity=document.getElementById('Quantity').innerHTML;;
        document.getElementById("abc").href=string+"fname="+fname+"&price="+totalPrice+"&amount="+amountNow+"&orderno="+orderNum+"&uname="+uname;
        document.getElementById("abc2").href=data2+"fname="+fname+"&price="+totalPrice+"&amount="+amountNow+"&orderno="+orderNum+"&uname="+uname+"&quantity="+quantity;
    }
    </script>
            <br><br>
            </div>
        </main>
    <br><br>
    <footer>
        <!-- Modal -->
        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="row">
                        <div class="col z-depth-2 mb-3 mt-3 container">
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
                                    echo "<h5 class='card-title'>Email: ".$_GET["email"]."</h5>";
                                    $data2="SELECT FNAME,LNAME,AMOUNT FROM clients WHERE EMAIL ='".$_GET["email"]."';";
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
    </footer>
    </div>
</body>

</html>
<?php
$conn->close();

?>