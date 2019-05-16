<?php


$conn = new PDO('mysql:host='.'localhost'.';dbname='.'crm', "root", "root");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
echo "connection.php";

?>