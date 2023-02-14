<div>
    <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12">
            <!-- Begin: Sort and Search -->
            <div class="intro-y box p-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                            <div class="xl:flex lg:flex sm:mr-auto" >
                                <div class="sm:flex items-center sm:mr-4">
                                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
                                    <select  wire:model="sorting" class="form-select w-full sm:w-full 2xl:w-full mt-2 sm:mt-0 ">
                                        <option value="nameaz" >Product Title A-Z</option>
                                        <option value="nameza">Product Title Z-A</option>
                                        <option value="createdold">Created (oldest first)</option>
                                        <option value="creatednew">Created (newest first)</option>
                                        <option value="updatedatold">Updated (oldest first)</option>
                                        <option value="updatedat">Updated (newest first)</option>
                                        <option value="lowinventory">Low inventory</option>
                                        <option value="highinventory">High inventory</option>
                                        <option value="cataz">Category A-Z</option>
                                        <option value="catza">Category Z-A</option>
                                    </select>
                                </div>
                                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                                    <input wire:model="search" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div class="overflow-x-auto">
                                <table class="table table-striped table-bordered  mt-5" >
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="whitespace-nowrap ">Transfer Code</th>
                                            <th class="whitespace-nowrap text-center">Supplier Name</th>
                                            <th class="whitespace-nowrap text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                        <tr>
                                            <td><a href="{{ Route('transfer.edit',$order->id) }}">T00{{ $order->id }}</a> </td>
                                            <td class="whitespace-nowrap text-center">{{ $order->suppliers->name }}</td>
                                            <td class="whitespace-nowrap text-center">{{ $order->status }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No Transfer Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                       <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                           <nav class="w-full sm:w-auto sm:mr-auto">
                                {!! $orders->onEachSide(1)->links() !!}
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
            </div>
        </div>
    </div>
</div>
