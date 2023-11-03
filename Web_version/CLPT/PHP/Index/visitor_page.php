
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link Icon -->
    <script src='https://kit.fontawesome.com/6eef60556d.js' crossorigin='anonymous'></script>
    
    <!-- link fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- link CSS -->
    <link rel="stylesheet" href="../../CSS/index/navbar.css">
    <link rel="stylesheet" href="../../CSS/index/footer.css">
    <link rel="stylesheet" href="../../CSS/index/dark.css">
    <link rel="stylesheet" href="../../CSS/index/login.css">
    <!-- icon CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <!-- link JQuery -->
    <script src="../../JS/jquery.min.js"></script>
    <!-- cookie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- link js -->
    <script src="../../JS/index_click.js"></script>
    <script src="../../JS/translate.js"></script>
    <!-- title -->
    <title>CLPT</title>
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
                        <ul class="menu" id="index-menu">
                            <!-- <li><a href="#" class="icon"><i class="fa-solid fa-file-waveform"></i>紀錄</a></li> -->
                            <li class="copy"><a href="#" class="icon"><i class="fa-solid fa-copy"></i>複製翻譯碼</a></li>
                            <li style="border-style: none;" id="change_theme"><a href="#" class="icon"><i class="fa-solid fa-circle-half-stroke"></i>變換樣式，黑/白</a></li>
                        </ul>
                </div>

                <button class="button" id="login-signup">登入/註冊</button>

                <button id="translate" class="button" type="submit">翻譯<i class="fa-solid fa-forward"></i></button>
            </nav>

        </div>

    </header>

    <!-- 輸入、輸出框 -->
    <form action="#" class="translate-form">
        <div class="container">
            <textarea class="inputTextArea" name="input" cols="30" rows="10" placeholder="輸入中文"></textarea>
            <textarea class="outputTextArea" name="output" cols="30" rows="10" placeholder="程式碼翻譯" readonly="readonly"></textarea>
        </div>
    </form>
    

    <!-- 版權宣告 -->
    <footer class="main-footer">
        <div class="container">
            <span class="copyright_text">阿天與鳥哥的邂逅 版權所有 &#169; 2023 <a href="#">C Language Program Translate.</a>All rights reserved</span>
        </div>
    </footer>

    <!-- jump out form -->
    <script src="../../JS/Jump_form.js"></script>
    <!-- ajax for login or signup -->
    <script src="../../JS/ajaxform.js"></script>
    
</body>
</html>
