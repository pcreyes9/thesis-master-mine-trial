<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BrandExport;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{
  //Show Brand Page
  public function index(){
    abort_if(Gate::denies('brand_access'),403);
    return view('admin.page.product.brand');
  }
  //Export Brand to Excel
  public function exportbrandexcel(){
    abort_if(Gate::denies('brand_export'),403);
    return Excel::download(new BrandExport,'brands.xlsx');
  }
  //Export Brand to CSV
  public function exportbrandcsv(){
    abort_if(Gate::denies('brand_export'),403);
    return Excel::download(new BrandExport,'brands.csv');
  }
  //Export Brand to HTML
  public function exportbrandhtml(){
    abort_if(Gate::denies('brand_export'),403);
    return Excel::download(new BrandExport,'brands.html');
  }
  //Export Brand to PDF
  public function exportbrandpdf(){
    abort_if(Gate::denies('brand_export'),403);
    return Excel::download(new BrandExport,'brands.pdf');
  }
}
