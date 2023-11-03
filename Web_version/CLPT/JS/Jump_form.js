let isFormOpen = false;
let body = document.querySelector("body");
let signupBtn, loginBtn;
// 保存已經創建的 .main-container 元素
let mainContainer = $(".main-container");

$(document).ready(function () {
  /* 註冊表單視窗 */
  $("#login-signup").click(function () {
    if (isFormOpen == false) {
      if (mainContainer.length === 0) {
        Create_form();
        mainContainer.css("display", "flex"); // 顯示表單
      } else {
        if (mainContainer.css("display") === "none") {
          mainContainer.css("display", "flex");
        }
      }
      isFormOpen = true;
    }

    mainContainer = $(".main-container");
    signupBtn = $("#register-link");
    loginBtn = $("#login-link");
    const pwShowHide = $(".pw_hide");


    /* 切換表單 */
    signupBtn.on("click", function (e) {
      // 阻止按鈕的預設行為
      e.preventDefault();
      mainContainer.addClass("active");
    });

    loginBtn.on("click", function (e) {
      e.preventDefault();
      mainContainer.removeClass("active");
    });

    /* 點擊眼睛 */
    pwShowHide.on("click", function () {
      // 從眼睛找到父親再找到"input"輸入框
      let getPwInput = $(this).parent().find("input");
      // 修改眼睛和輸入框的屬性
      if (getPwInput.attr("type") === "password") {
        getPwInput.attr("type", "text");
        $(this).removeClass("uil-eye-slash").addClass("uil-eye");
      } else {
        getPwInput.attr("type", "password");
        $(this).removeClass("uil-eye").addClass("uil-eye-slash");
      }
    });

    /* 記住帳號 */

    // 檢查cookie
    if ($.cookie("account") != null) {
      // 將cookie中account的值填入到輸入框
      $("#login-user").val($.cookie("account"));
      // .prop("屬性名稱",值);
      // 讓"記住帳號"保持被勾選的狀態
      $("#remember").prop("checked", true);
    }

    $("#login-btn").click(function () {
      var username = $("#login-user").val(); // 帳號
      var remember = $("#remember").is(":checked") ? 1 : 0;
      // 如果被勾選則保留帳號7天
      if (remember == 1) {
        $.cookie("account", username, {
          expires: 7,
        });
      } else {
        // 如果沒有則移除之前已經保存過的資料
        $.removeCookie("account");
      }
    });
  });

  // 事件委托的方式
  $(document).on("click", ".form_close", function () {
    if (isFormOpen == true) {
      $(".main-container").css("display", "none"); // 關閉表单
      isFormOpen = false;
    }
  });
});

function Create_form() {
  // 創建登入註冊表單父元素(.main-container)
  const creat_mainContainer = document.createElement("div");
  creat_mainContainer.className = "main-container";
  body.appendChild(creat_mainContainer);

  const mainContainer = document.querySelector(".main-container");

  // 創建登入表單元素(#main-login)
  const loginForm = document.createElement("div");
  loginForm.id = "main-login";
  loginForm.innerHTML = `
          <div class="main-contents">
              <h2 class="title">登入帳號</h2>
              <i class="uil uil-times form_close"></i>
  
              <form action="#" id="login-form">
  
              <!-- 顯示訊息 -->  
  
                  <div class="form-message"></div>
                  
                  <div class="input-box">
                      <input id="login-user" class="user-id" type="text" name="email" required>
                      <i class="uil uil-envelope email"></i>
                      <label for="user-id">信箱帳號</label>
                  </div>
  
                  <div class="input-box">
                      <input id="login-password" class="user-password" type="password" name="password" required>
                      <i class="uil uil-lock passwd"></i>
                      <i class="uil uil-eye-slash pw_hide"></i>
                      <label for="user-password">密碼</label>
                  </div>
  
                  <div class="remember-forgot">
                      <label for="remember"><input type="checkbox" id="remember">
                      記住帳號</label>
                      <a href="#">忘記密碼?</a>
                  </div>
  
                  <div class="btn-login">
                      <button id="login-btn" class="btn" type="submit" name="login">登入</button>
                  </div>
  
                  <div class="switch-form">
                      <p>還沒有帳號?
                          <a id="register-link">立即註冊</a>
                      </p>
                  </div>
  
              </form>
          </div>
    `;

  // 插入登录表單元素到 main-container 中
  mainContainer.appendChild(loginForm);

  // 創建註冊表單元素
  const signupForm = document.createElement("div");
  signupForm.id = "main-signup";
  signupForm.innerHTML = `
          <div class="main-contents">
              <h2 class="title">註冊帳號</h2>
              <i class="uil uil-times form_close"></i>
  
              <form action="#" id="register-form" enctype="multipart/form-data">
                  
                  <!-- 顯示驗證訊息 -->
  
                  <div class="form-message"></div>
                  
  
                  <div class="main-user-info">
                      <div class="input-box">
                          <label for="fullname"><i class="uil uil-user"></i>用戶名</label>
                          <input id="fullname" name="fullname"
                          type="text" placeholder="輸入用戶名">
                      </div>
  
                      <div class="input-box">
                          <label for="user-id"><i class="uil uil-envelope email"></i>信箱帳號</label>
                          <input class="user-id" type="text" name="email"
                          placeholder="輸入電子郵件">
                      </div>
  
                      <div class="input-box pw">
                          <label for="user-password"> <i class="uil uil-lock passwd"></i>密碼</label>
                          <input class="user-password" type="password" name="password"
                          placeholder="輸入密碼">
                          <i class="uil uil-eye-slash pw_hide"></i>
                      </div>
  
                      <div class="input-box">
                          <label for="user-repassword"><i class="uil uil-lock passwd"></i>確認密碼</label>
                          <input id="user-repassword" type="password" name="repassword"
                          placeholder="再次輸入密碼">
                      </div>

  
                  </div> 
                  
  
                  <div class="btn-register">
                      <button class="btn" type="submit" name="register">註冊</button>
                  </div>
  
                  <div class="switch-form">
                      <p>已經有帳號?
                      <a href="#" id="login-link">立即登入</a>
                      </p>
                  </div>
  
              </form>
          </div>
          
    `;

  // 將註冊表單元素插入到 main-container 中
  mainContainer.appendChild(signupForm);
}