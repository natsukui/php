<?php
	$url = "https://www.yahoo.co.jp";
	$url = "https://tetoteto.mydns.jp/";

	//curlの初期化
	$curl = curl_init($url);

	//オプションの配列
	//ヘッダー
	$headers = [
		'Authorization: Bearer ' . $channelToken,
		'Content-Type: application/json; charset=utf-8',
	];

	$optget = [
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_HTTPGET =>true,
	];

	$optpost = [
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => http_build_query(["id" => "xxxx"]),
	];

	$opt = $optget;

	//オプションを設定
	curl_setopt_array($curl, $opt);

	//リクエスト実行
	$result = curl_exec($curl);

	curl_close($curl);

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
	<span>リクエスト実行結果は～～～</span>
	<?php
		echo $result;
	?>
</body>
</html>