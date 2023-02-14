@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            Report
        </div>
            <!-- Product Title -->
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="overflow-x-auto">
                        <table class="table table-striped mt-5 table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="whitespace-nowrap ">Name</th>
                                    <th class="whitespace-nowrap text-center">Category</th>
                                    <th class="whitespace-nowrap text-center">Last Viewed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">
                                        <a href ="{{Route('SalesCustomer')}}">Sales by Customer</a>
                                        
                                    </td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">
                                        <a href ="{{Route('SalesProd')}}">Sales by Product</a>
                                    </td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">
                                        <a href ="{{Route('TotalSales')}}">Total Sales</a>
                                    </td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">
                                        <a href ="{{Route('GrossSales')}}">Gross Sales</a>
                                    </td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">
                                        <a href ="{{Route('GrossProfit')}}">Gross Profit</a>
                                    </td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                {{-- <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by billing location</td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by channel</td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by discount</td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr> --}}
                                
                                {{-- <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Sales over time</td>
                                    <td class="whitespace-nowrap text-center">Sales</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Profit by product</td>
                                    <td class="whitespace-nowrap text-center">Profit Margin</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Profit by product variant SKU</td>
                                    <td class="whitespace-nowrap text-center">Profit Margin</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Cost of goods sold</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Discounts</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                
                                
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Net sales</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Payments by type</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Payments</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Returns</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                <tr>
                                    <td class="whitespace-nowrap cursor-pointer hover:underline">Summary</td>
                                    <td class="whitespace-nowrap text-center">Finances</td>
                                    <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                                </tr>
                                 --}}
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
