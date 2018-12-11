<?php
// HTTPヘッダを設定
$channelToken = 'U1vBrOGoT3FBZEursCpiSTq7+s7OZmO40fm5eScPtzVv7ugA6dmwsdBInBsRYLsWwuWzj+Fe9SeRLgnmjj7Z6vcATQqKmpB/JGk5+ggfwEOjD/r+C+3yVeEFeLBztR/lyXjg40s1gudMtg1dsX2YgQdB04t89/1O/w1cDnyilFU=';
$headers = [
	'Authorization: Bearer ' . $channelToken,
	'Content-Type: application/json; charset=utf-8',
];

// POSTデータを設定してJSONにエンコード
$post = [
	'to' => 'Uf5f54042b53d7864d360e950e5326481',
	'messages' => [
		[
			'type' => 'text',
			'text' => 'hello world',
		],
	],
];
$post = json_encode($post);

// HTTPリクエストを設定
$ch = curl_init('https://api.line.me/v2/bot/message/push');
$options = [
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_HTTPHEADER => $headers,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_BINARYTRANSFER => true,
	CURLOPT_HEADER => true,
	CURLOPT_POSTFIELDS => $post,
];
curl_setopt_array($ch, $options);

// 実行
$result = curl_exec($ch);

// エラーチェック
$errno = curl_errno($ch);
if ($errno) {
	echo $errno;
	return -1;
}

// HTTPステータスを取得
$info = curl_getinfo($ch);

$httpStatus = $info['http_code'];

$responseHeaderSize = $info['header_size'];
$body = substr($result, $responseHeaderSize);

// 200 だったら OK
echo $httpStatus . ' ' . $body;

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
	<?php
		echo $_COOKIE["testid"];
	?>
</body>
</html>