<div>
    {{$page}} - {{$perPage}}
    @foreach($products as $product)
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-4">
            <div class="md:flex">
                <div class="md:flex-shrink-0">
                    <img class="h-48 w-full object-cover md:w-48" src="//via.placeholder.com/150/0000FF/808080/?text={{$product->name}}">
                </div>
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{$product->name}} - {{$product->id}}</div>
                    <p class="mt-2 text-gray-500">{{$product->description}}</p>
                </div>
            </div>
        </div>
    @endforeach

    @if($products->hasMorePages())
        @livewire('load-more-products', ['page' => $page, 'perPage' => $perPage, 'key' => 'products-page-' . $page])
    @endif
</div>