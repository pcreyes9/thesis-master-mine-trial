<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('brand_create')
                <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#add-item-modal">Add New Brand</button>
            @endcan
            @can('brand_export')
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"><i class="fa-regular fa-plus w-4 h-4"></i></span>
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
        @endcan
            <div class="hidden md:block mx-auto text-slate-500">
                @if($brands->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$brands->firstItem()}} to {{$brands->lastItem()}} of {{$brands->total()}} entries
                @endif
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="search" wire:model.lazy="search" class="form-control w-56 box " placeholder="Search...">
                </div>
            </div>
        </div>
        <!-- BEGIN: Banner Layout -->
        @forelse($brands as $brand)
            <div class="intro-y col-span-12 sm:col-span-6 md:col-span-6 lg:col-span-3">
                <div class="box">
                    <div class="flex items-start px-5 pt-5">
                        <div class="w-full flex flex-col lg:flex-row items-center">
                            <div class="lg:ml-2 text-center lg:text-left mt-3 lg:mt-0">
                                <a href="" class="font-medium">{{ $brand->name }}</a>
                                <p class="text-slate-500 text-xs mt-0.5">

                                </p>
                            </div>
                        </div>
                        <div class="absolute right-0 top-0 mr-5 mt-3 dropdown">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical text-slate-500 w-5 h-5"></i>
                             </a>
                            <div class="dropdown-menu w-40">
                                <div class="dropdown-content">
                                    @can('brand_edit')
                                        <button wire:click="selectItem({{ $brand->id }},'edit')" class="dropdown-item w-full"> <i class="fa-solid fa-pen mr-1"></i></i> Edit </button>
                                    @endcan
                                    @can('brand_edit')
                                        <button wire:click="selectItem({{ $brand->id }},'change_photo')" class="dropdown-item w-full"> <i class="fa-solid fa-pen mr-1"></i></i> Change Photo </button>
                                    @endcan
                                    @can('brand_delete')
                                        <button wire:click="selectItem({{$brand->id}},'delete')"  class="dropdown-item w-full"> <i class="fa-solid fa-trash mr-1"></i> Delete </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-center border-t border-slate-200/60 dark:border-darkmode-400 mt-2"> </div>
                        <div class="flex justify-center text-center lg:text-left p-5 ">
                            @if(!empty($brand->photo))
                                <img src="{{ url('storage/brand/'.$brand->photo) }}" data-action="zoom" class="w-full h-56" alt="">
                            @else
                                <img alt="Missing Image" class="w-56 h-56" data-action="zoom" src="{{asset('dist/images/undraw_pic.svg')}}">
                            @endif
                        </div>
                </div>
            </div>
        @empty
            <div class="intro-y col-span-12 text-lg font-medium flex justify-center box p-10">
                <div class="flex justify-center flex-col">
                    <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                    <div class="flex justify-center mt-1">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
                </div>
            </div>
        @endforelse
        <!-- END: brands Layout -->

        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $brands->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
