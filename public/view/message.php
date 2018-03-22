<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/22
 * Time: 9:24
 */
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="background:skyblue">
<div class="jumbotron">
	<div class="container" style="margin-top: 100px;text-align: center">
		<h1><?php echo isset($message)?$message:'非工作人员不得入内';?></h1>
		<p><a href="<?php echo $this->url;?>"><span id="time">3</span>秒后自动跳转,点击快速跳转</a></p>
	</div>
</div>
<script>
	$(function () {
		setInterval(function () {
            var time = $('#time').html();
            time--;
            if (time==0){
                location.href="<?php echo $this->url;?>";
			}
			$('#time').html(time);
        },1000)
    })
</script>
</body>
</html>
