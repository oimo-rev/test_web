<?php
class Controller_Login extends Controller
{
   public function action_index()
   {
       // アクセスしてきたデバイスを取得する
       $device = getDevice();
       
       // タイトルIDを取得する    
       $titleID = Input::get('title_id');
       
       //アクセスしてきたデバイスに応じて、URLSchemeを取得する
       $urlScheme = "";
       $storeURL = "";
       if ("ios" === $device) {
           // iOS端末の場合
           $urlScheme = "MyApp://";
           $storeURL = "https://itunes.apple.com"; //仮
           
       } else if ("Android" === $device) {
           // Android
           $urlScheme = "".$titleID;
           $storeURL = "";
       } else if ("other" === $device) {
           // その他PCなど
           $storeURL = "http://fbc-web.jp/";
       }
       
       var_dump($urlScheme);
       var_dump($storeURL);
       
       return ;
       
       //ビューテンプレートを呼び出し
       $view = View::forge('share');
       
       // ビューに値をセットする
       $view->set('urlScheme', $urlScheme);
       $view->set('storeURL', $storeURL);
       return $view;
   }
   
   function getDevice() {
       $userAgent ="";
       $device = "";       
       // 中身
       $userAgent = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
       if(strpos($userAgent,'iphone') !== false){
           $this->device = 'ios';
       }elseif(strpos($userAgent,'ipad') !== false){
           $this->device = 'ios';
       }elseif((strpos($userAgent,'android') !== false) && (strpos($this->ua, 'mobile') !== false)){
           $this->device = 'android';
       }else{
           $this->device = 'others';
       }
          return $device;
   }
}