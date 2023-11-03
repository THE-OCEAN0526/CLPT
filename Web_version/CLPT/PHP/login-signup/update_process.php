<?php
header('Content-Type: application/json');
require '../login-signup/config.php';
session_start();

$response = array(
    'status' => 0,
    'message' => '沒收到',
    'receivedname' => isset($_POST['update_name']) ? $_POST['update_name'] : null,
    'receivedOldPass' => isset($_POST['old_pass']) ? $_POST['old_pass'] : null,
    'receivedNewPass' => isset($_POST['new_pass']) ? $_POST['new_pass'] : null,
    'receivedRePass' => isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : null,
    'updateValue' => '',
    'where' => ''
);

// print_r($_POST['update_name']);

$user_id = null;
$errorEmpty = false;
$errorpasswd = false;


// 檢查資料庫用戶id
if(isset($_SESSION['user-id-session'])){
    $user_id = filter_var($_SESSION['user-id-session'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindValue(':id', $user_id);
    $statement->execute();
    $statement_result = $statement->fetch(PDO::FETCH_ASSOC);
}else{
    $response['message'] = "沒有用戶訊息";
}


if(isset($_POST['update_name']) && $_POST['update_name'] !== $statement_result['fullname']){

    $update_name = filter_var($_POST['update_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $update_email = filter_var($_POST['update_email'], FILTER_VALIDATE_EMAIL);
    
    if(!empty($update_name)){
        $statement_result['fullname'] = $update_name;
        // if(isset($update_name)){
            // 更新用戶名
            try {
                $updateQuery = "UPDATE users SET fullname = :fullname WHERE id = :user_id";
                $update_user_query = $pdo->prepare($updateQuery);
                $update_user_query->bindParam(':user_id', $user_id);
                $update_user_query->bindParam(':fullname', $update_name);
                $update_user_query->execute();
                $response['message'] = "用戶名修改成功";
                $response['status'] = 1 ;
                $response['where'] = 'name';
                $response['updateValue'] = $statement_result['fullname'];
            }catch (PDOException $e) {
                $response['message'] = "資料庫連線錯誤：" . $e->getMessage();
            }
        // }
    }else{
        $response['message'] = "未修改資料";
    }
    
}

if(isset($_POST['update_email']) && $_POST['update_email'] !== $statement_result['email']){
    $update_email = filter_var($_POST['update_email'], FILTER_VALIDATE_EMAIL);
    
    if(filter_var($update_email, FILTER_VALIDATE_EMAIL)){
        $statement_result['email'] = $update_email;
        // 檢查電子信箱
        try {
            $checkQuery = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($checkQuery);
            $stmt->bindParam(':email', $update_email);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $response['status'] = 0 ;
                $response['message'] = "信箱已存在";
            } else {
                // 修改信箱
                $updateQuery = "UPDATE users SET email = :email WHERE id = :user_id";
                $update_user_query = $pdo->prepare($updateQuery);
                $update_user_query->bindParam(':user_id', $user_id);
                $update_user_query->bindParam(':email', $update_email);
                if ($update_user_query->execute()) {
                    $response['message'] = "電子信箱修改成功";
                    $response['status'] = 1;
                    $response['where'] = 'email';
                    $response['updateValue'] = $statement_result['email'];
                }else{
                    $response['message'] = "未能更新電子信箱";
                }
            }
        } catch (PDOException $e) {
            $response['message'] = "資料庫連線錯誤：" . $e->getMessage();
        }
    }else{
        $response['status']  = 0;
        $response['message'] = "電子郵件不正確";
    }
    
}

if(isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['confirm_pass'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
    
    // 密碼規則
    $uppercase = preg_match('@[A-Z]@', $new_pass);
    $lowercase = preg_match('@[a-z]@', $new_pass);
    $number    = preg_match('@[0-9]@', $new_pass);
    $specialChars = preg_match('@[^\w]@', $new_pass);

   if(! empty($old_pass) || ! empty($new_pass) || ! empty($confirm_pass)){
    $response['where'] = 'pass';
        if(strlen($new_pass) < 8){
            $response['message'] = "密碼長度不足";
            $errorpasswd = true;
        }elseif(!$uppercase || !$lowercase || !$number || !$specialChars){
            $response['message'] = "需要一個大寫字母、數字、特殊字符";
            $errorpasswd = true;
        }elseif(password_verify($old_pass, $statement_result['password'])){
            if($new_pass != $confirm_pass){
             $response['message'] = "確認密碼不相符";
             $errorpasswd = true;
            }else{
                $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

                try{
                    $update_user_query = $pdo->prepare("UPDATE users SET password = :password WHERE id = :user_id");
                    $update_user_query->bindParam(':user_id', $user_id);
                    $update_user_query->bindParam(':password', $hashed_password);
 
                    if ($update_user_query->execute()) {
                         $response['message'] = "成功修改密碼";
                         $response['status'] = 1;
                         $errorpasswd = false;
                     }else{
                         $response['message'] = "未能更新密碼";
                    }
                    
 
                }catch(PDOException $e){
                     $response['message'] = "資料庫連線錯誤： " . $e->getMessage();
                    die();
                }
            }
        }else{
            $response['message'] = "錯誤的舊密碼";
        }
    }
}

    // 表單驗證
    // if(empty($old_pass) || empty($new_pass) || empty($confirm_pass)){
    //     if(! $old_pass){
    //         // $response['message'] = "請輸入舊密碼";
    //         $errorpasswd = true;
    //     }elseif(! $new_pass){
    //         $response['message'] = "請輸入新密碼";
    //         $errorpasswd = true;
    //     }elseif(! $confirm_pass){
    //         $response['message'] = "請輸入確認新密碼";
    //         $errorpasswd = true;
    //     }elseif(strlen($new_pass) < 8){
    //         $response['message'] = "密碼長度不足";
    //         $errorpasswd = true;
    //     }elseif(!$uppercase || !$lowercase || !$number || !$specialChars){
    //         $response['message'] = "需要一個大寫字母、數字、特殊字符";
    //         $errorpasswd = true;
    //     }elseif(password_verify($old_pass, $statement_result['password'])){
    //        if($new_pass != $confirm_pass){
    //         $response['message'] = "確認密碼不相符";
    //         $errorpasswd = true;
    //        }else{
    
    //             $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

    //            try{
    //                $update_user_query = $pdo->prepare("UPDATE users SET password = :password WHERE id = :user_id");
    //                $update_user_query->bindParam(':user_id', $user_id);
    //                $update_user_query->bindParam(':password', $hashed_password);

    //                if ($update_user_query->execute()) {
    //                     $response['message'] = "成功修改密碼";
    //                     $response['status'] = 1;
    //                 }else{
    //                     $response['message'] = "未能更新密碼";
    //                }
                   

    //            }catch(PDOException $e){
    //                 $response['message'] = "資料庫連線錯誤： " . $e->getMessage();
    //                die();
    //            }
    //        }
    //    }else{
    //     $response['message'] = "錯誤的舊密碼";
    //    }
       
    // }
        

echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>