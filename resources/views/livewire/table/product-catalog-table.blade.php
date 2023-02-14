<div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Product Filter -->
        <div class="col-span-12 lg:col-span-3 2xl:col-span-2 flex lg:block flex-col-reverse">
            <div class="sticky top-10 right-10 box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Product Filters</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <input type="search" wire:model.lazy="search" class="form-control" name="Search" placeholder="Search Product">
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base p-2">Filter By Category:</div>
                    <div>
                        <select wire:model="filterbycategory" class="form-select w-full" name="category">
                            <option value="">No Filter</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base p-2">Filter By Brand:</div>
                    <div>
                        <select wire:model="filterbybrand" class="form-select w-full" name="category">
                            <option value="">No Filter</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Product Filter sticky top-0 right-10 w-full flex justify-end -->
        <div class="col-span-12 lg:col-span-9 2xl:col-span-10">
            <!-- BEGIN: Product List -->
            <div class="intro-y lg:mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        List of Products
                    </h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-4 sm:gap-2  intro-y max-width place-items-center">
                        <!-- BEGIN: Product Layout -->
                        @forelse ($products as $product)
                            <div class="box col-span-12 max-w-xs  md:col-span-4 lg:col-span-4 xl:col-span-3 2xl:col-span-2 w-full">
                                <div class="text-slate-500 p-1 flex justify-end">{{ $product->category->name }}</div>
                                <a href="{{ Route('productshow', $product) }}">
                                <div class="flex items-center  border-b border-slate-200/60 dark:border-darkmode-400"></div>
                                    <div class="p-5">
                                        <div class="h-48 2xl:h-48">
                                            @if(count($product->images) == 0)
                                                <img alt="Missing Image"  class="object-fill    h-48 rounded-md w-96" src="{{ asset('dist/images/logo.png') }}">
                                            @else
                                                @foreach ($product->images->take(1)  as $model)
                                                    <img alt="Missing Image"  class="object-fill    h-48 rounded-md w-96" src="{{ url('storage/product_photos/'.$model->images) }}">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Product Details Container -->
                                    <div class="ml-3">
                                        <div class="font-medium truncate ">{{ $product->name }}</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="mr-auto"> Price: <span class="">₱{{ number_format($product->sprice,2) }}</span> </div>
                                            <div class="text-xs">{{$product->brand->name }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-12">
                                <h2 class="intro-y text-lg font-medium mt-10">
                                    <div class="flex justify-center flex-col">
                                        <img alt="Missing Image" class="object-fill rounded-md h-48 " src="{{ asset('dist/images/NoResultFound.svg') }}">
                                        <div class="flex justify-center">No Product Found <strong class="ml-1"> {{ $search }}</strong>  </div>
                                    </div>
                                </h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        window.onscroll = function (ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        }
    </script>
</div>
