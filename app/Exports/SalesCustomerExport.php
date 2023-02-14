<?php

namespace App\Exports;

use App\Models\SalesCustomer;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesCustomerExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function map($customer): array
    {   
        $x = "0";
        return [
            $customer->name,
            $customer->email,
            $x,
            $x,
            $x,
        ];
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Email',
            'Total Orders',
            'Gross Sales',
            'Total Sales', 
        ];
    }
}
