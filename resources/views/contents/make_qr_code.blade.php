<x-page-base>
<x-slot name="title"></x-slot>
<x-slot name="css"></x-slot>
<x-slot name="main">
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mt-3">
       		<p class="text-end">
       		<a href="./" class="btn btn-secondary">メニューに戻る</a>
       		</p>
         </div>
        <div class="col-12 mb-3">
      		 <h1 class="text-center text-primary">QRコード作成</h1>
        </div>
         <div class="col-12 mb-3">
      		 <form method="post" action="./make_qr" class="row">
      		 @csrf
              <div class="col-md-2 mb-3">
                <label for="width" class="form-label">サイズ（mm）</label>
                <input type="text" class="form-control" id="width" name="width" required>
              </div>
                 <div class="col-md-2 mb-3">
                <label for="dpi" class="form-label">DPI</label>
                <input type="text" class="form-control" id="dpi" name="dpi" required>
              </div>
              <div class="col-12 mb-3">
              <label for="qr_text" class="form-label">QRテキスト 1817文字以内</label>
                	<textarea class="form-control" row="3" id= "qr_text"name="qr_text"></textarea>
              </div>
              <div class="col-md-2 mb-3 pt-3 d-grid">
             		<button type="submit" class="btn btn-primary mt-3" name="send">作成</button>
              </div>
            </form>
        </div>
    
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
        @if($image != "")
       	 <img src="{{$image}}" class="">
        @endif
        </div>
    </div>
</div>

<!--DPIは画像密度  -->












</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
