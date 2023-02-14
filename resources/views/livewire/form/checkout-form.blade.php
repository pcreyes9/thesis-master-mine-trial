<div>
    <script src="https://www.paypal.com/sdk/js?client-id=AZzxYWHDmvZxLx99ZwQfI8pUjxZfqwA34vUUelB06kxxSeyqFzhOwGRcKn4z5YAyFdvt-epootEdtavV&currency=PHP"></script>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                amount: {
                    value: '{{ $total }}' // Can also reference a variable or function
                }
                }]
            });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                if(transaction.status == "COMPLETED"){
                    Livewire.emit('transactionEmit', transaction.id)
                }
                //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                // When ready to go live, remove the alert and show a success message within this page. For example:
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
            }
        }).render('#paypal-button-container');
    </script>
    <form wire:submit.prevent="StoreCustomerOrder">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <!-- BEGIN: Shipping Information -->
                <div class="intro-y box mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex justify-between w-full">
                            <div>
                                <h2 class="font-medium text-base mr-auto">
                                    Shipping Address
                                </h2>
                            </div>
                            <div>
                                <button type="button" class="underline text-blue-400 cursor-pointer"  wire:click="selectItem({{ $updateAddress }},'editaddress')">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        @foreach ($address as $address)
                            <div>
                                {{ $address->name }} - {{ $address->phone_number }}
                            </div>
                            <div>
                                Address: {{ $address->house }} | Postal Code: {{ $address->province }}-{{ $address->city }}-{{ $address->barangay }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END: Shipping Information -->
                <!-- BEGIN: ORDERS -->
                <div class="intro-y box mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Product Ordered
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="whitespace-nowrap">Product Name</th>
                                        <th class="whitespace-nowrap text-center">Unit Price</th>
                                        <th class="whitespace-nowrap text-center">Total Price</th>
                                        <th class="whitespace-nowrap text-center">Quantity</th>
                                        <th class="whitespace-nowrap text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="whitespace-nowrap">{{ $order->product->name }}</td>
                                            <td class="whitespace-nowrap text-center">₱{{ number_format($order->product->sprice) }}</td>
                                            <td class="whitespace-nowrap text-center">₱{{ number_format($order->product->sprice * $order->quantity) }}</td>
                                            <td class="whitespace-nowrap text-center">{{ $order->quantity }}</td>
                                            <td class="whitespace-nowrap flex justify-center items-center" >
                                                @if(count($orders)  == 1)
                                                    <!-- BEGIN: Modal Toggle -->
                                                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="text-danger">
                                                            <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Remove
                                                        </a>
                                                    <!-- END: Modal Toggle -->
                                                    <!-- BEGIN: Modal Content -->
                                                        <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body p-0">
                                                                        <div class="p-5 text-center">
                                                                            <i class="fa-regular fa-circle-xmark fa-5x text-warning mx-auto mt-3"></i>
                                                                            <div class="text-3xl mt-5">Oops...</div>
                                                                            <div class="text-slate-500 mt-2">Something went wrong!</div>
                                                                        </div>
                                                                        <div class="px-5 pb-8 text-center">
                                                                            <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                                                                        </div>
                                                                        <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                                                            <div class="text-primary">Your cart cannot be empty!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- END: Modal Content -->
                                                @else
                                                    <button wire:click="selectItem({{ $order->id }},'remove')" class="flex items-center text-center text-danger" type="button">
                                                        <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Remove
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END: ORDERS -->
            </div>
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">Select Payment Method</div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-slate-200/60">
                        <button type="submit" class="btn btn-primary w-full h-12 mb-2">Place Order (Cash on Delivery)</button>
                        <div wire:ignore class="mt-2 w-full">
                            <div id="paypal-button-container"></div>
                        </div>


                    </div>
                    <div class="p-5 border-t border-slate-200/60">
                        <h1 class="font-medium leading-none mt-1">Order Summary</h1>
                        <div class="flex justify-between mt-3">
                            <div>
                                <h1>Subtotal (items)</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($subtotal)}}</h1>
                            </div>
                        </div>
                        <div class="flex justify-between mt-3 ">
                            <div>
                                <h1>Shipping Fee</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($shippingfee ) }}</h1>
                            </div>
                        </div>
                        <div class="border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="flex justify-between mt-3 ">
                                <div>
                                    <h1 class="font-medium leading-none mt-1 mb-2">Total</h1>
                                </div>
                                <div>
                                    <h1>₱{{ number_format($total) }}</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
