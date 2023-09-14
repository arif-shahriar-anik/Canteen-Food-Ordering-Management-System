<?php


require 'connection.php';
$resultd=mysqli_query($conn,"SELECT FNAME , LNAME , AMOUNT FROM clients ");


$row=mysqli_fetch_array($resultd);
    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>invoice generator</title>
    <link rel="stylesheet" href="css/invoice.css">
     <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Indie+Flower|Itim|Quicksand" rel="stylesheet">
</head>
<body>
  
  <div class="wrapper">
      
      <h2>  Select the patient whose bill you want to generate  </h2>
   
   
   <form action="invoice.php" method="get">
       
       <select class="roll" name="invoiceid" id="">
           
           <?php
           require 'Connection.php';
           
           $query = mysqli_query($conn,"select * from clients");
           
           while($invoice = mysqli_fetch_array($query))
           {
               
              echo "<option value='".$invoice['FNAME']." '>".$invoice['EMAIL']."  </option>";
               
        
        
           }
           
           ?>
           
           
       </select>
       </br>
       
       <input type="submit" class="toll" value="Generate Bill">
       
       
       
       
       
    </form>
    
    </br>
    <p>@Canteen Authority</p>
   
  </div>
   
   
   
   
    
</body>
</html>