<x-app-layout> <x-slot name="title"></x-slot> <x-slot name="css"></x-slot>

<x-slot name="header">
<h2
	class="font-semibold text-xl text-red-500 dark:text-gray-200 leading-tight">
	{{ __('Dashboard') }}</h2>
</x-slot> <x-slot name="main">
<div class="py-12 ">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div
			class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900 dark:text-gray-100">

				<div class="row">
					<div class="col-md-4 mb-3 d-grid">
						<a href="./stripe_test" class="btn btn-outline-info">Stripe都度決済</a>
					</div>
					<div class="col-md-4 mb-3 d-grid">
						<a href="./stripe_sub" class="btn btn-outline-info">Stripeサブスク決済</a>
					</div>
					<div class="col-md-4 mb-3 d-grid">
						<a href="./stripe_cancel" class="btn btn-outline-info">Stripeサブスク解除</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="py-12 ">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div
			class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900 dark:text-gray-100">

				<div class="d-grid sm:grid-cols-4 sm:w-full mt-4">
					<div class="w-full px-2">
						<button id="new_bt"
							class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center w-full">
							新規登録</button>
					</div>

					<div class="w-full px-2">
						<button id="red_bt"
							class="inline-block bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded text-center w-full">
							新規登録</button>
					</div>

					<div class="w-full px-2">
						<button id="red_bt"
							class="inline-block text-red-500 border-red-500 hover:bg-red-500 hover:text-white py-2 px-4 rounded text-center w-full outline-none">
							新規登録</button>
					</div>



				</div>
			</div>
		</div>
	</div>
</div>
</x-slot> <x-slot name="script"> <script>

</script> </x-slot> </x-app-layout>
