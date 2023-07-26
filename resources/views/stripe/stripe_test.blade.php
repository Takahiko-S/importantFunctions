<x-app-layout>
<x-slot name="title"></x-slot>
<x-slot name="css">
<style type="text/css">
#card-element{
    border-radius:5px;
    padding:12px;
    border:1px solid #ccc;
    height:44px;
    background:white;
    width:100%;
}
</style>

</x-slot>
<x-slot name="main">
<div class="container">
    <div class="row">
        <div class="col-12 mb-3 mt-3">
       		<p class="text-end">
       		<a href="./" class="btn btn-secondary">メニューに戻る</a>
       		</p>
         </div>
        <div class="col-12 mb-4">
      		 <h1 class="text-center text-primary">Stripe決済テスト</h1>
        </div>
        <div class="col-12">
        <h3 class="text-center">支払い金額 : {{number_format($price)}}円</h3>
        </div>
    
    </div>
    <form id = "payment_form" method = "post" action = "./stripe_pay">
    @csrf
    <input type="hidden" name="price" value="{{$price}}">
	<div class="row">
		<div class="col-6 mx-auto">
			<div id="card-area">
				<div class="mt-3 mb-3 px-2">
					<h4>お支払いカード情報</h4>
					<label for="card_holder_name" class="form-label">カード名義人</label>
					 <input type="text" class="form-control " id="card_holder_name"
						name="card_holder_name" placeholder="カード名義人" required>
				</div>
				<div class="mb-4 px-2">
					<label for="card-element" class="form-label">カード情報</label>
					<div id="card-element"></div>
					<p>※セキュリティコードは裏面にある番号の３桁または４桁の数字</p>
				</div>
				<div class="mb-4">
					<p class="text-center">
						<a href="" class="btn btn-secondary">中止</a>
						<button id="card-button" class="btn btn-primary">決済する</button>
					</p>
				</div>
				<div id="message" class="text-center text-warning"></div>
			</div>
		</div>
	</div>
    </form>
</div>














</x-slot>

<x-slot name="script">
	<script src="https://js.stripe.com/v3"></script>
	
	<script>
//jsに支払い金額設定
var price = <?php print $price;?>

//stripe設定
const stripe = Stripe("{{env('STRIPE_KEY')}}");
const elements = stripe.elements();
const cardElement = elements.create('card');



cardElement.mount('#card-element');
const cardHolderName = document.getElementById('card_holder_name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;


cardButton.addEventListener('click',async(e) => {
	e.preventDefault();
	const{ paymentMethod,error } = await stripe.createPaymentMethod(
				'card',cardElement,{
					billing_details: { name: cardHolderName.value }
					}
			);
		if($('#card_holder_name').val() == ""){
$('#message').html("カード名義人が未入力です");
return;
		}else{
			$('#message').html("");
		}
	if(error){
		$('#message').html(error.message);
	}else{
		$('#message').html("");
		stripePaymentIdHandler(paymentMethod.id);
	}	
});
function stripePaymentIdHandler(paymentMethodId){
const form =  document.getElementById('payment_form');

const hiddenInput = document.createElement('input');
hiddenInput.setAttribute('type','hidden');
hiddenInput.setAttribute('name','paymentMethodId');
hiddenInput.setAttribute('value',paymentMethodId);
form.appendChild(hiddenInput);

form.submit();


}






	</script>
</x-slot>













</x-app-layout>
