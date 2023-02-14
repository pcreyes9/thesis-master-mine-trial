@extends('admin.layout.admin')
@section('content')
@section('title', 'Order')
<h2 class="intro-y text-lg font-medium mt-10"></h2>
    <!-- Begin: Product Ordered -->
    <div class="intro-y box p-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
            <div class=" flex justify-between items-center border-b border-slate-200/60  pb-5">
                <div class="font-medium text-base">
                    <a href="{{ url()->previous() }}" class="mr-2 btn">←</a>  Order Details
                </div>
                <div>
                    @if($orderdetails->status == "Rejected")
                        <div class="ml-2 px-2 py-2 bg-slate-100 text-danger btn btn-danger text-xs rounded-md">{{ $orderdetails->status }}</div>
                    @else
                        <div class="ml-2 px-2 py-2 bg-slate-200 text-slate-600  text-xs rounded-md">{{ $orderdetails->status }}</div>
                    @endif
                </div>

            </div>
            <div class="mt-5">
                <div class="overflow-x-auto">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <th class="whitespace-nowrap">Product Name</th>
                            <th class="whitespace-nowrap text-center">Price</th>
                            <th class="whitespace-nowrap text-center">Quantity</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $product->product_name }}</td>
                                    <td class="whitespace-nowrap text-center">₱{{ number_format($product->price,2) }}</td>
                                    <td class="whitespace-nowrap text-center">{{ number_format($product->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Product Ordered -->
    <!-- Begin: Order Details -->
    <div class="intro-y box mt-5 p-5">
        <div>
            Order ID:{{ $orderdetails->id }}
        </div>
        <div>
            Placed On: {{ $orderdetails->created_at->toFormattedDateString() }}
        </div>
        <div>
            Mode of Payment: {{ $orderdetails->mode_of_payment }}
        </div>
    </div>
    <!-- End: Order Details -->
   <!-- Begin: Seperator -->
    <div class="flex mt-5 justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
         <!-- Begin: Shipping Information -->
        <div class="intro-y box p-5  w-full">
            <div class="font-medium">Shipping Information</div>
            <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>
            <div>
                Receiver: {{ $orderdetails->received_by }}
            </div>
            <div>
                Phone Number: {{ $orderdetails->phone_number }}
            </div>
            <div>
                Notes: {{ $orderdetails->notes }}
            </div>
            <div>
                Address {{ $orderdetails->house }}
            </div>
            <div>
                Postal Code: {{ $orderdetails->province }}~{{ $orderdetails->city }}~{{ $orderdetails->barangay }}
            </div>
        </div>
        <!-- End: Shipping Information -->
        <!-- Begin: Total -->
        <div class="intro-y box p-5 w-full">
            <div class="font-medium">Total Summary</div>
            <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>

            <div class="flex justify-between">
                <div>Subtotal</div>
                <div>₱{{ number_format($orderdetails->subtotal) }}</div>
            </div>
            <div class="flex justify-between">
                <div>Shipping Fee</div>
                <div>₱{{ number_format($orderdetails->shippingfee) }}</div>
            </div>
            <div class="w-full border-t border-slate-200/60 mt-1 mb-2"></div>
            <div class="flex justify-between">
                <div>Total</div>
                <div>₱{{ number_format($orderdetails->total) }}</div>
            </div>
        </div>
        <!-- End: Total -->
    </div>
    <!-- End: Seperator -->
    @if($orderdetails->status == "Pending for Approval")
        @livewire('form.order-approval',['order' => $orderdetails])
    @endif
    <livewire:modal.order-approved-form/>
    <livewire:modal.order-reject-form/>
@endsection

@push('scripts')
    <script>
    //SuccessAlert
    window.addEventListener('SuccessAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            className: `toast-${id}`,
            newWindow: false,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
            toast.querySelector("#title").innerText = event.detail.title
            toast.querySelector("#message").innerText = event.detail.name
        });
    //Invalid Alert
    window.addEventListener('InvalidAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#invalid-success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            newWindow: true,
            className: `toast-${id}`,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
                toast.querySelector("#title").innerText = event.detail.title
                toast.querySelector("#message").innerText = event.detail.name
    });
    const ApprovedModal = tailwind.Modal.getInstance(document.querySelector("#order-approved-modal"));
    window.addEventListener('OpenApprovedModal',event => {
        ApprovedModal.show();
    });
    //Hide Form Modal
    window.addEventListener('closeApprovedModal',event => {
        ApprovedModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ApprovedModalEl = document.getElementById('order-approved-modal')
    ApprovedModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
      //Delete Modal
      const RejectModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#order-reject-modal"));
    //Show Delete Modal
    window.addEventListener('openRejectModal',event => {
        RejectModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('closeRejectModal',event => {
        RejectModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('order-reject-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
    </script>
@endpush
