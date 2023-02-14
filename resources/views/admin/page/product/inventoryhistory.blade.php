@extends('admin.layout.admin')
@section('content')
@section('title', 'Inventory History')

@livewire('table.product-inventory-history',['product' => $product])

@endsection
@push('scripts')
@endpush
