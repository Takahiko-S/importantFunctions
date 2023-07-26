<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Acclog;
use App\Models\PageTest;

class TestController extends Controller
{
    public function cookieTest(){
        
       // $code=$this->makeCode();
        //dd($code);
        
        //クッキーを取得
        $userCode = Cookie::get('user_code');
       //クッキーをチェックして分岐
        if($userCode){
            $res = "ユーザー識別コードは" . $userCode;
            
        }else{
            
        //クッキーセット
        $userCode = $this->makeCode();//セットする値
        Cookie::queue('user_code',$userCode, 60 * 24 * 30); //30日間保存       
        $res="クッキー" . $userCode . "をセットしました";
        }
        
        $user_agent =  $_SERVER['HTTP_USER_AGENT'];
        $acc_log = Acclog::where('user_code',$userCode)->first();
        
        if($acc_log){
            //データがある場合
           // $acc_log->agent= $user_agent;
           // $acc_log->save();

           
            
        }else{
            //データがない場合
            $acc_log = new AccLog();
            $acc_log->user_code = $userCode;
            $acc_log->agent= $user_agent;
            $acc_log->check= rand();
            $acc_log->save();
        }
        
        //ログデータ再読み込み
        $acc_log = Acclog::where('user_code',$userCode)->first();
    
        return view ('contents.cookie_test',compact('res','acc_log'));
    }
    
    public function deleteCookie(){
      Cookie::queue(Cookie::forget('user_code'));
      
      return response("クッキーを削除しました");
    }

    public function index()
    {

        return view('contents.index');
    }
    
    public function subContent()
    {
        $userCode = Cookie::get('user_code');
        $acc_log = Acclog::where('user_code', $userCode)->first();
        
        if ($userCode) {
            // データがある場合
            if ($acc_log) {
                $acc_log->check = rand();
                $acc_log->save();
            }
        }
        return view('contents.sub_content');
    }
    
    
    public function pagerTest(){
        $datas = PageTest::paginate(20);
        
        return view('contents.pager_test',compact('datas'));
    }
    
    
    //識別コード生成ファンクション
    function makeCode(){
        //現在時間と乱数を利用してコードを生成
        $code = md5( time() . rand());
        
        return $code;
    }
    
}
