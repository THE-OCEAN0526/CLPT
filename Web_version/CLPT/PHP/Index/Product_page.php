<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CLPT 產品介紹 Product Descriptino</title>
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
            <h2 class="title-2">我們的創新開發方法：讓程式設計變得更容易</h2>
            <h3 class="content">
            我們的作品具有以下特色，旨在為使用者提供更方便、直觀和自由的程式創作體驗：
            <br>
            一. 多模式輸入： 我們的翻譯器支援同時的鍵入和語音輸入。這使得使用者可以根據自己的習慣和需要，選擇最適合自己的輸入方式，從而提升使用效率。
            <br>
            二. 線上與單機版結合： 使用者可以下載並安裝我們的單機版本翻譯器，使其能夠在無需網絡的情況下使用。同時，當有網絡連接時，他們還可以使用我們的線上版本翻譯器，以獲取更完整和即時的翻譯體驗。
            <br>
            三. 免除記憶負擔： 使用者無需記住程式語言的各種關鍵字和語法，只需用自然語言進行描述，系統就能自動將其轉換成對應的程式碼。這減輕了初學者和非專業人士學習程式語言的負擔。
            <br>
            四. 使用口語化： 我們的系統允許使用者使用口語的方式來創建程式，這使得程式創作更加自然和流暢。無論是創客還是新手，都能夠輕鬆地將想法轉化為程式碼。
            <br>
            五. 針對不同使用者： 我們的翻譯器不僅適用於想要學習程式語言的初學者，也適合創客和其他不熟悉程式語言的使用者。無論是在學習、創作還是實踐中，都能為使用者提供便捷的工具。
            <br>
            我們的產品將提供一個簡單而功能強大的平台，將自然語言和程式語言無縫結合，使更多人能夠輕鬆進行程式創作，同時為創客和非專業人士提供更佳的操控電腦方式。
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