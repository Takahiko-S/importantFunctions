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
		<div class="col-12">
			<h1 class="text-center text-primary">Cookie テストページ</h1>
		</div>
		<div class="col-12">
			<p class="text-center">{{$res}}</p>
		</div>
		<div class="col-12">
			<p class="text-center">初回アクセス日時 : {{ $acc_log->created_at }}</p>
			<p class="text-center">前回アクセス日時 : {{ $acc_log->updated_at }}</p>
		</div>

		<div class="col-12">
			<p class="text-center"><a href="./delete_cookie" class="btn btn-primary">クッキーを削除</a></p>
		</div>
	</div>
</div>














</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
