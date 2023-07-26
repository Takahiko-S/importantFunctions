<x-page-base>
<x-slot name="title"></x-slot>
<x-slot name="css"></x-slot>
<x-slot name="main">
<div class="container">
    <div class="row mb-5">
        <div class="col-12 mb-3 mt-3">
       		<p class="text-end">
       		<a href="./" class="btn btn-secondary">メニューに戻る</a>
       		</p>
         </div>
        <div class="col-12">
      		 <h1 class="text-center text-primary">Bootstrap Color Check</h1>
        </div>
    
    </div>
	<div class="row">
		<div class="col-12 mb-3">
			<h3 class="text-primary text-center">primaryテキスト</h3>
			<h3 class="text-secondary text-center">secondaryテキスト</h3>
			<h3 class="text-success text-center">successテキスト</h3>
			<h3 class="text-info text-center">infoテキスト</h3>
			<h3 class="text-warning text-center">warningテキスト</h3>
			<h3 class="text-danger text-center">dangerテキスト</h3>
			<h3 class="text-light text-center">lightテキスト</h3>
			<h3 class="text-dark text-center">darkテキスト</h3>
		</div>
		<div class="col-12 text-center">
			<button class="btn btn-outline-primary mb-2">primaryボタン</button>
			<button class="btn btn-outline-secondary mb-2">secondaryボタン <</button>
			<button class="btn btn-outline-success mb-2">successボタン</button>
			<button class="btn btn-outline-info mb-2">infoボタン</button>
			<button class="btn btn-outline-warning mb-2">warningボタン</button>
			<button class="btn btn-outline-danger mb-2">dangerボタン</button>
			<button class="btn btn-outline-light mb-2">lightボタン</button>
			<button class="btn btn-outline-dark mb-2">darkボタン</button>

		</div>

	</div>
</div>














</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
