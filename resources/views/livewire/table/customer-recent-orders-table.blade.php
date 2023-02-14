<div>
    <div class="overflow-x-auto">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="whitespace-nowrap">Order #</th>
                    <th class="whitespace-nowrap text-center">Place On</th>
                    <th class="whitespace-nowrap text-center">Items</th>
                    <th class="whitespace-nowrap text-center">Total</th>
                    <th class="whitespace-nowrap text-center">Status</th>
                    <th class="whitespace-nowrap text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Orders as $order)
                <tr>
                    <td class="whitespace-nowrap">#{{ $order->id }}</td>
                    <td class="whitespace-nowrap text-center"> {{ $order->created_at->toFormattedDateString() }}</td>
                    <td class="whitespace-nowrap text-center truncate">
                        @foreach($ProductsOrdered as $index => $item)
                            @if($item->customer_orders_id == $order->id)
                                {{ $item->product_name }},
                            @endif
                        @endforeach
                    </td>
                    <td class="whitespace-nowrap text-center">
                        <div>     ₱{{ $order->total }}</div>
                        <div>{{ $order->mode_of_payment }}</div>

                    </td>
                    <td class="whitespace-nowrap text-center">
                        {{ $order->status }}
                    </td>
                    <td class="whitespace-nowrap text-center"> <a href="{{ Route('order.show',$order->id ) }}"> <i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show Details</td></a>
                </tr>
            @empty
            <tr>
                <td colspan="6" class="font-medium">No Orders Found</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
