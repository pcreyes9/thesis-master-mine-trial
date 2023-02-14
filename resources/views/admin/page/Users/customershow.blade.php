@extends('admin.layout.admin')
@section('content')
@section('title', 'Customer')
<div class="intro-y flex justify-between  items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ url()->previous() }}" class="mr-2 btn">←</a>  Customer Information
         </h2>
    </div>
</div>
@livewire('show.customer-show',['customer' => $customer])
@endsection

@push('scripts')

@endpush
