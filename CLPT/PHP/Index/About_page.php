<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CLPT 關於我們 About Us</title>
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
            <h2 class="title-2">革命性程式設計：我們團隊為您帶來無縫體驗</h2>
            <h3 class="content">
            我們的團隊採用了MVC架構（Model-View-Controller），以確保系統具有模組化、可擴展性和出色的使用者體驗。不同成員負責不同領域的開發，確保每個方面都得到充分關注：
            <br>
            ● 單機操作介面開發：使用Java的Swing工具開發基本的單機操作介面，定義操作流程和熱鍵，確保與網頁版介面功能一致。
            <br>
            ● 網頁前端開發：使用HTML5和CSS創建網頁前端介面，實現排版、美化和響應式設計，並增加JavaScript互動元素，提升使用者體驗。
            <br>
            ● 網頁後端開發與資料庫建立：使用PHP開發網頁後端功能，同時建立關聯式資料庫，實現前後端數據交互。
            <br>
            ● 主要模型設計：設計主要模型，包括斷詞工具的選擇和C程式語言關鍵字的分類和對應表設計，支援資料庫建立。
            <br>
            ● 整合與測試：整合各模組並進行系統測試，確保資料正確互通，保證系統正常運行。
            <br>
            ● 網頁版翻譯介面：設計以自然語言輸入C程式語言的網頁介面，強調使用者體驗和操作簡潔性。
            <br>
            ● 資料庫與模型整合：整合主要模型和資料庫，確保模型處理數據正確並通過前端展示結果。
            <br>
            ● 單機版與網頁版整合：整合單機操作介面和網頁前端，確保功能、操作流程和熱鍵無縫切換。
            <br>
            我們的方法旨在確保系統順暢運行，提供給使用者直觀而流暢的程式創作體驗。這使得系統不僅具有互動性和美觀性，還為使用者帶來卓越的使用體驗。
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