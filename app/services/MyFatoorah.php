<?php
namespace App\services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MyFatoorah{
    private $request_client;
    private $base_url;
    private $headers;

    public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('fatoora_base_url');
        $this->headers =[
            'Content-Type'=>'application/json',
            'Authorization'=>'Bearer '.env('fatoora_token'),
        ];
    }
    public function buildRequest($url,$method,$data=[]){
        $request = new Request($method,$this->base_url.$url,$this->headers);
        if(!$data){
          return false;
        }
        $response = $this->request_client->send($request,[
          'json'=>$data
        ]);
        if ($response->getStatusCode() != 200){
          return false;
        }
        $response =json_decode($response->getBody(),true);
        return $response;
    }
     public function sendPayment($data){

        return  $response = $this->buildRequest('v2/SendPayment','POST',$data);
  
      }
      public function getPaymentStatus($data){
    
        return  $response = $this->buildRequest('v2/getPaymentStatus','POST',$data);
      }
}