@extends('customer.layout.base')
@section('title')
    {{ $product->name }}
@endsection

@section('content')
<div class="items-center justify-center flex">
    <div style="width: 60rem">
        <!-- Begin Header of Product -->
        <div class="intro-y box px-5 pt-5 mt-7">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 sm:whitespace-normal font-medium text-xl">{{$product->name}}</div>
                        <div class="text-slate-500">{{ $product->category->name }}</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Product Details</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"> Sold:  100</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">Ratings: 5/5</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">Stocks: {{ $product->stock }} </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">Views: 1,000</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-0 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                    @livewire('form.add-to-cart',['product' => $product])
                </div>
            </div>
        </div>
        <div class="tab-content mt-5">
            <div>
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Product Details -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Product Details
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <h3 class="font-medium text-base">Brand Name:</h3>
                                    <div class="text-slate-500 text-base mt-0.5">{{ $product->brand->name }}</div>
                                </div>
                            </div>
                            <br>
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <h3 class="font-medium text-base">Category Name:</h3>
                                    <div class="text-slate-500 text-base mt-0.5">{{ $product->category->name }}</div>
                                </div>
                            </div>
                            <br>
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <h3 class="font-medium text-base">Stocks:</h3>
                                    <div class="text-slate-500 text-base mt-0.5">{{ $product->stock }} pcs</div>
                                </div>
                            </div>
                            <div class="flex items-center mt-5">
                                <div class="ml-4">
                                    <h3 class="font-medium text-base">Weight:</h3>
                                    <div class="text-slate-500 text-base mt-0.5">{{ $product->weight }} grams</div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END: Product Details -->
                    <!-- BEGIN: Product Image -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Product Image
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-center">
                                @if(count($product->images) == 0)
                                    <!-- Begin: Product Image if there is no image -->
                                    <div>
                                        <img alt="Missing Image" class="object-fill h-full w-full" src="{{ asset('dist/images/logo.png') }}">
                                    </div>
                                    <!-- END: Product Image if there is no image -->
                                @elseif(count($product->images) == 1)
                                    <!-- Begin: Product Image if there is one image -->
                                    @foreach ($product->images as $model)
                                        <div>
                                            <img alt="Missing Image" data-action="zoom" class="object-fill h-full w-full " src="{{ url('storage/product_photos/'.$model->images) }}">
                                        </div>
                                    @endforeach
                                    <!-- END: Product Image if there is one image -->
                                @else
                                    <!-- Begin: Product Image Slider -->
                                    <div class="mx-6 pb-8 mt-5 "  >
                                        <div class="fade-mode" style="height: 100%;">
                                            @foreach ($product->images as $model)
                                            <div class="h-64 px-2">
                                                <div class="object-fill h-full w-full" style="height: 100%;">
                                                    <img alt="" src="{{ url('storage/product_photos/'.$model->images) }}" data-action="zoom" style="height: 100%;" class=""/>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- END: Begin Product Image Slider -->
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- END: Product Image -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Begin Product Description -->
<div class="items-center justify-center flex">
    <div class="intro-y box px-1 pt-1 mt-7 " style="width: 60rem">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Product Description
            </h2>
        </div>
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <div class="text-slate-500 text-base	 mt-0.5">{!! $product->description !!}</div>
        </div>
    </div>
</div>
<!-- END Product Description -->


