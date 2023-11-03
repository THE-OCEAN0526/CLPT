<?php
session_start();
require '../login-signup/config.php';

//如果用戶處於session中，則從資料庫獲取當前用戶
if(isset($_SESSION['user-id-session'])){
    $id = filter_var($_SESSION['user-id-session'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement_result = $statement->fetch(PDO::FETCH_ASSOC);
}else{
    header('location: ' . DOMAIN . 'login_form.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link Icon -->
    <script src='https://kit.fontawesome.com/6eef60556d.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- link fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- link CSS -->
    <link rel="stylesheet" href="../../CSS/index/navbar.css">
    <link rel="stylesheet" href="../../CSS/index/footer.css">
    <link rel="stylesheet" href="../../CSS/index/dark.css">
    <link rel="stylesheet" href="../../CSS/index/form.css">
    <!-- link JQuery -->
    <!-- <script src="../../JS/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- link js -->
    
    <!-- title -->
    <title>PJL</title>
</head>
<body>

    <!-- 功能列 -->
    <header class="main-header">
        <div class="container">
            <a href="#" class="logo">
                CLPT
                <!-- <img src="../../image/plj.png" alt="LOGO | PJL" > -->
            </a>

            <nav class="main-nav">

                <div class="dropdown">
                    <div class="select">
                        <button class="button" id="selected">設定</button> 
                    </div>

                    <ul class="menu" id="user-menu">
                        <li><a href="#" class="icon"><i class="fa-solid fa-file-waveform"></i>紀錄</a></li>
                        <li class="copy"><a href="#" class="icon"><i class="fa-solid fa-copy"></i>複製翻譯碼</a></li>
                        <li id="change_theme"><a href="#" class="icon"><i class="fa-solid fa-circle-half-stroke"></i>變換樣式，黑/白</a></li>
                        <li id="user_form"><a href="#" class="icon"><i class="fa-solid fa-user"></i>編輯個人資料</a></li>
                        <li style="border-style: none;"><a href="../../PHP/login-signup/logout.php" class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i>登出</a></li>
                    </ul>
                </div>

                <button id="translate" class="button" type="submit">翻譯<i class="fa-solid fa-forward"></i></button>
            </nav>

            <!-- 頭像、用戶名 -->
            <div class="right-link">
                <?php 
                    if($statement_result['image'] == ""){
                        echo '<img src="../../image/default_user.jpg" alt="user-img" class="user-img">';
                    }else{
                        echo '<img src="../../image/uploaded_img/'. $statement_result['image'] .'" class="user-img">';
                    }
                ?>
                    <p class="UserName name_value"><?php echo $statement_result['fullname']; ?></p>
            </div>
        </div>

    </header>

     <!-- 輸入、輸出框 -->
     <form action="#" class="translate-form">
        <div class="container">
            <textarea class="inputTextArea" name="input" cols="30" rows="10" placeholder="輸入中文"></textarea>
            <textarea class="outputTextArea" name="output" cols="30" rows="10" placeholder="程式碼翻譯" readonly="readonly"></textarea>
        </div>
    </form>

    <!-- 編輯個人資料 -->
    <div id="personal-screen">
        <div class="update-profile">
            <i class="uil uil-times form_close"></i>
            <h3>編輯個人資料</h3>
                <form id="edit" action="#" enctype="multipart/form-data">

                            
                                <div class="update-container">
                                    <div class="display-box">
                                        <div class="info">
                                            <div class="title">用戶名<span class="star">*</span>:</div> 
                                            <div class="data name_value"><?php echo $statement_result['fullname'] ?></div>
                                        </div>
                                        
                                        <p class="edit-btn"><i class="uil uil-edit-alt"></i>編輯</p>
                                    </div>

                                    <div class="update-box">
                                        <div class="update-block">
                                            <div class="title">用戶名<span class="star">*</span>:</div>
                                            <input id="username" value="<?php echo $statement_result['fullname'] ?>" 
                                            type="text" name="update_name" placeholder="輸入用戶名">
                                            <div class="error"></div>
                                        </div>
                                        <div class="btn-block">
                                            <button class="close-btn" type="button" data-target="cancel-section-1">取消</button>
                                            <button class="store" type="submit" disabled="disabled" data-target="edit-section-1">儲存</button>
                                        </div>
                                    </div>
                                </div>
                           
                            
                            
                                <div class="update-container">
                                    <div class="display-box">
                                        <div class="info">
                                            <div class="title">電子信箱<span class="star">*</span>:</div>
                                            <div id="email_value" class="data"><?php echo $statement_result['email'] ?></div>
                                        </div>
                                        
                                        <p class="edit-btn"><i class="uil uil-edit-alt"></i>編輯</p>
                                    </div>

                                    <div class="update-box">
                                        <div class="update-block">
                                            <div class="title">電子信箱<span class="star">*</span>:</div>
                                            <input id="email" value="<?php echo $statement_result['email'] ?>" 
                                        type="email" name="update_email" placeholder="輸入電子信箱">
                                            <div class="error"></div>
                                        </div>
                                        <div class="btn-block">
                                            <button class="close-btn" type="button" data-target="cancel-section-2">取消</button>
                                            <button class="store" type="submit" disabled="disabled" data-target="edit-section-2">儲存</button>
                                        </div>
                                    </div>
                                </div>
                            
                            

                    
                                <div class="update-container" id="up_for_ps">
                                    <div class="display-box">
                                        <div class="info">
                                            <div class="title">密碼<span class="star">*</span>:</div> 
                                            <div class="data">已設定</div>
                                        </div>
                                        
                                        <p class="edit-btn"><i class="uil uil-edit-alt"></i>編輯</p>
                                    </div>

                                    <div class="update-box">
                                        <div class="update-block">
                                            
                                            <div class="title">舊密碼<span class="star">*</span>:</div>
                                            <input id="old_pass" type="password" name="old_pass" placeholder="輸入以前的密碼" class="box">
                                            <div class="error"></div>
                                        </div>
                                        
                                        <div class="update-block">
                                            <div class="title">新密碼<span class="star">*</span>:</div>
                                            <input id="new_pass" type="password" name="new_pass" placeholder="輸入新密碼" class="box">
                                            <div class="error"></div>
                                        </div>

                                        <div class="update-block">
                                            <div class="title">確認密碼<span class="star">*</span>:</div>
                                            <input id="re_pass" type="password" name="confirm_pass" placeholder="確認新密碼" class="box">
                                            <div class="error"></div>
                                        </div>

                                        <div class="btn-block">
                                            <button class="close-btn" type="button" data-target="cancel-section-3">取消</button>
                                            <button class="store" type="submit" disabled="disabled" data-target="edit-section-3">儲存</button>
                                        </div>
                                    </div>
                                </div>
                           
                            
                </form>
        </div>
    </div>

    <!-- 個人資料相片 -->
    <div id="image-screen">
        <div class="update-profile">
            <i class="uil uil-times form_close"></i>
            <h3>個人資料相片</h3>
            
                <div class="img-container">

                    <div class="direction">
                        <p>
                            個人資料相片可幫助其他使用者認出您，也能讓您判斷目前登入的是否確實是自己的帳戶
                        </p>
                    </div>

                    <div class="show-img">
                        <?php 
                            if($statement_result['image'] == ""){
                                echo '<img src="../../image/default_user.jpg" alt="user-img" >';
                            }else{
                                echo '<img src="../../image/uploaded_img/'. $statement_result['image'] .'" >';
                            }
                        ?> 
                    </div>

                    <div class="btn-block">
                        <button id="remove_image" class="close-btn remove_image"><i class="uil uil-trash-alt"></i>移除</button>
                        <button id="change_image"><i class="uil uil-pen"></i>變更</button>
                    </div>
                </div>

        </div>
    </div>

    <div id="remove-image">
        <div class="update-profile">
            <img src="../../image/turn_left.png" alt="" class="turn_left">
            <div class="show-img">
                <?php echo '<img src="../../image/default_user.jpg" alt="user-img" >';?> 
            </div>

            <div class="direction">
                    <h3>要移除個人資料相片嗎？</h3>
                    <p>
                        系統將會使用先前預設「個人資料相片」。這張圖片會取代您先前使用的相片。
                    </p>
            </div>

            <div class="btn-block">
                <button class="close-btn form_close">取消</button>
                <button id="remove_yes">移除</button>
                <input type="checkbox" name="del_img" id="del_img" hidden>
            </div>
           
        </div>
    </div>

    <!-- 上傳相片 -->
    <div id="upload-image">
        <div class="update-profile">
            <i class="uil uil-times form_close"></i>
            <h3>變更個人資料相片</h3>
            
                    <div class="drag-area" ondragover="return false">
                        <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <header>將相片拖曳到這裡</header>
                        <span>- 或 -</span>
                    </div>
                    
                    <div class="btn-block">
                        <button class="btn" id="btn-img">上傳照片</button>
                        <input type="file" name="input_image" id="input_image"
                        accept="image/jpg, image/jpeg, image/png" hidden>
                    </div>

        </div>
    </div>

      <!-- 版權宣告 -->
      <footer class="main-footer">
        <div class="container">
            <span class="copyright_text">阿天與鳥哥的邂逅 版權所有 &#169; 2023 <a href="#">C Language Program Translate.</a>All rights reserved</span>
        </div>
    </footer>
</body>


<script type="module" src="../../JS/index_click.js"></script>
<!-- update valid -->
<script type="module" src="../../JS/updatevalid.js"></script>
<!-- upload image -->
<script src="../../JS/upload_img.js"></script>
<script src="../../JS/translate.js"></script>


<script>
    var windowHeight = window.innerHeight;
    console.log("視窗高度:" + windowHeight + " 像素");
    var percentage = (643 / windowHeight) * 100;
    console.log(percentage + "vh");
</script>

</html>
