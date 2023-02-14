@extends('admin.layout.admin')
@section('content')
@section('title', 'Analytics')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Analytics
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Body -->
<div class="flex justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
    <div class=" box p-5 mt-5 w-full">
        <div class="h-[400px]"> <canvas id="stacked-bar-chart-widget"></canvas> </div>
    </div>
    <div class=" box p-5 mt-5 w-full">
        <div class="h-[400px]"> <canvas id="pie-chart-widget"></canvas> </div>
    </div>
</div>
<div class="flex justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
    <div class=" box p-5 mt-5 w-full">
        <div class="h-[400px]"> <canvas id="line-chart-widget"></canvas> </div>
    </div>
    <div class=" box p-5 mt-5 w-full">
        <div class="h-[400px]"> <canvas id="donut-chart-widget"></canvas> </div>
    </div>
</div>
<!-- End: Body -->

@endsection
