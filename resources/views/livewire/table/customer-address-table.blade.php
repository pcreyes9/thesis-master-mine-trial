<div>
    <div class="overflow-x-auto">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th class="whitespace-nowrap">Full Name</th>
                    <th class="whitespace-nowrap text-center">Address</th>
                    <th class="whitespace-nowrap text-center">Postcode</th>
                    <th class="whitespace-nowrap text-center">Phone Number</th>
                    <th class="whitespace-nowrap text-center">Action</th>
                </tr>
            </thead>
            <tbody id="addressTbody" >
                @forelse ($address as $address)
                <tr >
                    <td class="whitespace-nowrap">{{ $address->name }}</td>
                    <td class="whitespace-nowrap text-center">{{ $address->house }}</td>
                    <td class="whitespace-nowrap text-center address" wire:ignore>{{ $address->province }}-{{ $address->city }}-{{ $address->barangay}}</td>
                    <td class="whitespace-nowrap text-center">{{ $address->phone_number }}</td>
                    <td class="whitespace-nowrap text-center">
                        @if($address->default_address == 0)
                            <button wire:click="selectItem({{$address->id}},'set')" class="mr-1" >
                                <i class="fa-solid fa-location-dot mr-1 w-4 h-4"></i> Set Default
                            </button>
                        @endif
                        <a href="{{ Route('customer.address.edit', $address->id) }}" class="mr-1"><i class="fa-regular fa-pen-to-square w-4 h-4 mr-1"></i> Edit</a>
                        <button wire:click="selectItem({{$address->id}},'delete')" class="text-danger"><i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Delete</button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5">No Address Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($countaddress <= 4)
        <div class="flex justify-end  mt-3">
            <a href="{{ Route('customer.address.create') }}" class="btn btn-primary w-52">Add New Address</a>
        </div>
    @else
    <!-- BEGIN: Modal Toggle -->
    <div class="flex justify-end  mt-3">
        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="btn btn-primary">
            Add New Address
        </a>
    </div>
    <!-- END: Modal Toggle -->
    <!-- BEGIN: Modal Content -->
    <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i class="fa-regular fa-circle-xmark fa-5x text-warning mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">
                            Oops...
                        </div> <div class="text-slate-500 mt-2">Something went wrong!</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                    </div>
                    <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <a href="" class="text-primary">
                            You can only create up to 5 shipping address
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
