<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
//背景画像作成ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    public function makeBackImage(Request $request){
        if($request->has('send')){
            //dd($request->all());
            
            $background_color = $request->color;
            $dpi = $request->dpi;
            $width = $request->width;
            $height = $request->height;
            
            $image_data =$this->createBackImage($background_color, $dpi, $width, $height);
            $image = "data:image/png;base64," . base64_encode($image_data->encode('png'));
            //画像を保存
            $temp_path = storage_path('app/tmp/');
            $file_name = "temp_back.png";
            $file_path = $temp_path . $file_name;
            file_put_contents($file_path, $image_data);
            
        }else{
            $image = "";
        }
        
        return view('contents.make_back_image',compact('image'));
        
    }
//QRコードファンクションーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    public function makeQr(Request $request){
        if($request->has('send')){
            //dd($request->all());
            $text = $request->qr_text;
            $dpi = $request->dpi;
            $size = $request->width;
            $image_data = $this->makeQrCode($text, $dpi, $size);
            //画像を保存
            $temp_path = storage_path('app/tmp/');
            $file_name = "temp_qr.png";
            $file_path = $temp_path . $file_name;
            file_put_contents($file_path, $image_data);
            
            $image = "data:image/png;base64," . base64_encode($image_data);
            
        }else{
        
        $image = "";
        }
        return view('contents.make_qr_code',compact('image'));
    }
    //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    public function whiteToClear(Request $request){
      
            $image = "";

        return view('contents.white_to_clear',compact('image'));
    }
    
//画像の白を透明化
    public function whiteTo(Request $request){
       // dd($request->all());
        if($request->has('file')){
            $params =$request->validate([
                'file' =>'required|file|image|max:50000',   //size＝KB
            ]);
            $file = $params['file'];
                     
             
            //$file_path = Storage::putFile('main_images',$file);//ランダムファイル名
            //Storageを利用したファイルの保存方法
            $file_path = Storage::putFileAs('main_images',$file,"base.png");//指定ファイル名こっちは上書きされるからたまらない
          // dd($file_path);
           //白を透明化にする呼び出し
            $image_data = $this->WhiteToTransparent(storage_path("app/".$file_path));
            //ビットマップをpng形式で保存
            imagepng($image_data,storage_path("app/main_images/change.png"));
            //画像データの読み込み
            $file_data = file_get_contents(storage_path("app/main_images/change.png"));
            //画像データを表示用にエンコード
            $image = 'data:image/png;base64,' . base64_encode($file_data);
        }else{
            $image = "";   
        }
        
        
        return view('contents.white_to_clear',compact('image'));
    }
    //画像の黒を指定色に変更
    public function blackToChange(Request $request){
        
        $image = "";  
        return view('contents.black_to_change',compact('image'));
    }
    
    //画像の黒を指定色に変更
    public function blackTo(Request $request){
        //dd($request->all());
        if($request->has('file')){
            $params =$request->validate([
                'file' =>'required|file|image|max:50000',   //size＝KB
            ]);
            $file = $params['file'];
            
            
            //$file_path = Storage::putFile('main_images',$file);//ランダムファイル名
            //Storageを利用したファイルの保存方法
            $file_path = Storage::putFileAs('main_images',$file,"master.png");//指定ファイル名こっちは上書きされるからたまらない
            // dd($file_path);
            //白を透明化にする呼び出し
            $image_data = $this->WhiteToTransparent(storage_path("app/".$file_path));
            
            //カラーコードを10進数に変更
            $color_10 = $this->hexToRGB($request->color);
            //黒を指定色にする呼び出し
           // $image_file = file_get_contents(storage_path("app/".$file_path));
           // $master_image = imagecreatefromstring($image_file);
            $image_data = $this->blackToColor($image_data, $color_10);
            //$image_data = $this->blackToColor2($image_data, $color_10,48);
            //ビットマップをpng形式で保存
            imagepng($image_data,storage_path("app/main_images/result.png"));
            //画像データの読み込み
            $file_data = file_get_contents(storage_path("app/main_images/result.png"));
            //画像データを表示用にエンコード
            $image = 'data:image/png;base64,' . base64_encode($file_data);
        }else{
        $image = "";  
            
        }
            
        return view('contents.black_to_change',compact('image'));
    }
    //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function makePrintImage(Request $request){
        
        $image = "";  
        return view('contents.make_print_image',compact('image'));
    }
        
        function makePrint(Request $request){
           // dd($request->all());
            if($request->has('send')){
                $bg_color = $request->color; 
                $dpi = $request->dpi;
                $width = $request->width;
                $height = $request->height;
                $qr_size = $request->qr_size;
                $qr_color = $request->qr_color;
                $qr_text = $request->qr_text;
                $bg_text = $request->bg_text;
                
                $imge_data = $this->makeQrPrintImage($bg_color, $dpi, $width, $height, $qr_size, $qr_color, $qr_text, $bg_text);
                //画像データを表示用にエンコード
                $image = 'data:image/png;base64,' . base64_encode( $imge_data );
            }else{
            $image = ""; 
                
            }
            return view('contents.make_print_image',compact('image'));
        
    }
    
    
