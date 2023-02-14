<?php

namespace App\Exports;

use App\Product;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class SalesProductReportsExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category','brand')->get();
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->category->name,
            $product->brand->name,
            0,
            0,
        ];
    }


    public function headings(): array
    {
        return [
            'Product Title',
            'Product Category',
            'Product Brand',
            'Gross Sales',
            'Total Sales',
        ];
    }
}
