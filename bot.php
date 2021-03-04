<?php
/*
BY:- @BenchamXD
CHANNEL:- @IndusBots
*/
error_reporting(1);

set_time_limit(0);

flush();
$API_KEY = '1630240949:AAEaM7uvPRbBmOTCNpMv9t6BZ4AQAEXe3TI'; //Your token
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***Welcome to bin checker
Use*** `/bin xxxxx` ***to check the bin.
You can also make a bot like this from here:- https://github.com/BenchamXd/Bin-Checker***",
'parse_mode'=>"MarkDown",
]);
if(strpos($text,"/bin") !== false){ 
$bin = trim(str_replace("/bin","",$text)); 

$data = json_decode(file_get_contents("http://gotohell.me/b0t/api.php?lista=$bin"),true);
$message = $data['error']['message'];
$decline_code = $data['error']['decline_code'];
$succeeded = $data['status'];
 if($data['error']['message']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***VALID BIN✅
                
Bin: $bin
Status: { $succeeded } - { $message } - { $decline_code }
Checked By @$username***",
'parse_mode'=>"MarkDown",
]);
    }
else {
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"INVALID BIN❌",
               
]);
}
}
