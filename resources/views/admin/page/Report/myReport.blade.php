@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

<div class="intro-y box p-5">
    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
        Report
    </div>

    <div class="container">
        <div class=" my-5 ">
            {{-- <p class=" border-b-2 border-slate-300 text-bookmark-grey text-2xl italic text-center font-normal lg:text-left mb-3">
                Shop by Categories
            </p> --}}
            <div class="intro-y grid grid-cols-12 gap-5 ">
                <div class="intro-y col-span-12 ">
                    <div class="grid grid-cols-12 gap-5 mt-1 pt-1 place-content-center ">
                        <a href="{{Route('SalesProd')}}"  class="intro-y block col-span-10 max-w-xs md:col-span-4 lg:col-span-4 xl:col-span-3 2xl:col-span-2">
                            <div class="bg-slate-100 rounded-md p-3 relative zoom-in">
                                <div class="flex-none relative block ">
                                    {{-- <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="dist/images/logo.png">
                                    </div> --}}
                                    <div class=" my-3 px-2">
                                        <div class="font-medium truncate text-primary text-base">Sales By Product</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="text-xs">Sales</div>
                                        </div>
                                        <div class="flex w-full text-xs text-slate-500 mt-1">
                                            <div class="text-xs">Last Viewed: Nov. 22, 2023</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="block font-medium text-center truncate mt-3">Sales by Product </div> --}}
                            </div>
                        </a>

                        <a href="{{Route('SalesCustomer')}}"  class="intro-y block col-span-10 max-w-xs md:col-span-1 lg:col-span-4 xl:col-span-3 2xl:col-span-2">
                            <div class="box rounded-md p-3 relative zoom-in">
                                <div class="flex-none relative block ">
                                    {{-- <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="dist/images/logo.png">
                                    </div> --}}
                                    <div class=" my-3 px-2">
                                        <div class="font-medium truncate text-primary text-base">Sales by Customer</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-sm text-slate-500">
                                            <div class="text-xs">Sales</div>
                                        </div>
                                        <div class="flex w-full text-sm text-slate-500 mt-1">
                                            <div class="text-xs">Last Viewed: Nov. 22, 2023</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="{{Route('TotalSales')}}"  class="intro-y block col-span-10 max-w-xs md:col-span-1 lg:col-span-4 xl:col-span-3 2xl:col-span-2">
                            <div class="bg-slate-100 rounded-md p-3 relative zoom-in">
                                <div class="flex-none relative block ">
                                    {{-- <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img alt="Midone - HTML Admin Template" class="rounded-md" src="dist/images/logo.png">
                                    </div> --}}
                                    <div class=" my-3 px-2">
                                        <div class="font-medium truncate text-primary text-base">Sales by Month</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-sm text-slate-500">
                                            <div class="text-xs">Sales</div>
                                        </div>
                                        <div class="flex w-full text-sm text-slate-500 mt-1">
                                            <div class="text-xs">Last Viewed: Nov. 22, 2023</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        {{-- <a href="{{Route('GrossSales')}}"  class="intro-y block col-span-10 max-w-xs md:col-span-4 lg:col-span-4 xl:col-span-3 2xl:col-span-2">
                            <div class="bg-slate-100 rounded-md p-3 relative zoom-in">
                                <div class="flex-none relative block ">
                                    
                                    <div class=" my-3 px-2">
                                        <div class="font-medium truncate text-primary text-base">Gross Sales by Product</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="text-xs">Sales</div>
                                        </div>
                                        <div class="flex w-full text-xs text-slate-500 mt-1">
                                            <div class="text-xs">Last Viewed: Nov. 22, 2023</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{Route('GrossProfit')}}"  class="intro-y block col-span-10 max-w-xs md:col-span-4 lg:col-span-4 xl:col-span-3 2xl:col-span-2">
                            <div class="boxrounded-md p-3 relative zoom-in">
                                <div class="flex-none relative block ">
                                    <div class=" my-3 px-2">
                                        <div class="font-medium truncate text-primary text-base">Gross Profit by Products</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="text-xs">Sales</div>
                                        </div>
                                        <div class="flex w-full text-xs text-slate-500 mt-1">
                                            <div class="text-xs">Last Viewed: Nov. 22, 2023</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection