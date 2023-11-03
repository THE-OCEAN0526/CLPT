$(document).ready(function(){
    let $inputTextArea = $(".inputTextArea");
    let $outputTextArea = $(".outputTextArea");
        

        $("#translate").on('click', function(event){
            event.preventDefault();

            let formData = new FormData($(".translate-form")[0]);
            // let clientTime = new Date().toISOString();
            // formData.append('clientTime', clientTime);
           
            $.ajax({
                type: "POST",
                url: "../../PHP/login-signup/translate_process.php",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                    alert("POST出錯");
                },
                success: function (response) {
                    if (response.status == 1) {
                        console.log(response.status);
                        console.log(response.translatedText);
                        console.log(response.test);
                        $outputTextArea.val(response.translatedText);
                        // 看formdate資訊
                        let object = {};
                        for (var pair of formData) {
                            object[pair[0]] = pair[1];
                        }
                        console.log(object);
                    }else {
                        alert(response.message);
                        // 看formdate資訊
                    let object = {};
                    for (var pair of formData) {
                        object[pair[0]] = pair[1];
                    }
                      }
                }
              });
            });

    // 複製文本
    $(".copy").click(function(){
        const $textToCopy = $outputTextArea.val();

        // 使用 Clipboard API 複製文本到剪貼簿
        navigator.clipboard.writeText($textToCopy).then(function() {
            console.log('文本以複製到剪貼簿');
        }).catch(function(err) {
            console.error('複製文本到剪貼簿失敗：', err);
        });

        $(".menu").slideUp(500); /* 收回選單 */
    });

});
