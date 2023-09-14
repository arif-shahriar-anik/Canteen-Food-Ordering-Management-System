<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Profile</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .pt-3-half {
            padding-top: 1.4rem;
        }
        table,tr,td,th{
            font-size: 1.6rem!important;
            overflow-y: hidden;
        }
    </style>
</head>
  <?php
  include 'header.php';
  if (!$_SESSION['is_login']) {
      # code...
      die("<div class='alert alert-danger mt-3' role='alert'>Sorry! user logged out <strong>".$_SESSION['name'].'</strong></div>');
  }else{
      echo "<div class='alert alert-success mt-3' role='alert'>";
      echo ('Welcome! <strong>'.$_SESSION['name'].'</strong>');;
      echo "</div>";
  }
  ?>  <body class="bg">
<script type="text/javascript">
    var uname= "<?php echo $_GET['uname']?>";
</script>
    <div>
    <main>
        <br><br><br>
        <!-- Editable table -->
        <div class="card container w-100">
            <h3 class="card-header text-center font-weight-bold text-uppercase py-4 z-depth-2"><i class='fa fa-cart-arrow-down' aria-hidden='true'></i> My Cart</h3>
            <div class="card-body">
                <div id="table" class="table-editable"> <?php
     echo "<span class='table-add float-right mb-3 mr-2'><a href='PrintFood.php?uname=".$_GET['uname']."' target='_blank' class='text-success'><i class='fa fa-plus fa-2x' aria-hidden='true'></i></a></span>";
        ?>            <table class="table table-bordered table-responsive-md table-striped text-center container-fluid width 100%">
                       <tr>
                            <th class="text-center">Food Name</th>
                            <th class="text-center">Order No</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total price</th>
                            <th class="text-center">Sort</th>
                            <th class="text-center">Remove</th>
                        </tr>
                       <?php
                       require 'Connection.php';
                           if (isset($_GET['counter'])) {
                               /*echo "In Me";*/
                               // id index exists
                               /*echo $_GET['id1'];*/
                               /*echo $_GET['id2'];*/
                               $counter = $_GET['counter'];
                               $i = 1;
                               while ($i <= $counter) {
                                   /*echo "In Me 2";*/
                                   $content = 'id';
                                   $content = $content . $i;
                                   /* echo $content.' content';*/
                                   echo "<br>";
                                   /*echo $_GET[$content];*/
                                   $data5 = "SELECT AMOUNT FROM clients WHERE EMAIL='" . $_GET["uname"] . "';";
                                   $result2 = mysqli_query($conn, $data5);
                                   $row2 = mysqli_fetch_array($result2);
                                   $amount = $row2["AMOUNT"];
                                   $data4 = "SELECT PRICE_TOTAL FROM order_info WHERE ORDER_NO=" . $_GET[$content] . ";";
                                   $result1 = mysqli_query($conn, $data4);
                                   $row1 = mysqli_fetch_array($result1);
                                   $priceTotal = $row1["PRICE_TOTAL"];
                                   $newAmount = $amount + $priceTotal;
                                   $data = "DELETE FROM order_info WHERE ORDER_NO=" . $_GET[$content] . ";";
                                   if ($conn->query($data) === TRUE) {
                                       /*echo "New record created successfully";*/
                                   } else {
                                       echo "Error: " . $data . "<br>" . $conn->error;
                                   }
                                   $data3 = "UPDATE clients SET AMOUNT=" . $newAmount . " WHERE EMAIL='" . $_GET["uname"] . "';";
                                   if ($conn->query($data3) === TRUE) {
                                       /*echo "New amount updated successfully";*/
                                   } else {
                                       echo "Error: " . $data3 . "<br>" . $conn->error;
                                   }
                                   $i++;
                               }
                           } else {
                               $data1 = "UPDATE clients SET AMOUNT=" . $_GET["amount"] . " WHERE EMAIL='" . $_GET["uname"] . "';";
                               if ($conn->query($data1) === TRUE) {
                                   /*echo "Record Updated successfully";*/
                               } else {
                                   echo "Error: " . $data1 . "<br>" . $conn->error;
                               }
                               $data2 = "INSERT INTO order_info VALUES('" . $_GET["uname"] . "','" . $_GET["fname"] . "'," . $_GET["orderno"] . "," . $_GET["quantity"] . "," . $_GET["price"] . ",'UNPROCESSED','" . date('Y-m-d') . "');";
                               if ($conn->query($data2) === TRUE) {
                                   /* echo "New record created successfully";*/
                               } else {
                                   echo "Error: " . $data2 . "<br>" . $conn->error;
                               }
                           }
                       $sql = "SELECT * FROM order_info WHERE EMAIL='".$_GET["uname"]."' AND FLAG='UNPROCESSED' ORDER BY ORDER_NO;";
                       $result = $conn->query($sql);
                       $myFile='';
                       if ($result->num_rows > 0) {
                           $allRows = $result->num_rows;
                           $i=1;
                           $cart='';
                           $reference='UserProfile.php?';
                           while ($row = mysqli_fetch_array($result)){
                               echo "<tr>";
                               echo "<td class='pt-3-half' contenteditable='true'>".$row["FNAME"]."</td>";
                               echo "<td class='pt-3-half' contenteditable='true'>".$row["ORDER_NO"]."</td>";
                               echo "<td class='pt-3-half' contenteditable='true'>".$row["QUANTITY"]."</td>";
                               echo "<td class='pt-3-half' contenteditable='true'>".$row["PRICE_TOTAL"]."</td>";
                               echo "<td class='pt-3-half'>";
                               echo "<span class='table-up'><a href='#!' class='indigo-text'><i class='fa fa-long-arrow-up' aria-hidden='true'></i></a></span><span class='table-down'><a href='#!' class='indigo-text'><i class='fa fa-long-arrow-down'
                                                                                            aria-hidden='true'></i></a></span>";
                               echo "</td>";
                               echo "<td>";
                               echo "<span class='table-remove'><button type='button' class='btn btn-danger btn-rounded btn-sm my-0' onclick='remove(".$row["ORDER_NO"].")'>Remove</button></span>";
                               echo "</td>";
                               echo "</tr>";
                               $last = explode('@',$row["EMAIL"]);
                               $temp=$last[0].";".$row["FNAME"].";".$row["PRICE_TOTAL"].";".$row["ORDER_NO"];
                               $cart=$cart.$temp.PHP_EOL;
                               $temp2="id".$i."=".$row["ORDER_NO"];
                               $reference=$reference.$temp2."&";
                               /*Food Name', 'Order No', 'Price(total)','User Balance'*/
                               /*$stringData = $_GET['fname'].";".$_GET['price'].";".$_GET['amount'].";".$_GET['orderno'];*/
                           $i++;
                           }
                           $add=rand(1,100);
                           $myFile = "text/memoCart".$add.".txt";
                           $fh = fopen($myFile, 'wb') or die("can't open file");
                           fwrite($fh, $cart );
                           fclose($fh);
                           $reference=$reference."&counter=".($i-1)."&uname=".$_GET['uname'];
                          /* echo $reference;*/
                           /*echo $cart;*/
                           /*echo $allRows;
                            Close result set*/
                           mysqli_free_result($result);
                       }else {
                           $reference="index.html";
                           echo "<div class='alert alert-warning' role='alert'>";
                           echo "You have no Unprocessed item in <strong>Cart</strong>.";
                           echo "</div>";
                       }
                       ?>


                        <!--<tr>
                            <td class="pt-3-half" contenteditable="true">Aurelia Vega</td>
                            <td class="pt-3-half" contenteditable="true">30</td>
                            <td class="pt-3-half" contenteditable="true">Deepends</td>
                            <td class="pt-3-half" contenteditable="true">Spain</td>
                            <td class="pt-3-half" contenteditable="true">Madrid</td>
                            <td class="pt-3-half">
                                <span class="table-up"><a href="#!" class="indigo-text"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a></span>
                                <span class="table-down"><a href="#!" class="indigo-text"><i class="fa fa-long-arrow-down"
                                                                                             aria-hidden="true"></i></a></span>
                            </td>
                            <td>
                                <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0" onclick="remove(1)">Remove</button></span>
                            </td>
                        </tr>-->

                    </table>
                </div>
            </div>
        </div>
        <!-- Editable table -->
        <br/>
        <div class="justify-content-center text-center">
        <a id="abc" href="UserProfile.php"><button class="btn btn-success" onclick="count()">Done</button></a>
            <?php
        echo "<a id='abc2' href='Print_Cart.php?id=".$myFile."'><button class='btn btn-danger'>Print</button></a>";
            echo "<a id='abc3' href='".$reference."'><button class='btn btn-danger'>Drop Cart</button></a>";
