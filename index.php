<?php
	session_start();
	session_regenerate_id();

	if(!isset($_SESSION["count"])){
			//初回にリセット
			$_SESSION["count"] = 0;
	}
	++$_SESSION["count"];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<a href="./index.html">index.htmlへ</a>
<br/>
<span><?=$_SESSION['count']?>回目の訪問</span>
<br/>
<a href="./index.php">TOPへ</a><br/>
<a href="./delete_cookie.php">cookie削除</a><br/>
<a href="./show_cookie.php">cookie確認</a><br/>
<?php
	if(!isset($_COOKIE["testid"])){
		setcookie("testid","natsuki",time()+60*60,"","tetoteto.mydns.jp",true,true);
	}
	$pw = password_hash("nakazawanatsuki",PASSWORD_DEFAULT);
	echo "password_hash:$pw";
	#setcookie("testid","natsuki",time()+60*60,"/","tetoteto.mydns.jp",true,true);
	#	print("<a href="./delete_cookie.php">");
	$_SESSION["name"] = "nakazawa";
	phpinfo();
?>
</body>
</html>
