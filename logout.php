<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 12/1/2018
 * Time: 6:06 PM
 */
session_start();

session_destroy();
session_start();
$_SESSION['is_login']=false;
$_SESSION['name']='Guest';
header('Location: index.php');
?>