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
	CURLOPT_URL => "http://gotohell.me/other/api.php?lista=".$bin,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"authority: tes-code485572.codeanyapp.com",
		"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
		"accept-language: en,id-ID;q=0.9,id;q=0.8,en-US;q=0.7"],
]);

$result = curl_exec($curl);
curl_close($curl);
data = json_decode($result, true);
$result = $data['result'];
echo "$result";
  if ($result != null) {
        send_MDmessage($chat_id, "***
    Bin: $bin
$result
Checked By ASUUUUU@$username ***");
    }
else {
    send_MDmessage($chat_id, "ENTER VALID CARD");
}
   }
//Send Messages with Markdown (Global)
      function send_MDmessage($chat_id, $message){
       $apiToken = "1662123689:AAEiZBqjdakgn3RKJ_Dz9raRSpHw-9V7MaU";
        $text = urlencode($message);
        file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&text=$text&parse_mode=Markdown");
    }
    
?>
