<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CLPT 服務對象 Service Object</title>
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
            <h2 class="title-1">SERVICE <br>TARGETS</h2>
            <h2 class="title-2">為華語使用者創建一個更簡單、口語化的程式設計系統</h2>
            <h3 class="content">
            我們旨在讓程式設計變得更簡單，特別是針對初學者。現在，許多人感到學習程式語言很有挑戰，因為需要記住許多語法和邏輯規則，
            
            而且大多數程式語言都是英文的，對非英語母語者來說更加困難。因此，我們計劃創建一個針對華語使用者的系統，讓他們可以用口語的方式簡單地編寫程式，

            而不必記住所有的關鍵詞和語法。我們的目標是幫助人們克服對程式設計的恐懼，特別是對程式設計有興趣的孩子和初學者，讓他們能輕鬆地創建他們所需要的程式，

            而不需要深入研究程式語言的細節。我們希望通過這種方式讓更多人享受到創建程式的樂趣，增強他們的信心，並激發他們繼續學習的動力。
            </h3>

            <h3 class="content">
            此外，我們還希望支持創客文化。創客是一群熱愛科技和實驗的人，他們熱衷於分享技術和想法。我們的轉換器將使創客們更容易將自己的想法應用於技術領域

            ，例如Arduino的語音輸入模組，從而實現他們的創意。我們希望通過我們的產品為創客社群提供一個平台，讓更多人參與其中，並進行改進和優化。

            我們的目標是降低學習程式語言的門檻，推動創客文化，並為對程式設計感興趣的人們提供一個更自由、更直觀的程式創作方式。
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