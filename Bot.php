<?php
$TOKEN = '913263427:AAEF1BV4fTAxci35TboRtSm9iyUz9DCQ9-k';
$BOT_USERNAME = 'CYSShop_Bot';
$webhook = 'https://github.com/CYSShop/CYSShopBot/blob/master/Bot.php';

$url = 'https://api.telegram.org/bot'.$TOKEN.'/';


if (($json = valid()) == false) { echo get($url.'setWebhook?url='.$webhook); exit();}
 
$uid = $json['message']['from']['id'];
$first_name = $json['message']['from']['first_name'];
$ANSWER = "Ну привет, ".$first_name;
sendMessage($uid,$ANSWER);


function valid() {
	$request_from_telegram = false;
	if(isset($_POST)) {
		$data = file_get_contents("php://input");
		if (json_decode($data) != null)
			$request_from_telegram = json_decode($data,1);
	}
	return $request_from_telegram;
}


function sendMessage($chat_id,$text,$markup=null)
{
	return get($GLOBALS['url'].'sendMessage?chat_id='.$chat_id.'&text='.urlencode($text).'&reply_markup='.$markup.'&parse_mode=Markdown');
}

function get($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

?>
