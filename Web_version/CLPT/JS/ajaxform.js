$(document).ready(function () {
  $("#login-signup").click(function () {
    // 註冊事件
    $("#register-form").on("submit", function (e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "../../PHP/login-signup/register_process.php",
        data: new FormData($("#register-form")[0]),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        error: function () {
          alert("POST出錯");
        },
        success: function (response) {
          $(".form-message").css("display", "block");
          if (response.status == 1) {
            $("#main-signup").css("display", "none");
            $("#main-login").css("display", "block");
            $("#login-form")[0].reset();
            $("#login-form .form-message").html(
              "<p>" + response.message + "</p>"
            );
          } else {
            $(".form-message").css("display", "block");
            $(".form-message").html("<p>" + response.message + "</p>");
          }

          setTimeout(function () {
            $("#login-form .form-message").css("display", "none");
          }, 3000);
        },
      });
    });

    // 檔案驗證

    $("#user-image").change(function () {
      var file = this.files[0];
      var fileType = file.type;
      var match = ["image/jpeg", "image/jpg", "image/png"];

      if (
        !(fileType == match[0] || fileType == match[1] || fileType == match[2])
      ) {
        alert("抱歉，上傳的檔案須符合JPEG,JPG,PNG");
        $("#user-image").val("");
        return false;
      }
    });

    // 登入事件
    $("#login-form").on("submit", function (e) {
      e.preventDefault();

      var data = {
        email: $("#login-user").val(),
        password: $("#login-password").val(),
      };

      $.ajax({
        type: "POST",
        url: "../../PHP/login-signup/login_process.php",
        data: data,
        dataType: "json",
        cache: false,
        processData: true,
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR, textStatus, errorThrown);
          alert("POST出錯");
        },
        success: function (response) {
          if (response.status == 1) {
            $("#login-form")[0].reset();
            window.location.href = "../../PHP/Index/user_page.php";
          } else {
            console.log(data);
            $(".form-message").css("display", "block");
            $(".form-message").html("<p>" + response.message + "</p>");
          }
        },
      });
    });
  });
});
