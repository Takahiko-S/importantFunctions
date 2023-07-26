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
      		 <h1 class="text-center text-primary">背景画像作成</h1>
        </div>
         <div class="col-12 mb-3">
      		 <form method="post" action="./make_back" class="row">
      		 @csrf
              <div class="col-md-3 mb-3">
                <label for="color" class="form-label">背景色</label>
                <input type="text" class="form-control" id="color" name="color" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="dpi" class="form-label">DPI</label>
                <input type="text" class="form-control" id="dpi" name="dpi" required>
              </div>
              <div class="col-md-2 mb-3">
                <label for="width" class="form-label">横幅（mm）</label>
                <input type="text" class="form-control" id="width" name="width" required>
              </div>
               <div class="col-md-2 mb-3">
                <label for="height" class="form-label">縦幅（mm）</label>
                <input type="text" class="form-control" id="height" name="height" required>
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
