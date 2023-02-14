<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
            <a href="{{Route('report.index')}}" class="mr-2 btn">←</a> Sales by customer name
            <div class="sm:ml-auto mt-3 sm:mt-0 dropdown w-1/2 sm:w-auto pl-5 ">
                <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa-regular fa-newspaper w-4 h-4 mr-2"></i> Export <i class="fa-solid fa-chevron-down w-4 h-4 ml-auto sm:ml-2"></i> </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{Route('exportSalesCustomerEXCEL')}}" class="dropdown-item"> <i class="fa-solid fa-file-excel mr-1"></i> Export Excel </a>
                        </li>
                        <li>
                            <a  href="{{Route('exportSalesCustomerCSV')}}" class="dropdown-item"> <i class="fa-solid fa-file-csv mr-1"></i>  Export CSV </a>
                        </li>
                        <li>
                            <a href="{{Route('exportSalesCustomerPDF')}}" class="dropdown-item">  <i class="fa-solid fa-file-pdf mr-1"></i> Export PDF </a>
                        </li>
                        <li>
                            <a  href="{{Route('exportSalesCustomerHTML')}}" class="dropdown-item"> <i class="fa-brands fa-html5 mr-1"></i> Export HTML </a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
            <!-- Product Title -->
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="overflow-x-auto">
                    <table class="table table-striped mt-5 table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap ">Customer Name</th>
                                <th class="whitespace-nowrap text-center">Customer Email</th>
                                <th class="whitespace-nowrap text-center">Total Orders</th>
                                <th class="whitespace-nowrap text-center">Total Ordered Products</th>
                                <th class="whitespace-nowrap text-center">Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer )
                                <tr>
                                    @if($customer->order_quantity != 0) 
                                        <td class="whitespace-nowrap ">{{$customer->name}}</td>
                                        <td class="whitespace-nowrap text-center">{{$customer->email}}</td>
                                        <td class="whitespace-nowrap text-center">{{$customer->order_total}}</td>
                                        <td class="whitespace-nowrap text-center">{{$customer->order_quantity}}</td>
                                        <td class="whitespace-nowrap text-center">{{$customer->total_sales}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
