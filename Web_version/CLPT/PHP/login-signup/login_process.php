<?php
// header('Content-Type: text/html; charset=utf-8');
session_start();
require '../login-signup/config.php';

$response = array(
    'status' => 0,
    'message' => '沒收到',
    // 'receivedEmail' => isset($_POST['email']) ? $_POST['email'] : null,
    'receivedEmail' =>  isset($_POST['email'])? $_POST['email'] : 
                        (isset($_GET['email'])? $_GET['email'] : null) ,
    // 'receivedPassword' => isset($_POST['password']) ? $_POST['password'] : null
    'receivedPassword' =>  isset($_POST['password'])? $_POST['password'] : 
                        (isset($_GET['password'])? $_GET['password'] : null)
);


$errorEmail = false;
$errorpasswd = false;

// if(isset($_POST['email']) || isset($_POST['password'])) {
if(isset($response['receivedEmail']) || isset($response['receivedPassword'])) {

    isset($_GET['email'])? file_put_contents("log.txt", $_GET['email']) : null;
    $email = filter_var($response['receivedEmail'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($response['receivedPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if(!$email){
        $response['message'] = "請輸入信箱帳號";
        $errorEmail= true;
    }elseif(!$password){
        $response['message'] = "請輸入密碼";
        $errorpasswd = true;
    }else{

        // $pdo = new PDO("mysql:host=localhost;dbname=Pjl_user_info", "root", "");
        $checkQuery = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($checkQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->rowcount() === 1){
            // 將用戶數據轉換為陣列
            $get_user = $stmt->fetch(PDO::FETCH_ASSOC);
            // 獲取哈希資料庫密碼
            // get_user['該欄位名稱'];
            $database_password = $get_user['password'];

            if(password_verify($password, $database_password)){
                $response['status'] = 1;
                $_SESSION['user-id-session'] = $get_user['id'];
            }else{
                $response['message'] = "電子郵件或密碼不正確";
            }
        }else{
            $response['message'] = "該帳號尚未註冊";
        }
    }

}


echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>