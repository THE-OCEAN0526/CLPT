$(document).ready(function(){
    const dropArea = $(".drag-area"),
        dragText = dropArea.find("header"),
        up_btn = $("#btn-img"),
        input = $("#input_image");
    
    let file;
    var fileobj;

    // 按下"上傳照片"
    up_btn.on("click", function(){
        input.click(); // 模擬被點擊，之後瀏覽器打開選擇視窗
        file_browse();
    });

    // 選擇完文件後觸發
    input.on("change", function(){
        file = this.files[0];
        dropArea.addClass("active");
        showFile();
    });

    // 拖曳目標到位置
    dropArea.on("dragover", function(event){
        event.preventDefault();
        dropArea.addClass("active");
        dragText.text("釋放滑鼠才能上傳");
    });

    // 拖曳目標離開位置
    dropArea.on("dragleave", function(){
        dropArea.removeClass("active");
        dragText.text("將相片拖曳到這裡");
    });

    // 釋放目標
    dropArea.on("drop", function(event /* 拖曳目標 */){
        event.preventDefault();
        // originalEvent獲取原生事件對象
        // dataTransfer事件對象的屬性，包含拖曳文件的相關數據
        // files[]用陣列存起來
        file = event.originalEvent.dataTransfer.files[0];
        upload_file(event);
        showFile();
    });

    // ondrop要執行的
    function upload_file(event) {
        if(event){
            event.preventDefault();
            fileobj = event.originalEvent.dataTransfer.files[0];
            jsFileUpload(fileobj);
        }else{
            console.log("沒有event");
        }
    }

    function showFile() {
        let fileType = file.type;
        let validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
        if(validExtensions.includes(fileType)){
            const fileSizeMB = 10*(10**6);
            if(file.size <= fileSizeMB){
                let fileReader = new FileReader();
                // onload處理加載完成後的操作
                fileReader.onload = function() {
                    // result 讀取文件内容後的结果 "DataURL"
                    let fileURL = fileReader.result;
                    let imgTag = `<img src="${fileURL}" alt="">`;
                    dropArea.html(imgTag); 
                };
                fileReader.readAsDataURL(file);
            }else{
                alert("照片必須小於10MB");
                dropArea.removeClass("active");
                dragText.text("將相片拖曳到這裡")
            }
        }else{
            alert("圖片必須是JPEG, JPG & PNG格式!");
            dropArea.removeClass("active");
            dragText.text("將相片拖曳到這裡")
        }
    }

    // 選擇完照片
    function file_browse() {
        $('#input_image').change(function() {
            fileobj = $('#input_image')[0].files[0];
            jsFileUpload(fileobj);
        });
    }

    // 上傳處理文件操作
    function jsFileUpload(file_obj) {

        if (file_obj !== undefined /* 被定義但沒有賦予值 */) {
            var form_data = new FormData();
            // form_data是信封，append是卡片放入這個信封裡的動作
            form_data.append('input_image', file_obj);

            $.ajax({
                url: "../../PHP/login-signup/upload.php",
                type: 'POST',
                data: form_data,
                dataType: "json",
                cache:false,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    // 檢查
                    console.log(response.status);
                    console.log(response.received_Files_Image);
                    console.log(response.received_Post_Image);
                    // 看formdate資訊
                    let object = {};
                    form_data.forEach((val, key) => {
                        object[key] = val;
                    });
                    console.log(object);

                    if(response.status == 1){
                        let fileReader = new FileReader();
                        fileReader.onload = ()=>{
                            let fileURL = fileReader.result;
                            let imgTag = `<img src="${fileURL}" alt="">`;
                            dropArea.innerHTML = imgTag;
                        }
                        fileReader.readAsDataURL(file);
                        alert("已上傳！");
                        console.log(response.test);
                        // 重新加载PHP頁面
                        location.reload();
                    }else{
                        console.log("上傳失敗！");
                        alert("上傳失敗！");
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("上傳失敗：" + jqXHR, textStatus, errorThrown);
                    alert("上傳失敗：" + errorThrown);
                }
            });
        }
    }


    $('#remove_yes').on('click', function(){
        $('#del_img').prop('checked', true);
        RemoveImage();
    });

    function RemoveImage(){
        var formData = new FormData();
        // key = del_img | value = $('#del_img').is(':checked') === true
        formData.append('del_img', $('#del_img').is(':checked'));
        $.ajax({
            url: "../../PHP/login-signup/upload.php",
            type: 'POST',
            data: formData,
            dataType: "json",
            cache:false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function(response) {
                // 檢查
                console.log(response.status);
                // // 看formdate資訊
                // let object = {};
                // formData.forEach((val, key) => {
                //     object[key] = val;
                // });
                // console.log(object);

                if(response.status == 1){
                    alert(response.message);
                    console.log(response.test);
                    // 重新加载PHP頁面
                    location.reload();
                }else{
                    console.log(response.message);
                    alert(response.message);
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("刪除失敗：" + jqXHR, textStatus, errorThrown);
                alert("刪除失敗：" + errorThrown);
            }
        });
    }
    
});