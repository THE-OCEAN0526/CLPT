<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CLPT 首頁 Home</title>
        <!-- CSS -->
        <link rel="stylesheet" href="../../CSS/index/Front_page.css">
        <link rel="stylesheet" href="../../CSS/index/login.css">
        <!-- icon CSS -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <!-- Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="" class="nav_logo">CLPT</a>

                <ul class="nav_items">
                    <li class="nav_item">
                        <a href="Home_page.php" class="nav_link">首頁</a>
                        <a href="Product_page.php" class="nav_link">產品介紹</a>
                        <a href="Service_page.php" class="nav_link">服務對象</a>
                        <a href="About_page.php" class="nav_link">關於我們</a>
                    </li>
                </ul>

                <div class="btn-box">
                    <button class="btns-login" onclick="location.href='visitor_page.php';">訪客</button>
                    <button class="btns-login" id="login-signup">登入/註冊</button>
                </div>
            
            </nav>

        </header>

        
        
        <section class="Home"></section>

        <div class="Essay-container">
            <h2 class="title-1">DESIGN <br>CONCEPT</h2>
            <h2 class="title-2">使程式設計變得更容易</h2>
            <h3 class="content">

            程式語言作為一種標準化的溝通工具，用於向電腦發送指令，是一種使程式設計師能準確定義電腦所需資料的語言。
            儘管自然語言和程式語言在功能上有著重大差異，但兩者都需要具備強大的表達能力和簡潔明了的機制。
            我們的想法是創建一個讓使用者能以自然語言與電腦進行交流的平台。
            我們因此開發了一款中文口述程式語言轉換器，讓使用者能夠將語言轉換成程式碼，藉此實現更直觀的程式創作方式。

            </h3>
        </div>

            <footer>
                <div class="bottom-details">
                    <div class="bottom_text">
                        <span class="copyright_text">阿天與鳥哥的邂逅 版權所有 &#169; 2023 <a href="#">C Language Program Translate.</a>All rights reserved</span>
                    </div>
                </div>
            </footer>

            <script>
                //屬標滾輪滾動事件
                window.addEventListener("scroll",()=>{
                    let header=document.querySelector("header");
                    header.classList.toggle("sticky",window.scrollY>0);
                })
            </script>

            <!-- jump out form -->
            <script src="../../JS/Jump_form.js"></script>
            <!-- ajax for login or signup -->
            <script src="../../JS/ajaxform.js"></script>

    </body>

        

</html>