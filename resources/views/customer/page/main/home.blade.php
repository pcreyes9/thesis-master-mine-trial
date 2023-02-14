@extends('customer.layout.base')
@section('content')
@section('title', 'Home')

<!-- Begin: Header Container -->
<div class="container flex flex-col-reverse items-center gap-16 px-10 py-10 mx-20 mt-10 mb-10 box lg:flex-row ml:14">
    <!-- Content -->
    <div class="flex flex-col items-center flex-1 lg:items-start lg:pt-10">
        <h2 class="mb-6  text-center border-b-2 border-slate-400 ">
            <div class="font-medium text-5xl  ">
                Welcome to Go-Dental
            </div>
        </h2>
        <div class="mb-6 text-xl italic font-normal text-center text-bookmark-grey lg:text-left">
            All your Dental needs in One GO! Shop Now!
        </div>
    </div>
    <div class="z-10 justify-center flex-1 hidden w-full mb-5 md:flex md:mb-16 lg:mb-0">
        @if(count($banners) == 0)
            <img class=" h-5/6 sm:w-3/4" src="{{ asset('dist/images/undraw_web_shopping.svg') }}" alt="" />
        @else
            <div class="home-mode" >
                @foreach ($banners as $banner)
                    <div class="px-2 h-72">
                        <div class="object-cover h-full overflow-hidden rounded-md"  >
                            <img class="object-fill h-full w-96 " data-action="zoom" src="{{ url('storage/banner/'.$banner->featured_image) }}" alt="" />
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div >
<!-- End: Header Container -->
<!-- Begin: Main Container -->
<div class="container">
    <!-- Begin: Featured Products -->
    <div>
        <div>
            <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                Featured Products
            </p>
        </div>
        <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
            <div class="mx-6">
                <div class="featured-products">
                    @foreach ($feature as $product )
                        <div class="relative p-3 rounded-md box zoom-in ">
                            <a href="{{ Route('productshow', $product) }}">
                                <div class="h-48 2xl:h-48">
                                    @foreach ($product->images->take(1) as $model)
                                        <img alt="" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/product_photos/'.$model->images) }}">
                                    @endforeach
                                </div>
                                <div class="my-3 ">
                                    <div class="text-base font-medium truncate text-primary">{{$product->name}}</div>
                                </div>
                                <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex w-full text-xs text-slate-500">
                                        <div class="mr-auto"> Price: <span class="">₱{{$product->sprice }}</span> </div>
                                        <div class="text-xs">{{$product->brand->name }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End: Featured Products -->

    <!-- Begin: Shop by Categories -->
    <div>
        <div>
            <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                Shop by Categories
            </p>
        </div>
        <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
            <div class="mx-6">
                <div class="categories">
                    @foreach ($categories as $category )
                        <div class="relative p-3 rounded-md box zoom-in p-5">
                            <a href="{{ Route('product',['filterbycategory' => $category]) }}">
                                <div class="h-48 2xl:h-48">

                                    @if(!empty($category->photo))
                                        <img alt="Missing Category Image" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/category/'.$category->photo) }}">
                                    @else
                                        <img alt="Missing Category Image" class="object-scale-down w-full h-48 rounded-md" src="{{asset('dist/images/undraw_pic.svg')}}">
                                    @endif
                                </div>
                                <div class="block mt-3 font-medium text-center truncate">{{$category->name }} </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End: Shop by Categories -->
    <!-- Begin: Brands Go Dental Offers-->
    <div>
        <div>
            <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                Brands Go Dental Offers
            </p>
        </div>
        <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
            <div class="mx-6">
                <div class="brands">
                    @foreach ($brands as $brand )
                        <div class="relative p-3 rounded-md box zoom-in p-5">
                            <a href="{{ Route('product',['filterbybrand' => $brand]) }}">
                                <div class="h-48 2xl:h-48">
                                    @if(!empty($category->photo))
                                        <img alt="Missing Category Image" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/brand/'.$brand->photo) }}">
                                    @else
                                        <img alt="Missing Category Image" class="object-scale-down w-full h-48 rounded-md" src="{{asset('dist/images/undraw_pic.svg')}}">
                                    @endif
                                </div>
                                <div class="block mt-3 font-medium text-center truncate">{{$brand->name }} </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End: Brands Go Dental Offers-->
    <!-- Begin: Top Selling Products -->
    <div>
        <div>
            <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                Top Selling Products
            </p>
        </div>
        <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
            <div class="mx-6">
                <div class="top-selling-products">
                    @foreach ($topselling as $product )
                        <div class="relative p-3 rounded-md box zoom-in ">
                            <a href="{{ Route('productshow', $product) }}">
                                <div class="h-48 2xl:h-48">
                                    @foreach ($product->images->take(1) as $model)
                                        <img alt="" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/product_photos/'.$model->images) }}">
                                    @endforeach
                                </div>
                                <div class="my-3 ">
                                    <div class="text-base font-medium truncate text-primary">{{$product->name}}</div>
                                </div>
                                <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                    <div class="flex w-full text-xs text-slate-500">
                                        <div class="mr-auto"> Price: <span class="">₱{{$product->sprice }}</span> </div>
                                        {{-- <div class="text-xs">{{$product->brand->name }}</div> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End: Top Selling Products -->
    @if(Auth::guard('customer')->check())
        <div>
            <div>
                <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                    Recently Bought Products
                </p>
            </div>
            <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
                <div class="mx-6">
                    <div class="top-selling-products">
                        @foreach ($recent as $product )
                            <div class="relative p-3 rounded-md box zoom-in ">
                                <a href="{{ Route('productshow', $product) }}">
                                    <div class="h-48 2xl:h-48">
                                        @foreach ($product->images->take(1) as $model)
                                            <img alt="" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/product_photos/'.$model->images) }}">
                                        @endforeach
                                    </div>
                                    <div class="my-3 ">
                                        <div class="text-base font-medium truncate text-primary">{{$product->name}}</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="mr-auto"> Price: <span class="">₱{{$product->sprice }}</span> </div>
                                            <div class="text-xs">{{$product->brand->name }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                    Recommended Products
                </p>
            </div>
            <div class="my-5 box pt-5 pb-5 pl-2 pr-2">
                <div class="mx-6">
                    <div class="top-selling-products">
                        @foreach ($recom as $recoms)
                            @foreach ($products as $product)
                                @if($recoms->category_id != $product->category_id)
                                @else
                                    <div class="relative p-3 rounded-md box zoom-in ">
                                        <a href="{{ Route('productshow', $product) }}">
                                            <div class="h-48 2xl:h-48">
                                                @foreach ($product->images->take(1) as $model)
                                                    <img alt="" class="object-scale-down w-full h-48 rounded-md" src="{{ url('storage/product_photos/'.$model->images) }}">
                                                @endforeach
                                            </div>
                                            <div class="my-3 ">
                                                <div class="text-base font-medium truncate text-primary">{{$product->name}}</div>
                                            </div>
                                            <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                                <div class="flex w-full text-xs text-slate-500">
                                                    <div class="mr-auto"> Price: <span class="">₱{{$product->sprice }}</span> </div>
                                                    <div class="text-xs">{{$product->brand->name }}</div>
                                                </div>
                                                <div class="text-xs">{{$product->category_id }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<!-- End: Main Container -->
@endsection
