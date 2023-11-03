<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body> 
    <!-- 輸入、輸出框 -->
    <form action="#" class="translate-form">
        <div class="text-area">
            <div class="container">
                <textarea class="inputTextArea" name="input" cols="30" rows="10" placeholder="輸入中文"></textarea>
                <textarea class="outputTextArea" name="output" cols="30" rows="10" placeholder="程式碼翻譯" readonly="readonly">
                </textarea>
            </div>
        </div>
        <input id="translate" type="button" value="提交">
    </form>

    <script src="../../JS/translate.js"></script>
</body>
</html>
<?php
 
    $input = "你好，你好，你好";
        // $output = `python D:/app/xampp/htdocs/CLPT/python/Demo3.0.py $input`;
        $command = 'python D:/app/xampp/htdocs/CLPT/python/Demo3.0.py ' . escapeshellarg($input);
        $output = shell_exec($command);
        $output = iconv("big5", "UTF-8", $output);
    echo $output;
    
?>