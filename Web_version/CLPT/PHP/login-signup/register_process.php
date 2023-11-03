<?php
require '../login-signup/config.php';

$response = array(
    'status' => 0,
    'message' => ''
);

$errorEmpty = false;
$errorEmail = false;
$errorpasswd = false;

if(isset($_POST['fullname']) || isset($_POST['email']) 
    || isset($_POST['password']) || isset($_POST['repassword'])) {

    $fullname = filter_var($_POST['fullname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // 密碼規則
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    // 表單驗證
    if(!$fullname) {
        $response['message'] = "請輸入用戶名";
        $errorEmpty = true;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $response['message'] = "電子郵件不正確";
        $errorEmail = true;
    }elseif(empty($password)){
        $response['message'] = "請輸入密碼";
        $errorEmpty = true;
    }elseif(strlen($password) < 8){
        $response['message'] = "密碼長度不足";
        $errorpasswd = true;
    }elseif(!$uppercase || !$lowercase || !$number || !$specialChars){
        $response['message'] = "需要一個大小寫字母、數字、特殊字符";
        $errorpasswd = true;
    }elseif(empty($repassword)){
        $response['message'] = "請再次輸入密碼";
        $errorEmpty = true;
    }elseif($password !== $repassword){
        $response['message'] = "密碼不匹配!";
        $errorpasswd = true;
    }else{
        if ($errorEmpty == false && $errorEmail == false && $errorpasswd == false) {

            // 上傳檔案

            try {

                //哈希密碼
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                // $hash = md5($password);
                $checkQuery = "SELECT * FROM users WHERE email = :email";
                $stmt = $pdo->prepare($checkQuery);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if ($stmt->rowCount() == 1) {
                    $response['message'] = "信箱已存在";
                } else {
                    // 插入資料的準備語句
                    $insertQuery = "INSERT INTO users(fullname, email, password) 
                        VALUES (:fullname, :email, :password)";
                    $stmt = $pdo->prepare($insertQuery);
                    $stmt->bindParam(':fullname', $fullname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $hash_password);


                    if ($stmt->execute()) {
                        $response['message'] = "註冊成功";
                        $response['status'] = 1;
                    }
                }
            } catch (PDOException $e) {
                $response['message'] = "資料庫連線錯誤：" . $e->getMessage();
            }
        }
    }

}

echo json_encode($response);

?>