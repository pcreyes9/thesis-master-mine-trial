@extends('customer.layout.base')
@section('content')
@section('title', 'About Us')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        About us
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Main Container -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Mission, Vision, and Core Values -->
    <div class="intro-y col-span-12 lg:col-span-4 box py-10 ">
        <i data-lucide="shield" class="block w-12 h-12 text-primary mx-auto"></i>
        <div class="font-medium text-center text-base mt-3">Mission</div>
        <div class="text-slate-500 mt-2 w-3/4 text-center mx-auto">Lorem Ipsum is simply dummy text of the printing</div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-4 box py-10">
        <i data-lucide="send" class="block w-12 h-12 text-primary mx-auto"></i>
        <div class="font-medium text-center text-base mt-3">Vision</div>
        <div class="text-slate-500 mt-2 w-3/4 text-center mx-auto">Lorem Ipsum is simply dummy text of the printing</div>
    </div>
    <div class="intro-y col-span-12 lg:col-span-4 box py-10">
        <i data-lucide="trending-up" class="block w-12 h-12 text-primary mx-auto"></i>
        <div class="font-medium text-center text-base mt-3">Core Values</div>
        <div class="text-slate-500 mt-2 w-3/4 text-center mx-auto">Lorem Ipsum is simply dummy text of the printing</div>
    </div>
    <!-- END: Mission, Vision, and Core Values -->
    <!-- BEGIN:Go Dental Information -->
    <div class="intro-y col-span-12 lg:col-span-6">
        <div class="box">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Go Dental Information
                </h2>
            </div>
            <div class="w-full h-full sm:h-full p-5 text-justify">
                <div class="indent-5"> Roman Dental Supplies Trading is a company launched in 2009 owned by Par, Roldan Vargas.
                    The company is located at Grand Royale Subdivision, Barangay. Pinagbakahan, City of Malolos,
                    Bulacan. The company is an importer and distributor of dental supplies and equipment.
                    The company offers business transactions from 8:00 am to 5:00 pm, Monday to Saturday.</div>
                <div class="indent-5 mt-2">
                    Maecenas at sodales arcu. Sed euismod ligula quis lobortis gravida.
                    Aliquam laoreet sagittis leo eu tempus. Curabitur tortor est, bibendum quis sapien ut,
                    maximus vulputate mauris. Vestibulum gravida libero dui, et euismod sapien interdum vel.
                    Aliquam venenatis tortor libero. Mauris ac ante id arcu tristique dapibus eget eu augue.
                    Proin ac nunc et neque egestas gravida. Vivamus lacus odio, varius vehicula consectetur aliquam,
                    blandit ut tellus. In sodales ipsum dui, quis ultrices risus tempor id. Curabitur tincidunt pulvinar nisi,
                    at porttitor ex feugiat vel. Duis at rutrum mauris, non tristique massa.
                </div>
                <div class="indent-5 mt-2">
                    Maecenas at sodales arcu. Sed euismod ligula quis lobortis gravida.
                    Aliquam laoreet sagittis leo eu tempus. Curabitur tortor est, bibendum quis sapien ut, maximus vulputate mauris.
                    Vestibulum gravida libero dui, et euismod sapien interdum vel.
                    Aliquam venenatis tortor libero. Mauris ac ante id arcu tristique dapibus eget eu augue.
                    Proin ac nunc et neque egestas gravida. Vivamus lacus odio, varius vehicula consectetur aliquam, blandit ut tellus.
                    In sodales ipsum dui, quis ultrices risus tempor id. Curabitur tincidunt pulvinar nisi, at porttitor ex feugiat vel.
                     Duis at rutrum mauris, non tristique massa.
                </div>
            </div>
        </div>
    </div>
    <!-- End: Go Dental Information -->
    <!-- Begin: Go Dental Image -->
    <div class="intro-y box col-span-12 lg:col-span-6 ">
        <div class="flex items-center justify-center">
            <img src="{{ asset('icons/about.jpg') }}" class="w-full h-96" alt="About Us Image" data-action="zoom" />
        </div>
    </div>
    <!-- End Go Dental Image -->
</div>
<!-- Begin: Go Dental Map -->
<div class="box intro-y mt-5 p-3 border-b border-slate-200/60">
    <div id="map"  class="w-full h-96 "></div>
</div>
<!-- End: Go Dental Map -->

@endsection
@push('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMPLUYUqR8R0YvltLkdenCqsCqH2v7kvQ&callback=initMap"></script>
<script>
    // Initialize and add the map
    function initMap() {
    // The location of Uluru
    const uluru = { lat: 14.869930304129703, lng: 120.81190889325947 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: uluru,
        map: map,
    });
    }

    initMap();
    window.initMap = initMap;
</script>
@endpush

