<?php

require '../login-signup/config.php';
session_start();

$response = array(
    'status' => 0,
    'message' => '',
    'received_Files_Image' => isset($_FILES['input_image']) ? $_FILES['input_image'] : null,
    'received_Post_Image' => isset($_POST['input_image']) ? $_POST['input_image'] : null,
    'test' => ""
);

$user_id = null;
$errorSize = false;
$errorType = false;

// 獲取用戶資訊
if(isset($_SESSION['user-id-session'])){
    $user_id = filter_var($_SESSION['user-id-session'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindValue(':id', $user_id);
    $statement->execute();
    $statement_result = $statement->fetch(PDO::FETCH_ASSOC);
}else{
    $response['message'] = "沒有用戶訊息";
}

// 上傳照片
if(isset($_FILES['input_image'])){

    $arr_file_types = ['image/png', 'image/jpg', 'image/jpeg'];
    $original_filename = $_FILES['input_image']['name'];
    // 生成使用者ID+亂數+檔名
    $unique_filename = $user_id . '_' . uniqid() . '_' . $original_filename;
    $image_size = $_FILES['input_image']['size'];
    $image_tmp_name = $_FILES['input_image']['tmp_name'];
    $response['test'] = $image_tmp_name;
    $image_folder = "../../image/uploaded_img/" . $unique_filename;
    $ImgSizeMB = 10*pow(10,6);

    if($image_size > $ImgSizeMB){
        $response["status"] = 0;
        $errorSize = true;
    }elseif(!in_array($_FILES['input_image']['type'], $arr_file_types)){
        $response["status"] = 0;
        $errorType = true;
    }else{
        if($errorSize == false && $errorType == false)
            if(!empty($statement_result['image'])){
                $old_img_path = '../../image/uploaded_img/' . $statement_result['image'];
                if(file_exists($old_img_path)){
                    unlink($old_img_path);
                }
            }
            
                try {

                    $update_user_query = "UPDATE users SET image = :image WHERE id = :user_id";
                    $stmt = $pdo->prepare($update_user_query);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':image', $unique_filename);
    
                    move_uploaded_file($image_tmp_name, $image_folder);
    
                    if ($stmt->execute()) {
                        $response['status'] = 1;
                    }else{
                        $response['status'] = 0;
                    }
    
                } catch (PDOException $e) {
                    echo  "資料庫連線錯誤：" . $e->getMessage();
                }
            

    }
}

// 刪除照片
if(isset($_POST['del_img'])){
    $current_image = $statement_result['image'];

    if(!empty($current_image)){
        $image_folder = "../../image/uploaded_img/" . $statement_result['image'];
        unlink($image_folder);
        try {
            $update_user_query = "UPDATE users SET image = NULL WHERE id = :user_id";
            $stmt = $pdo->prepare($update_user_query);
            $stmt->bindParam(':user_id', $user_id);
    
            if ($stmt->execute()) {
                $response['status'] = 1;
                $response['message'] = "成功刪除照片!";
            }else{
                $response['status'] = 0;
                $response['message'] = "刪除照片失敗!";
            }
    
        } catch (PDOException $e) {
            echo  "資料庫連線錯誤：" . $e->getMessage();
        }
    }else{
        $response['message'] = "刪除照片失敗!";
    }
    
}

echo json_encode($response ,JSON_UNESCAPED_UNICODE);

?>