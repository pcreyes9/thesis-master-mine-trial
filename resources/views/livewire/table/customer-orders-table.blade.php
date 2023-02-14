<div class="overflow-x-auto">
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th class="whitespace-nowrap">Order ID</th>
                <th class="whitespace-nowrap text-center">Products</th>
                <th class="whitespace-nowrap text-center">Total</th>
                <th class="whitespace-nowrap text-center">Status</th>
                <th class="whitespace-nowrap text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Orders as $order)
                <tr>
                    <td class="whitespace-nowrap">#{{ $order->id }}</td>
                    <td class="whitespace-nowrap text-center truncate">
                        @foreach($ProductsOrdered as $index => $item)
                            @if($item->customer_orders_id == $order->id)
                                {{ $item->product_name }},
                            @endif
                        @endforeach
                    </td>
                    <td class="whitespace-nowrap text-center">
                        ₱{{ $order->total }}
                    </td>
                    <td class="whitespace-nowrap text-center">
                        {{ $order->status }}
                    </td>
                    <td class="whitespace-nowrap text-center"> <a href="{{ Route('order.show',$order->id ) }}"> <i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show Details</td></a>
                </tr>
            @empty
            <tr>
                <td colspan="5" class="font-medium">No Orders Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>


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
