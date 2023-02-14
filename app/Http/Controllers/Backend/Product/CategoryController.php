<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;
use Illuminate\Support\Facades\Gate;
class CategoryController extends Controller
{
    //Show Category Page
    public function index(){
        abort_if(Gate::denies('category_access'),403);
        return view('admin.page.product.category');
    }
    //Export Category to Excel
    public function exportcategoriesexcel(){
        abort_if(Gate::denies('category_export'),403);
        return Excel::download(new CategoryExport,'categories.xlsx');
    }
    //Export Category to CSV
    public function exportcategoriescsv(){
        abort_if(Gate::denies('category_export'),403);
        return Excel::download(new CategoryExport,'categories.csv');
    }
    //Export Category to HTMl
    public function exportcategorieshtml(){
        abort_if(Gate::denies('category_export'),403);
        return Excel::download(new CategoryExport,'categories.html');
    }
    //Export Category to PDF
    public function exportcategoriespdf(){
        abort_if(Gate::denies('category_export'),403);
        return Excel::download(new CategoryExport,'categories.pdf');
    }

}
