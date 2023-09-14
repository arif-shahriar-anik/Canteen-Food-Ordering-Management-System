<html>
<head>

</head>
<body>
<?php

if (isset($_POST["submitttt"])) {
    $check=sha1('asdfgh');
    echo $check;
    if('7ab515d12bd2cf431745511ac4ee13fed15ab578'==$check){
        echo "\n TRUE";
    }
}
else
{   require 'Html_to_pdf.php';
    ?>
    <form action="try.php" method="post">
        <label>By Region:</label><br/>
        <select name="watch_region">
            <option value="bangladesh">Bangladesh</option>
            <option value="asia">Asia</option>
            <option value="europe">Europe</option>
            <option value="world">World</option>

        </select>

        <br/>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="_blank">
        Content:<br>
        <textarea name="text" cols="80" rows="15"></textarea><br><br>
        <input type="submit" value="Generate PDF">
    </form>
    </form>
    <input name="submitttt" type="submit" value="click">
    <?php
}
?>
</body>
</html>
