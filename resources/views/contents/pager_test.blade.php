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
      		 <h1 class="text-center text-primary">ページャーテスト</h1>
        </div>
        
        <div class="col-12">
        <p class="p-3">{{$datas->links('vendor.pagination.bootstrap-5')}}</p>
        <table class="table table-striped">
        <thead>
        
        <tr>
        <th>ID</th>
        <th>TEXT</th>
        <th>Updated_at</th>
        <th>Created_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
        <tr>
        <td>{{$data->id}}</td>
        <td>{{$data->text}}</td>
        <td>{{$data->updated_at}}</td>
        <td>{{$data->created_at}}</td>
        </tr>
        @endforeach
        </tbody>
        
        </table>
        <p class="p-3">{{$datas->links('vendor.pagination.tailwind')}}</p>
        </div>
    
    </div>
</div>














</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
