<?php

require 'config.php';
session_start();

$response = array(
    'status' => 0,
    'message' => '沒收到',
    'receivedValue' => isset($_POST['input']) ? $_POST['input'] : null,
    // 'receivedValue' =>  isset($_POST['input'])? $_POST['input'] : 
    //                     (isset($_GET['input'])? $_GET['input'] : null) ,
    'translatedText' => '沒資料'
);


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


    if (isset($_POST['input'])) {
        if($response['receivedValue'] === ""){
            $response['message'] = '請輸入要翻譯的文字';
        }else{
            $input = $_POST['input'];
            $command = 'python ../../python/Demo3.0.py ' . escapeshellarg($input);
            $string = shell_exec($command);
            if($string !== null){
                // 轉換編碼文字
                $output = mb_convert_encoding($string,"UTF-8", "BIG5");
                // $output = iconv("big5", "UTF-8", $string);
                
                // 判斷有無帳號
                if(isset($user_id)){
                    // $clientTime = isset($_POST['clientTime']) ? $_POST['clientTime'] : null;
                    try {
                        $StringsQuery = "INSERT INTO translation_history (ch_strings, ts_strings) 
                                        VALUES (:ch_strings, :ts_strings)";
                        $stmt = $pdo->prepare($StringsQuery);
                        $stmt ->bindParam(':ch_strings', $input);
                        $stmt->bindParam(':ts_strings', $output);

                        if ($stmt->execute()) {
                            $translate_history_id = $pdo->lastInsertId();
                        }

                        if (isset($user_id) && isset($translate_history_id)) {
                            date_default_timezone_set("Asia/Taipei");
                            $time = date('Y-m-d H:i:s');
                            
                            $userRecordQuery = "INSERT INTO user_record (user_id, ts_id, time) VALUES (:user_id, :ts_id, :time)";
                            $userRecordStmt = $pdo->prepare($userRecordQuery);
                            $userRecordStmt->bindParam(':user_id', $user_id);
                            $userRecordStmt->bindParam(':ts_id', $translate_history_id);
                            $userRecordStmt->bindParam(':time', $time);
                        
                            if ($userRecordStmt->execute()) {
                                $response['translatedText'] = $output;
                                $response['status'] = 1;
                            }
                        }
                    }catch (PDOException $e) {
                        $response['message'] = "資料庫連線錯誤：" . $e->getMessage();
                    }

                }else{
                    // 沒帳號直接輸出
                    $response['translatedText'] = $output;
                    $response['status'] = 1;
                }
            }else{
                $response['message'] = "Python執行失敗";
            }
        }
    }else{
        $response['message'] = "沒有資料";
    }

    echo json_encode($response ,JSON_UNESCAPED_UNICODE);
?>