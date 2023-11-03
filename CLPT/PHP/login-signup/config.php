<?php 
define('DOMAIN', 'http://localhost/CLPT/PHP/Index/');

$host_name = "localhost";
$username = "root"; // mt database username
$password = ""; // my password
$db_name = "clpt"; // my database name

try {
    // setAttribute 設置屬性
    // PDO::ATTR_ERRMODE 錯誤報告
    // PDO::ERRMODE_EXCEPTION 拋出異常
    $pdo = new PDO("mysql:host=$host_name;dbname=$db_name","$username", "$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}
?>