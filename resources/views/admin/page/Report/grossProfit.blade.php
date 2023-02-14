@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <a href="{{Route('report.index')}}" class="mr-2 btn">←</a> Gross Profit
        </div>
            <!-- Product Title -->
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="overflow-x-auto">
                    <table class="table table-striped mt-5 table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap ">Date</th>
                                <th class="whitespace-nowrap text-center">Product</th>
                                <th class="whitespace-nowrap text-center">Number of Orders</th>
                                {{-- <th class="whitespace-nowrap text-center">Net Sales</th> --}}
                                <th class="whitespace-nowrap text-center">Cost</th>
                                <th class="whitespace-nowrap text-center">Gross Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
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
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by customer name</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by discount</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Sales by product</td>
                                <td class="whitespace-nowrap text-center">Sales</td>
                                <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                            </tr>
                            <tr>
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
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Gross profit</td>
                                <td class="whitespace-nowrap text-center">Finances</td>
                                <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Gross sales</td>
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
                            <tr>
                                <td class="whitespace-nowrap cursor-pointer hover:underline">Total sales</td>
                                <td class="whitespace-nowrap text-center">Finances</td>
                                <td class="whitespace-nowrap text-center">Nov 28, 2022</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
