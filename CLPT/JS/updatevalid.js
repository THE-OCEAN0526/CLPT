$(document).ready(function () {
  const form = $("#edit"),
    username = $("#username"),
    email = $("#email"),
    oldPassword = $("#old_pass"),
    newPassword = $("#new_pass"),
    rePassword = $("#re_pass");

  const storeBtns = $(".store");
  let storeBtn1, // 提升變數到迴圈外部
    storeBtn2,
    storeBtn3;

  // 獲取按鈕
  storeBtns.each(function (index) {
    if (index === 0) {
      storeBtn1 = storeBtns.eq(0);
    } else if (index === 1) {
      storeBtn2 = storeBtns.eq(1);
    } else if (index === 2) {
      storeBtn3 = storeBtns.eq(2);
    }
  });

  // 顯示失敗
  const setError = function (element, message) {
    const inputControl = element.parent();
    const errorDisplay = inputControl.find(".error");

    errorDisplay.text(message);
    inputControl.addClass("error").removeClass("success");
  };

  // 顯示成功
  const setSuccess = function (element) {
    const inputControl = element.parent();
    const errorDisplay = inputControl.find(".error");

    errorDisplay.text(""); // text() 用於獲取或設置選擇的元素的純文本內容。
    inputControl.addClass("success").removeClass("error");
  };

  // 驗證電子信箱
  const isValidEmail = function (email) {
    const re =
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    // string() 資料類型轉換為字串
    //檢查 string 是否符合該正則表達式的模式。如果匹配成功，test() 方法將返回 true，否則返回 false。
    return re.test(String(email).toLowerCase());
  };

  // 驗證密碼
  function isValidPassword(newPassword) {
    // 密碼規則：至少包含一個大寫字母、一個小小字母、一個數字和一個特殊字符
    const hasUppercase = /[A-Z]/.test(newPassword);
    const hasLowercase = /[a-z]/.test(newPassword);
    const hasNumber = /[0-9]/.test(newPassword);
    const hasSpecialChars = /[^A-Za-z0-9]/.test(newPassword);
    // console.log(hasLowercase);
    return hasUppercase && hasLowercase && hasNumber && hasSpecialChars;
  }

  // 檢查密碼是否匹配
  function arePasswordsMatching(newPassValue, rePassValue) {
    return newPassValue === rePassValue;
  }

  // 啟動表單
  form.on("keyup", function () {
    // trim() 移除字符串開頭和结尾的空格或其他指定字符
    const usernameValue = username.val().trim();
    const emailValue = email.val().trim();
    // 用戶名驗證
    if (usernameValue === "") {
      setError(username, "請輸入至少1個字元");
      // prop()用來設定、獲取、檢查，元素的屬性值
      storeBtn1.prop("disabled", true);
    } else {
      setSuccess(username);
      storeBtn1.prop("disabled", false);
    }

    // 電子信箱驗證
    if (emailValue === "") {
      setError(email, "請輸入電子信箱");
      storeBtn2.prop("disabled", true);
    } else if (!isValidEmail(emailValue)) {
      setError(email, "請提供1個有效的電子信箱");
      storeBtn2.prop("disabled", true);
    } else {
      setSuccess(email);
      storeBtn2.prop("disabled", false);
    }

    // 啟動按鈕
    if (isOldPassSuccess && isNewPassSuccess && isRePassSuccess) {
      storeBtn3.prop("disabled", false);
    } else {
      storeBtn3.prop("disabled", true);
    }
  });

  // 判定成功初始化
  let isOldPassSuccess = false,
    isNewPassSuccess = false,
    isRePassSuccess = false;

  // 啟動舊密碼輸入框
  oldPassword.on("keyup", function () {
    const oldPassValue = oldPassword.val().trim();
    // 原始密碼判斷
    if (oldPassValue === "") {
      setError(oldPassword, "必填欄位");
      isOldPassSuccess = false;
    } else {
      setSuccess(oldPassword);
      isOldPassSuccess = true;
    }
  });

  // 啟動新密碼輸入框
  let newPassValue = "";
  newPassword.on("keyup", function () {
    newPassValue = newPassword.val().trim();
    // 新密碼驗證
    if (newPassValue === "") {
      setError(newPassword, "必填欄位");
      isNewPassSuccess = false;
    } else if (!isValidPassword(newPassValue)) {
      setError(newPassword, "請輸入由英文大小寫和數字及符號混合組成的密碼");
      isNewPassSuccess = false;
    } else {
      setSuccess(newPassword);
      isNewPassSuccess = true;
    }

    // 與確認密碼同步驗證
    if (rePassword.val().trim() !== "") {
      rePassword.trigger("keyup"); // trigger 手動觸發特定事件的處理程序
    }
  });

  // 啟動確認密碼輸入框
  rePassword.on("keyup", function () {
    const rePassValue = rePassword.val().trim();

    // 確認密碼驗證
    if (rePassValue === "") {
      setError(rePassword, "必填欄位");
      isRePassSuccess = false;
    } else {
      // 新密碼比對驗證
      if (arePasswordsMatching(newPassValue, rePassValue)) {
        setSuccess(rePassword);
        isRePassSuccess = true;
      } else {
        setError(rePassword, "兩次輸入密碼不同");
        isRePassSuccess = false;
      }
    }
  });

  // 編輯區塊的顯示(開/關)
  function toggleEditDisplay() {
    let geteditbox = $(this).closest(".update-container").find(".update-box");
    let getdisplaybox = $(this).closest(".update-container").find(".display-box");

    if (geteditbox.css("display") === "none") {
      geteditbox.css("display", "flex");
      getdisplaybox.css("display", "none");
      editBtns.css("display", "none");
    } else {
      geteditbox.css("display", "none");
      getdisplaybox.css("display", "block");
      editBtns.css("display", "block");
    }
  }

  // reset函式
  function resetInputFields() {
    const fields = [oldPassword, newPassword, rePassword];

    $.each(fields, function (index, field) {
      const parent = field.parent();
      parent.removeClass("error success");
      parent.find(".error").text("");
      field.val("");
    });
  }

  // 開啟編輯區塊
  const editBtns = $(".edit-btn");
  editBtns.each(function () {
    $(this).on("click", toggleEditDisplay);
  });

  // 關閉編輯區塊
  const closeBtns = $(".close-btn");
  closeBtns.each(function () {
    $(this).on("click", function () {
      // 在點擊"取消"按钮时調用toggleEditDisplay函式
      toggleEditDisplay.call(this);
      // 清空输入欄位的值
      resetInputFields();
    });
  });

  // ajax後端請求 變更個人資料
  storeBtns.each(function () {
    $(this).on("click", function (e) {

        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: "../../PHP/login-signup/update_process.php",
            data: new FormData($("#edit")[0]),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            error:function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR, textStatus, errorThrown);
                alert("POST出錯");
            },
            success:function(response){
                if(response.status == 1){
                    console.log(response);
                    alert(response.message);
                    // 看formdate資訊
                    let object = {};
                    for (var pair of new FormData($("#edit")[0])) {
                        object[pair[0]] = pair[1];
                    }
                    console.log(object);
                    switch (response.where) {
                        case 'name':
                            $(".name_value").text(response.updateValue);
                            break;
                        case 'email':
                            $("#email_value").text(response.updateValue);
                            break;
                    }
                }else{
                    console.log(response);
                    alert(response.message);
                }
            }
        });
        toggleEditDisplay.call(this);
    });
  });


});