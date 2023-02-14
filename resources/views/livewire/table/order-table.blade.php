<div>
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                    <select  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="nameaz" >Default Sorting</option>
                        <option value="nameza">Sort by newness</option>
                        <option value="createdold">Sort by price: low to high</option>
                        <option value="creatednew">Sort by price: high to low</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                    <input  type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
            </div>
            <!-- Begin: Export Orders -->
            <div class="flex mt-5 sm:mt-0">
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown">
                         <i class="fa-regular fa-newspaper w-4 h-4 mr-2"></i> Export <i class="fa-solid fa-chevron-down w-4 h-4 ml-auto sm:ml-2"></i>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{Route('exportbrandexcel')}}" class="dropdown-item"> <i class="fa-solid fa-file-excel mr-1"></i> Export to Excel  </a>
                            </li>
                            <li>
                                <a href="{{Route('exportbrandcsv')}}" class="dropdown-item"> <i class="fa-solid fa-file-csv mr-1"></i> Export to CSV </a>
                            </li>
                            <li>
                                <a href="{{Route('exportbrandpdf')}}" class="dropdown-item"> <i class="fa-solid fa-file-pdf mr-1"></i>Export to PDF </a>
                            </li>
                            <li>
                                <a href="{{Route('exportbrandhtml')}}" class="dropdown-item"> <i class="fa-brands fa-html5 mr-1"></i> Export to HTML </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End: Export Orders -->
        </div>
        <!-- Begin: Orders Table -->
        <div class="overflow-x-auto scrollbar-hidden">
           <div class="overflow-x-auto">
               <table class="table mt-5" >
                   <thead class="table-dark">
                       <tr>
                           <th class="whitespace-nowrap">Products</th>
                           <th class="whitespace-nowrap text-center">Order Total</th>
                           <th class="whitespace-nowrap text-center">Status</th>
                           <th class="whitespace-nowrap text-center">Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                    @forelse ($Orders as $order)
                        <tr >
                             <td colspan="3" class="whitespace-nowrap bg-gray-200"><a href="{{ Route('customer.show',$order->customers) }}">{{ $order->customers->name }}</a> </td>
                             <td colspan="1" class="whitespace-nowrap text-center bg-gray-200">Order ID:{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap truncate">
                                @foreach($ProductsOrdered as $index => $item)
                                    @if($item->customer_orders_id == $order->id)
                                        {{ $item->product_id }},
                                    @endif
                                @endforeach
                            </td>
                            <td class="whitespace-nowrap text-center">
                              <div>₱{{ $order->total }}</div>
                               <div>{{ $order->mode_of_payment }}</div>
                            </td>
                            <td class="whitespace-nowrap text-center">
                                {{ $order->status }}
                            </td>
                            <td class="whitespace-nowrap text-center"> <a href="{{ Route('orders.show',$order->id ) }}"> <i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show Details</td></a>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="font-medium">No Orders Found</td>
                    </tr>
                    @endforelse
                   </tbody>
               </table>
           </div>


       </div>
        <!-- End: Orders Table -->
        <div class="intro-y mt-5 col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $Orders->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
    </div>
</div>
