@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <a href="{{Route('report.index')}}" class="mr-2 btn">←</a> Gross sales
        </div>
            <!-- Product Title -->
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="overflow-x-auto">
                    <table class="table table-striped mt-5 table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap ">Month</th>
                                <th class="whitespace-nowrap text-center">Product</th>
                                <th class="whitespace-nowrap text-center">Number of Orders</th>
                                {{-- <th class="whitespace-nowrap text-center">Net Sales</th> --}}
                                <th class="whitespace-nowrap text-center">Cost</th>
                                <th class="whitespace-nowrap text-center">Gross Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product )
                            <tr>
                                <td class="whitespace-nowrap ">{{$product->month_name}}</td>
                                <td class="whitespace-nowrap text-center">{{$product->product_name}}</td> 
                                 <td class="whitespace-nowrap text-center">{{$product->count}}</td> 
                                 {{-- <td class="whitespace-nowrap text-center">{{$product->brand->name}}</td>
                                <td class="whitespace-nowrap text-center">{{$product->order_total}}</td>
                                @if($product->order_quantity == 0)
                                    <td class="whitespace-nowrap text-center">0</td>
                                @else
                                    <td class="whitespace-nowrap text-center">{{$product->order_quantity}}</td>
                                @endif

                                @if($product->gross_sales == 0)
                                    <td class="whitespace-nowrap text-center">0</td>
                                @else
                                    <td class="whitespace-nowrap text-center">{{$product->gross_sales}}</td>
                                @endif

                                @if($product->total_sales == 0)
                                    <td class="whitespace-nowrap text-center">0</td>
                                @else
                                    <td class="whitespace-nowrap text-center">{{$product->total_sales}}</td>
                                @endif  --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
