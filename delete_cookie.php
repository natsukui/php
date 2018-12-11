<?php
	session_start();
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
<a href="./index.php">TOP</a><br/>
<a href="./delete_cookie.php">cookie削除</a><br/>
<a href="./show_cookie.php">cookie確認</a><br/>
<?php
	setcookie("testid","natsuki",time()-1,"/","tetoteto.mydns.jp",true,true);
	//セッション情報の削除
	unset($_SESSION['name']);
	//セッションファイルの削除
	$_SESSION = array();
	setcookie(session_name(), '', time()-1, '/');
	session_destroy();
	print("deleted");
?>

</body>
</html>