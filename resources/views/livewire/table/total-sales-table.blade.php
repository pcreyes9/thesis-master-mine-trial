<div class="intro-y box p-5">
    <input class="form-control">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
           <a href="{{Route('report.index')}}" class="mr-2 btn">←</a> Monthly Sales
        </div>
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="xl:flex sm:mr-auto mt-5" >
                <div class="sm:flex items-center sm:mr-4"> 
                    <label for="date" class="flex-none xl:w-auto xl:flex-initial mr-2">Date from</label>
                    <div class="col-sm-3">
                        <input class="form-control input-sm w-32 " wire:model="from" id="from" name ="from"  type="date" />
                    </div>
                    <label for="date" class="flex-none xl:w-auto xl:flex-initial mr-2 ml-3">Date to</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control input-sm w-32 " id="to" name ="to" wire:model="to"/>
                    </div>
                </div>
                <div class="sm:flex items-center sm:mr-4">
                    <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                    <select wire:model="sorting"  class="form-select w-32 mt-2 sm:mt-0 sm:w-auto">
                        <option value="month_name">Month</option>
                        <option value="total" >Total Sales</option>
                        <option value="profit" >Gross Profit</option>
                        <option value="count">Total Orders</option>
                    </select>
                </div>
            </div>
            @can('product_export')
                <div class="flex mt-5 sm:mt-0">
                    <div class="dropdown w-1/2 sm:w-auto">
                        <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa-regular fa-newspaper w-4 h-4 mr-2"></i> Export <i class="fa-solid fa-chevron-down w-4 h-4 ml-auto sm:ml-2"></i> </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="{{Route('exportproductexcel')}}" class="dropdown-item"> <i class="fa-solid fa-file-excel mr-1"></i> Export Excel </a>
                                </li>
                                <li>
                                    <a  href="{{Route('exportproductcsv')}}" class="dropdown-item"> <i class="fa-solid fa-file-csv mr-1"></i>  Export CSV </a>
                                </li>
                                <li>
                                    <a href="{{Route('exportproductpdf')}}" class="dropdown-item">  <i class="fa-solid fa-file-pdf mr-1"></i> Export PDF </a>
                                </li>
                                <li>
                                    <a  href="{{Route('exportproducthtml')}}" class="dropdown-item"> <i class="fa-brands fa-html5 mr-1"></i> Export HTML </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
        <!-- Product Title -->
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="overflow-x-auto">
                <table class="table table-striped mt-5 table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th class="whitespace-nowrap ">Month</th>
                            <th class="whitespace-nowrap text-center">Total Orders</th>
                            <th class="whitespace-nowrap text-center">Gross Profit</th>
                            <th class="whitespace-nowrap text-center">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                        <tr>
                            <td class="whitespace-nowrap ">{{$product->month_name}}</td>
                            <td class="whitespace-nowrap text-center">{{$product->count}}</td> 
                            <td class="whitespace-nowrap text-center">{{$product->profit}}</td> 
                            <td class="whitespace-nowrap text-center">{{$product->total}}</td> 
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
