@extends('customer.layout.base')
@section('content')
@section('title', 'Profile Information')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
            Welcome to Go Dental!
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Profile Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: Personal Information -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Personal Information
                </h2>
                <!-- Begin: If Customer Not Verify -->
                @if(!Auth::guard('customer')->user()->email_verified_at)
                    <div class="dropdown">
                        <a href="{{ Route('customer.verify') }}" class="text-slate-500 leading-none">
                            Verify Account!
                        </a>
                    </div>
                @endif
                <!-- End: If Customer Not Verify -->
            </div>
            <div class="p-5">
                @if(session('fail'))
                    <div class="alert alert-danger show mb-2 intro-x" role="alert">{{ session('fail') }}</div>
                @endif
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <!-- Begin: Show Customer Profile -->
                    <livewire:show.customer-profile/>
                    <!-- End: Show Customer Profile -->
                    <!-- Begin: Customer Change Profile Form -->
                    <livewire:form.customer-change-profile-form/>
                    <!-- End: Customer Change Profile Form -->
                    <!-- Begin: Customer Change Information-->
                    <livewire:form.customer-change-information/>
                    <!-- End: Customer Change Information -->
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class=" ">
                                @if(!empty(Auth::guard('customer')->user()->photo))
                                    <img src="{{ url('storage/customer_profile_picture/'.Auth::guard('customer')->user()->photo.'') }}" class="rounded-md h-40 w-full object-fill"  alt="Missing Image" data-action="zoom">
                                @else
                                    <img alt="Missing Image" class="rounded-md" src="{{asset('dist/images/undraw_pic.svg')}}" data-action="zoom">
                                @endif
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button class="btn btn-primary w-full" data-tw-toggle="modal" data-tw-target="#change-profile-modal">
                                    Change Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Personal Information -->
        <!-- BEGIN: RECENT ORDERS -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Recent Orders
                </h2>
            </div>
            <div class="p-5">
                <livewire:table.customer-recent-orders-table/>
            </div>
        </div>
            <!-- END: RECENT ORDERS -->
    </div>
    <!-- END: Personal Information -->
</div>
<!-- End: Profile Body -->
@endsection
@push('scripts')
<script>
 const myModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-modal"));
    //Hide Form Modal
    window.addEventListener('CloseModal',event => {
        myModal.hide();
    });
    //Closing Modal and Refreshing its value
    const myModalEl = document.getElementById('change-profile-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });




    const informationModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-information-modal"));
    window.addEventListener('openEditInformationModal',event => {
        informationModal.show();
    });

    //Hide Form Modal
    window.addEventListener('CloseInformationModal',event => {
        informationModal.hide();
    });
    //Closing Modal and Refreshing its value
    const infoModal = document.getElementById('change-profile-information-modal')
    infoModal.addEventListener('hidden.tw.modal', function(event) {
        console.log('wor')
        livewire.emit('ForceClose');
    });





</script>
@endpush
