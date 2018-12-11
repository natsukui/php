<?php
//まずはHTTPステータス200を返す
http_response_code(200);
echo "200 {}";

//HTTPヘッダーを取得
$headers = getallheaders2();
//$headers = getallheaders();

foreach($_SERVER as $test){
	echo $test;
}
//署名検証用データを取得
$headerSignature = $headers["X-Line-Signature"];
//送られてきたJSONデータを取得
$json_string = file_get_contents("php://input");
$json = json_decode($json_string);

//Channel secretを秘密鍵としてjsonデータからハッシュ値計算
$channelSecret = 'd0bd6c07286d2fec31d47cc5cac8ca51';
$httpRequestBody = $json_string;
$hash = hash_hmac("sha256",$httpRequestBody,$channelSecret,true);
$signature = base64_encode($hash);
if($headerSignature !== $signature)
{
	return;
}
if($json->events[0]->type === "unfollow")
{
	$massage = "さようならにゃ";
}
if($json->events[0]->type === "message")
{
	//返信先取得
	$replyToken = $json->events[0]->replyToken;
	//メッセージを取得
	$message = $json->events[0]->message->text;
}
else{
	return;
}


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
			'text' => '' . $message . 'にゃ',
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


//getallheaders()が使えないので
function getallheaders2()
{
	$headers = array();
	foreach ($_SERVER as $name => $value) {
	  if (substr($name, 0, 5) == 'HTTP_') {
		$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
	  }
	}
	return $headers;
}
?>
