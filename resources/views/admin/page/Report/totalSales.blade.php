@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')

{{-- @livewire('totalsalestable') --}}
<livewire:table.total-sales-table/>
{{-- <div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
           <a href="{{Route('report.index')}}" class="mr-2 btn">←</a> Monthly Sales
        </div>
        <form action="SearchDate" method="GET">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="form-group row">
                        <label for="date" class="col-form-label col-sm-2">Date from</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="from" name ="from" required/>
                        </div>
                        <label for="date" class="col-form-label col-sm-2">Date to</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="to" name ="to" required/>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn" name ="search" title="search"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <!-- Product Title -->
            <div class="overflow-x-auto scrollbar-hidden">
                <div class="overflow-x-auto">
                    <table class="table table-striped mt-5 table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="whitespace-nowrap ">Month</th>
                                <th class="whitespace-nowrap text-center">Total Orders</th>
                                <th class="whitespace-nowrap text-center">Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product )
                            <tr>
                                <td class="whitespace-nowrap ">{{$product->month_name}}</td>
                                <td class="whitespace-nowrap text-center">{{$product->count}}</td> 
                                <td class="whitespace-nowrap text-center">{{$product->total}}</td> 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div> --}}
@endsection
