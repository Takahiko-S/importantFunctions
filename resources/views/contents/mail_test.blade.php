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
      		 <h1 class="text-center text-primary">メール送信テスト</h1>
        </div>
    
        <div class="col-6 mx-auto">
      		 <form method ="post" action="./mail_send" enctype="multipart/form-data">
      		 @csrf
              <div class="mb-3">
                <label for="send_mail_address" class="form-label">送り先メールアドレス</label>
                <input type="email" class="form-control" id="send_mail_address" name="send_mail_address" required>
              </div>
              <div class="mb-3">
                <label for="send_mail_subject" class="form-label">メールタイトル</label>
                <input type="text" class="form-control" id="send_mail_subject" name="send_mail_subject" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="message">メール本分</label>
				<textarea id="message" name="message" rows="5" class="form-control" required></textarea>
              </div>
                <div class="mb-3">
                <label for="add_file" class="form-label">添付ファイル</label>
                <input type="file" class="form-control" id="add_file" name="add_file">
              </div>
              <button type="submit" class="btn btn-primary">送信</button>
            </form>
        </div>
    
    </div>
</div>














</x-slot>

<x-slot name="script"></x-slot>













</x-page-base>
