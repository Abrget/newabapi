<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function status(Request $request){
        $arr = array('id' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

      
        $key = $request->key;
         $secret = $request->secret;
         
      
 
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
 
 
 $result = json_decode($result);
 
  return $result;
  }
   public function sbalance(Request $request){
        $key = $request->key;
         $secret = $request->secret;
         
      
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
 $result = json_decode($result,true);
 
 
 if(empty($result)){
 
  
 }
 return $result;
  }
   public function fbalance(Request $request){
        $key = $request->key;
         $secret = $request->secret;
         
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
 
 $result = json_decode($result, true);
 
 
 
 if(empty($result)){
 
    return "empty"; 
 }
 return $result;
       
 
  }
     public function withdraw(Request $request){
        
        $api_key = $request->key;
       $secret = $request->secret;
         $address=$request->address;
         $amount=$request->amount;
         
     
     
     $s_time = "timestamp=".time()*1000;
     
     $sign=hash_hmac('SHA256', $s_time, $secret);
         
  
     $s_time = "timestamp=".time()*1000;
     
  
 $params = [];
 
 $params['coin'] = "USDT";
 $params['address'] = $address;
 $params['network'] = "TRX"; 
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
 $res = curl_exec($curl_handle);
 curl_close($curl_handle);
 error_log(print_r($res,true)); 
 echo $res;
 
 
 
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
}
