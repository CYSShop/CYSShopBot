<?php
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');


$TOKEN = '838275789:AAHY3XDl8Y_hhT5m6FA_dDAvVZERFqFFdA0';
$BOT_USERNAME = 'CBuYBot';
$webhook = 'https://github.com/CYSShop/CYSShopBot/blob/master/CBuYBot.php'
$url = 'https://api.telegram.org/bot'.$TOKEN.'/';
echo get($url.'setWebhook?url='.$webhook);


if (($json = valid()) == false) { echo "Hi, CYSShop_Bot"; exit(); }

	$uid = $json['message']['from']['id'];        
	$first_name = $json['message']['from']['first_name'];

	$ANSWER = "Приветствую, ".$first_name;


	$text = $json['message']['text'];

  switch($text){
      
    case 'Мануалы':
      $ANSWER = "Тут будет раздел мануалов";
      
    break;
        
    case 'Контакты':
      $ANSWER = "Почему-то пока не работает";
      
    break;
      
    case 'Схемы':
      $ANSWER = "Тут будут платные схемы";
      
    break;
    
    case 'Канал':
      $ANSWER = "Тут будет кнопка для перехода на канал ТГ";
      
    break;
      
    case 'Помощь':
      $ANSWER = "Здесь будет помощь";
      
    break;      
      
case '/start':
      $ANSWER = "Рад поприветствовать тебя в боте канала CYS - CreateYourSelf
      Список комманд представлен в виде кнопок ниже";
      $keyboard = keyboard();
        
break;      
  }

sendMessage($uid,$ANSWER, $keyboard);

function keyboard() {
  
  var_dump($keyboard = json_encode($keyboard = ['keyboard' => [
   ['Схемы','Мануалы','Канал'],
    ['Помощь','Контакты']
  ] ,
  'resize_keyboard' => true,
  'one_time_keyboard' => false,
  'selective' => true
  ]),true);

  return $keyboard;
}

function delete_keyboard()
{
  var_dump($keyboard = json_encode($keyboard =  array('remove_keyboard' => true)));
  return $keyboard;
}


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