?></div>
        <br/>
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
                                        echo "<h5 class='card-title'>Email: ".$_GET["uname"]."</h5>";
                                        $data2="SELECT FNAME,LNAME,AMOUNT FROM clients WHERE EMAIL ='".$_GET["uname"]."';";
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
        <script type="text/javascript">
            var $TABLE = $('#table');
            var $BTN = $('#export-btn');
            var $EXPORT = $('#export');

            $('.table-add').click(function () {
                var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
                $TABLE.find('table').append($clone);
            });

            $('.table-remove').click(function () {
                $(this).parents('tr').detach();
            });

            $('.table-up').click(function () {
                var $row = $(this).parents('tr');
                if ($row.index() === 1) return; // Don't go above the header
                $row.prev().before($row.get(0));
            });

            $('.table-down').click(function () {
                var $row = $(this).parents('tr');
                $row.next().after($row.get(0));
            });

            // A few jQuery helpers for exporting only
            jQuery.fn.pop = [].pop;
            jQuery.fn.shift = [].shift;

            $BTN.click(function () {
                var $rows = $TABLE.find('tr:not(:hidden)');
                var headers = [];
                var data = [];

// Get the headers (add special header logic here)
                $($rows.shift()).find('th:not(:empty)').each(function () {
                    headers.push($(this).text().toLowerCase());
                });

// Turn all existing rows into a loopable array
                $rows.each(function () {
                    var $td = $(this).find('td');
                    var h = {};

// Use the headers from earlier to name our hash keys
                    headers.forEach(function (header, i) {
                        h[header] = $td.eq(i).text();
                    });

                    data.push(h);
                });

// Output the result
                $EXPORT.text(JSON.stringify(data));
            });
            link='UserProfile.php?';
            counter=0;
            function remove(val) {
                counter++;
                link=link+'id'+counter+'='+val;
                link=link+'&';
                document.getElementById('abc').href=link;
                alert(val+link);

            }
            function count() {
                temp=link+'counter='+counter+'&uname='+uname;
                document.getElementById('abc').href=temp;
            }
        </script>
    </div>
</body>
</html>


<?php

?>