<!-- Begin Product Rating -->
<div class="items-center justify-center flex">
    <div style="width: 60rem">
        <div class="intro-y box px-1 mt-7 pb-3">
            <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Product Ratings
                </h2>
            </div>
            <div class="flex flex-col lg:flex-row ">
                <div class="mt-5 ">
                    <div class="flex items-center px-5">
                        <h1 class=" text-5xl font-medium">4.55</h1>
                        <h1 class=" text-3xl font-medium">/5</span>
                    </div>
                    <div class="flex items-center px-5">
                        <div class="star">
                            <div class="star-bg">
                                @for($i=1; $i<6; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center px-5 py-2">
                        <div class="text-slate-500 text-base">350 Ratings</div>
                    </div>
                </div>

                <div class="mt-5 ml-5 md:ml-10" >
                    <div class="star">
                        <div class="star-bg">
                            <div class="mt-1">
                                @for($i=1; $i<6; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                                <div class="progress h-3 mt-3 md:hidden w-1/2">
                                    <div class="progress-bar w-5/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100</div>
                                </div>
                            </div>
                            <div class="mt-1">
                                @for($i=1; $i<5; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                                <div class="progress h-3 mt-3 md:hidden w-1/2">
                                    <div class="progress-bar w-4/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">80</div>
                                </div>
                            </div>
                            <div class="mt-1">
                                @for($i=1; $i<4; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                                <div class="progress h-3 mt-3 md:hidden w-1/2">
                                    <div class="progress-bar w-3/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">70</div>
                                </div>
                            </div>
                            <div class="mt-1">
                                @for($i=1; $i<3; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                                <div class="progress h-3 mt-3 md:hidden w-1/2">
                                    <div class="progress-bar w-2/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">60</div>
                                </div>
                            </div>
                            <div class="mt-1">
                                @for($i=1; $i<2; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                                <div class="progress h-3 mt-3 md:hidden w-1/2">
                                    <div class="progress-bar w-1/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">50</div>
                                </div>
                            </div>
                            <div class="mt-1">
                                @for($i=1; $i<1; $i++)
                                    <i class="fa fa-star"> </i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 mx-3 md:flex flex-1 hidden">
                    <div class="progress h-3 mt-2  w-1/2">
                        <div class="progress-bar w-5/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100</div>
                        <div class="progress h-3 mt-3">
                            <div class="progress-bar w-4/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">90</div>
                        </div>
                        <div class="progress h-3 mt-3 ">
                            <div class="progress-bar w-3/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">70</div>
                        </div>
                        <div class="progress h-3 mt-3 ">
                            <div class="progress-bar w-2/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">60</div>
                        </div>
                        <div class="progress h-3 mt-3 ">
                            <div class="progress-bar w-1/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">30</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Product Rating -->

<!-- Begin Product Review -->
<div class="items-center justify-center flex">
    <div class="intro-y box px-1 pt-1 mt-7 " style="width: 60rem">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Product Reviews
            </h2>
        </div>
        @for($i=1; $i<3; $i++)
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400">
                <div class="mt-5 ">
                    <div class="flex items-center px-5">
                            <div class="star">
                                <div class="star-bg">
                                    @for($x=1; $x<6; $x++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    <div class="flex justify-start gap-2">
                        <div class="pl-5 pt-3 w-12 h-12 image-fit">
                            <img class="rounded-full" src="{{ asset('dist/images/undraw_pic.svg') }}" alt=""  >
                        </div>
                        <div>
                            <div class="flex pt-3 items-center px-5">
                                <div class="text-base">Paul Reyes <span class="  text-primary  text-xs rounded-md">Verified Purchase</span></div>
                            </div>
                            <div class="flex items-center px-5">
                                <div class="text-slate-500 text-base">10/22/25</div>
                            </div>
                        </div>
                    </div>


                    <div class="flex items-center px-5 py-4">
                        <div class="text-black text-base">I love it I always forget to drive water but this a great help tormenting me to drink water hahaha I can't leave with this jug so happy with the sticker thank you so much</div>
                    </div>
                </div>
            </div>
        @endfor

    </div>
</div>
<!-- END Product Review -->

@endsection
@push('scripts')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var inputBox = document.getElementById("quantity");
    var invalidChars = [
        "e",
    ];

    inputBox.addEventListener("keydown", function(e) {
        if (invalidChars.includes(e.key)) {
        e.preventDefault();
        }
    });

    window.addEventListener('swal:modal',event =>{
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.type
        })
    });
</script>
@endpush

