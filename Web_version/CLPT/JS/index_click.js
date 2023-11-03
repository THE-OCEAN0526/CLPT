$(document).ready(function(){

    /* 點擊式下拉式選單 */
    $("#selected").click(function(){
        $(".menu").slideToggle(500);
    });

    /* 黑白背景樣式 */
    $("#change_theme").click(function(){
        $(".main-header").toggleClass("dark");
        $(".main-footer").toggleClass("dark");
        $(".logo").toggleClass("dark");
        $("textarea").toggleClass("dark");
        $(".button").toggleClass("dark");
        $(".menu").toggleClass("dark");
        $(".copyright_text").toggleClass("dark");
        $(".copyright_text a").toggleClass("dark");
        $(".UserName").toggleClass("dark");
        $(".menu").slideUp(500); /* 收回選單 */
        // 
    });

    /* 顯示變更密碼視窗 */
    // $('#pass_form').click(function(){
    //     $(".menu").slideUp(300); /* 收回選單 */
    //     $('#pass-screen').addClass('open');
    // });

    // $('.form_close').click(function(){
    //     $('#pass-screen').removeClass('open');
    //     // 關掉刷新表單
    //     $("#modify")[0].reset();
    // });


    /* 點擊眼睛 */
    const pwShowHide = $('.pw_hide');
    pwShowHide.on('click', function() {
        // 從眼睛找到父親再找到"input"輸入框
        let getPwInput = $(this).parent().find('input');
        // 修改眼睛和輸入框的屬性
        if (getPwInput.attr('type') === 'password') {
            getPwInput.attr('type', 'text');
            $(this).removeClass('uil-eye-slash').addClass('uil-eye');
        } else {
            getPwInput.attr('type', 'password');
            $(this).removeClass('uil-eye').addClass('uil-eye-slash');
        }
    });


    /* 顯示編輯個人資料視窗 */
    $('#user_form').click(function(){
        $(".menu").slideUp(300); /* 收回選單 */
        $('#personal-screen').addClass('open');
    });

    $('.form_close').click(function(){
        $('#personal-screen').removeClass('open');
    });

    /* 顯示相片視窗 */
    $('.user-img').click(function(){
        $('#image-screen').addClass('open');
    });

    $('.form_close').click(function(){
        $('#image-screen').removeClass('open');
        $('#remove-image').removeClass('open');
    });

    /* 刪除照片視窗 */
    $('#remove_image').click(function(){
        $('#remove-image').addClass('open');
    });

    $('.turn_left').click(function(){
        $('#remove-image').removeClass('open');
    });

    // $('.remove_close').click(function(){
    //     $('#remove-image').removeClass('open');
    // });

    /* 上傳照片視窗 */
    $('#change_image').click(function(){
        $('#upload-image').addClass('open');
    });

    $('.form_close').click(function(){
        $('#upload-image').removeClass('open');
    });

    /* 編輯按鈕 */

    // editBtns.each(function(index){
    //     switch (index) {
    //         case 0:
    //             editBtn1 = editBtns.eq(0);
    //             break;
    //         case 0:
    //             editBtn2 = editBtns.eq(1);
    //             break;
            
    //         default:
    //             break;
    //     }
    // });
    // 隐藏所有的编辑框
    
    /* 編輯個人資料 */
    // const editBtns = $('.edit-btn');
    // editBtns.on('click',function(){
    //     let geteditbox = $(this).closest('.update-container').find('.update-box');
    //     let getdisplaybox = $(this).closest('.update-container').find('.display-box');
    //     if(geteditbox.css('display') === 'none'){
    //         geteditbox.css('display','flex');
    //         getdisplaybox.css('display','none');
    //         editBtns.css('display','none');
    //     }
    // });

    
    // const closeBtns = $('.close-btn');
    // closeBtns.click(function(){
    //     let geteditbox = $(this).closest('.update-container').find('.update-box');
    //     let getdisplaybox = $(this).closest('.update-container').find('.display-box');
    //     if(geteditbox.css('display') === 'flex'){
    //         geteditbox.css('display','none');
    //         getdisplaybox.css('display','block');
    //         editBtns.css('display','block');
    //     }
    // });

    
    // const closeBtns = $('.close-btn');
    // closeBtns.each(function (){
    //    $(this).on('click', function (){
    //       toggleEditDisplay();
    //     //   $("#old_pass, #new_pass, #re_pass").val('');
    //     });
       
    // });
    
});