//背景画像生成ファンクションーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function createBackImage($background_color,$dpi,$width,$height,$bg_text){
        $mmToPixel = $dpi/25.4;//サイズmmをdpiにあわせてピクセルサイズにする定数
        $image_width = $width * $mmToPixel;
        $image_height = $height * $mmToPixel;
        
        $image = Image::canvas($image_width,$image_height,$background_color);
        
        return $image;
    }
    
 //日本語対応QRコードファンクション  Endroid\QrCode\QrCode;ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function makeQrCode($text,$dpi,$size){
        $mmToPixel = $dpi/25.4;//サイズmmをdpiにあわせてピクセルサイズにする定数
        $qr_size = $size * $mmToPixel;
        
        $qrCode = new QrCode($text);
        $qrCode->setSize($qr_size);
        
        $writer =new PngWriter();
        $result = $writer->write($qrCode);
        $pngData = $result->getString();
              
        return $pngData;
        
        
    }
 //白を透明化するファンクションーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function WhiteToTransparent($originalImage){
        //元の画像から情報を取得
        list($width,$height) = getimagesize($originalImage);
        $newImage = imagecreatetruecolor($width,$height);
        
        //透明度を有効にする
        imagealphablending($newImage,false);
        imagesavealpha($newImage,true);
        
        //元の画像をロード
        $source = imagecreatefrompng($originalImage);
        
        //元の画像の色を調べ、白色なら透明に変換
        for($y=0;$y<$height;$y++){
            for($x=0;$x<$width;$x++){
                $color = imagecolorat($source,$x,$y);
                $rgb = imagecolorsforindex($source,$color);
                
                //この部分で白色を定義しています。RGB値がすべて255（白色）の場合を変更可能
                if($rgb['red'] == 255 && $rgb['green']==255&&$rgb['blue']==255){
                    //透明色を作成
                    $transparent = imagecolorallocatealpha($newImage,0,0,0,127);
                    //その座標に透明色を描画
                    imagesetpixel($newImage, $x, $y, $transparent);
                }else{
                    //白色でない場合は元の色をそのまま使用
                    imagesetpixel($newImage, $x, $y, $color);
                }
            }
        }
        
        //メモリ開放
        imagedestroy($source);
        
        //戻り値はbitmap形式
        return $newImage;
              
    }
    
    //黒を指定色にするファンクションーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function blackToColor($image,$newColor){
        $width = imagesx($image);
        $height= imagesy($image);
        
        $newRed = $newColor[0];
        $newGreen = $newColor[1];
        $newBlue = $newColor[2];
        
        //元の画像をコピーして黒い部分を新しい色にする
        for($x = 0;$x<$width;$x++){
            for($y = 0;$y<$height;$y++){
                $color = imagecolorat($image,$x,$y);
                $alpha = ($color>>24)&0xFF;
                $red = ($color>>16)&0xFF;
                $green = ($color>>8)&0xFF;
                $blue = $color&0xFF;
                
                //黒色の場合、新しい色にする
                if($red === 0 && $green === 0 && $blue ===0){
                    $red = $newRed;
                    $green = $newGreen;
                    $blue = $newBlue;
                    //RGB と透明度を保持した新しい色を割り当てる
                }
                    $color = imagecolorallocatealpha($image, $red, $green, $blue, $alpha);
                    imagesetpixel($image, $x, $y, $color);
            }
        }
            return $image;
    }
    
    //黒を指定職にするファンクション近似値ありで完全に変換ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function blackToColor2($image,$newColor,$blackThreshold=0){
        $width = imagesx($image);
        $height = imagesy($image);
        
        $newRed = $newColor[0];
        $newGreen = $newColor[1];
        $newblue = $newColor[2];
        
        //元の画像をコピーして黒い部分を新しい色にする
        for($x = 0;$x<$width;$x++){
            for($y = 0;$y<$height;$y++){
                $color = imagecolorat($image,$x,$y);
                $alpha = ($color>>24)&0xFF;
                $red = ($color>>16)&0xFF;
                $green = ($color>>8)&0xFF;
                $blue = $color&0xFF;
                
                //黒色の場合、または閾値以下の場合、新しい色にする
                if($red <= $blackThreshold && $green <= $blackThreshold && $blue <=$blackThreshold){
                    $Red = $newColor[0];
                    $Green = $newColor[1];
                    $blue = $newColor[2];
                }
                //RGB と透明度を保持下あたらしい色を割り当てる
                $color = imagecolorallocatealpha($image, $red, $green, $blue, $alpha);
                imagesetpixel($image, $x, $y, $color);
            }
        }
        return $image;
    }
    
    //色コードを１０進数の配列に変換ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    function hexToRGB($hexColorCode){
        //"#"が含まれている場合は削除
        $hexColorCode = ltrim($hexColorCode,'#');
        
        //16進数の色コードを１０進数に変換
        $red = hexdec(substr($hexColorCode,0,2));
        $green =hexdec(substr($hexColorCode,2,2));
        $blue = hexdec(substr($hexColorCode,4,2));
        
        return[$red,$green,$blue];
    }
    
    
    
    //画像合成ファンクション
    function makeQrPrintImage($bg_color,$dpi,$width,$height,$qr_size,$qr_color,$qr_text,$bg_text){
        
        $mmToPixel = $dpi/25.4;//サイズmmをdpiにあわせてピクセルサイズにする定数
        $image_width = $width * $mmToPixel;
        $image_height = $height * $mmToPixel;
       // $qr_image_size = $qr_size * $mmToPixel;
        
        $image = Image::canvas($image_width,$image_height,$bg_color);
        
        $text = $qr_text;
        $dpi = $dpi;
        $size = $qr_size;
        $image_data = $this->makeQrCode($text, $dpi, $size);
        //QR画像を保存
        $temp_path = storage_path('app/tmp/');
        $file_name = "temp_qr.png";
        $file_path = $temp_path . $file_name;
        file_put_contents($file_path, $image_data);
        //QRのサイズを取得
        $image_size = getimagesize($file_path);
        $qr_image_size = $image_size[0];
        
        //QR画像を透明化
        $trnsparentQrImage = $this->WhiteToTransparent($file_path);
        //QRの指定色を１０進数に変換
        $colorCode = $this->hexToRGB($qr_color);
        //指定色にQRを変更
        $change_qr = $this->blackToColor($trnsparentQrImage, $colorCode);
        
        //画像の合成
        $qrCodeX = ($image_width - $qr_image_size) / 2;
        $qrCodeY = ($image_height - $qr_image_size) / 2;
    
        //BGのテキストがあれば実行
        if($bg_text != null){
            $textFontSize = 32; //フォントサイズ
            $textMargin = 1.8 * $mmToPixel;//テキストのマージン
            $textWidth = $qr_image_size; //テキストの横幅
            $textHeight = $textFontSize + $textMargin;//テキストの高さ;
            $textX = $qrCodeX;
            $textY = $qrCodeY+$qr_image_size;
            
            $textImage = Image::canvas($textWidth,$textHeight,$bg_color);
            $textImage ->text($bg_text,$textWidth / 2,$textHeight / 2,function($font)use ($textFontSize,$qr_color){
               $font->file('/usr/share/fonts/google-noto-cjk/NotoSerifCJK-Regular.ttc'); //システムフォント
               $font->size($textFontSize);
               $font->color($qr_color);
               $font->align('center');
               $font->valign('middle');
            });       
            
            
        $image->insert($textImage,'top-left',intval($textX),intval($textY-(20 -$dpi * $scale2)));//文字画像セット
        }
        
        
        $image->insert($change_qr,'top-left',intval($qrCodeX),intval($qrCodeY));//QR画像セット
        
        return $image->encode('png');
    }
    
    
    
    
    
    
    
    
    
    
}
