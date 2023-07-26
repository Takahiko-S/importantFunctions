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
      		 <h1 class="text-center text-primary">画像変換（白→透明）</h1>
        </div>
         <div class="col-12 mb-3">
      		 <form method="post" action="./white_to" class="row" enctype="multipart/form-data">
      		 @csrf
              <div class="col-12 mb-3">
                <label for="width" class="form-label">変換元ファイル</label>
                <input type="file" accept = "image/*" class="form-control" id="file" name="file" required>
              </div>
             
              <div class="col-md-2 mb-3 pt-3 d-grid">
             		<button type="submit" class="btn btn-primary mt-3" name="send">変換</button>
              </div>
            </form>
        </div>
    
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto bg-primary">
        @if($image != "")
       	 <img src="{{$image}}" class="border">
        @endif
        </div>
    </div>
</div>

<!--DPIは画像密度  -->












</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
