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
	if(isset($_COOKIE["testid"]))
	{
		$testid = $_COOKIE["testid"];
		echo "testid=$testid";
		echo "<br/>";
	}
	$name = $_SESSION["name"];
	echo "\$_SESSION[\"name\"]=$name";
	echo "<br/>";
	$PHPSESSID = session_id();
	echo "PHPSESSID=$PHPSESSID";
	echo "<br/>";

?>
</body>
</html>

