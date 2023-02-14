<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\SalesProduct;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesProductExport implements FromCollection, ShouldAutoSize,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $x = 0;
    public function collection()
    {
        return Product::with('category','brand')->get();
    }

    public function map($product): array
    {   
        $x = "0";
        return [
            $product->name,
            $product->category->name,
            $product->brand->name,
            $x,
            $x,
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
