<?php
    date_default_timezone_set("Asia/kolkata");
    //Data From Webhook
    $content = file_get_contents("php://input");
    $update = json_decode($content, true);
    $chat_id = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    $id = $update["message"]["from"]["id"];
    $username = $update["message"]["from"]["username"];
    $firstname = $update["message"]["from"]["first_name"];
    $message_id = $upadte["message"]["message_id"];

    //Start message
    if($message == "/start"){
        send_message($chat_id, "Hey $firstname  \nUse /bin xxxxxx To check Bins  \nBot by @reboot13 ");
    }



//Bin Lookup
   if(strpos($message, "/bin") === 0){
        $bin = substr($message, 5);
   $curl = curl_init();
	curl_setopt_array($curl, [
	CURLOPT_URL => "http://gotohell.me/other/bot.php?lista=".$bin,
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
]);

$result = curl_exec($curl);
curl_close($curl);
$hasil = $result['<br>'];
  if ($result != null) {
        send_MDmessage($chat_id, "***
    Bin: $bin
Credit/Debit:$hasil
Checked By @$username ***");
    }
else {
    send_MDmessage($chat_id, "Enter Valid BIN");
}
   }
    
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message){
       $apiToken = "1641864324:AAHqKgh3HdWaawjwAj-gDB_bOMWW0Xi27K4";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    
?>
