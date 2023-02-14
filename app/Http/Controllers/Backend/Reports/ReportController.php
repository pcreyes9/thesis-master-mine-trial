<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\OrderedProduct;
use Illuminate\Support\Facades\DB;
use App\Exports\SalesProductExport;
use App\Exports\SalesCustomerExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\SalesProductReportsExport;

class ReportController extends Controller
{
    //Show Report Page
    public function index(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.myReport');
    }

    // SalesProd
    public function salesProd(Product $product){
        abort_if(Gate::denies('report_access'),403);

        // $products = Product::select(
        //     [
        //     'id',
        //     'name',
        //     'category_id',
        //     'brand_id',
        //     'cprice',
        //     'sprice',
        //     DB::raw('(SELECT COUNT(*)
        //      FROM ordered_products as op WHERE op.product_id = product.id) as order_total'),
        //     DB::raw('(SELECT SUM(quantity) FROM ordered_products where product_id = product.id) as order_quantity'),
        //     DB::raw('(SELECT product.cprice*SUM(quantity) FROM ordered_products where product_id = product.id) as gross_sales'),
        //     DB::raw('(SELECT product.sprice*SUM(quantity) FROM ordered_products where product_id = product.id) as total_sales'),
             
            
        //     ]  
        //     )->orderBy('id')->get();
        $products = OrderedProduct::join('product', 'ordered_products.product_id', '=', 'product.id')->groupBy('product.id','product.name', 'product.sprice', 'category_id', 'brand_id', 'product.cprice')->orderBy('total_sales', 'desc')
        ->select(
            [
                'product.id',
                'product.name',
                'category_id',
                'brand_id',
                DB::raw('(SELECT category.name FROM category WHERE category.id = product.category_id) as category_name'),
                DB::raw(value: 'SUM(ordered_products.quantity) as order_quantity'),
                DB::raw(value: 'COUNT(ordered_products.id) as order_total'),
                DB::raw(value: 'product.sprice*(SUM(ordered_products.quantity)) as total_sales'),
                DB::raw(value: 'product.cprice*(SUM(ordered_products.quantity)) as gross_sales'),
                DB::raw('(SELECT category.name FROM category WHERE category.id = product.category_id) as category_name'),
                DB::raw('(SELECT brand.name FROM brand WHERE brand.id = product.brand_id) as brand_name'),
            ]  
            )->get();
        // dd($product->toSql());
      
        return view('admin.page.Report.salesProd',[
           'products'=> $products
        ]);
    }

    public function exportSalesProductPDF(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesProductExport,'SalesProduct.pdf');
    }
    public function exportSalesProductEXCEL(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesProductExport,'SalesProduct.xlsx');
    }
    public function exportSalesProductCSV(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesProductExport,'SalesProduct.csv');
    }
    public function exportSalesProductHTML(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesProductExport,'SalesProduct.html');
    }
   

    // SalesCustomer
    public function salesCustomer(Customer $customer){
        abort_if(Gate::denies('report_access'),403);

        $customers = Customer::select(
            'id',
            'name',
            'email',
            DB::raw('(SELECT SUM(quantity) FROM ordered_products as op WHERE op.customers_id = customers.id) as order_quantity'),
            DB::raw('(SELECT COUNT(*) FROM customer_orders as op WHERE op.customers_id = customers.id) as order_total'),
            DB::raw('(SELECT SUM(total) FROM customer_orders as op WHERE op.customers_id = customers.id) as total_sales'),            
        )->orderBy('total_sales','desc')->get();
        // dd($customers);
        return view('admin.page.Report.salesCustomer',[
            'customers'=> $customers,
         ]);
    }

    public function exportSalesCustomerPDF(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesCustomerExport,'SalesCustomer.pdf');
    }
    public function exportSalesCustomerEXCEL(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesCustomerExport,'SalesCustomer.xlsx');
    }
    public function exportSalesCustomerCSV(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesCustomerExport,'SalesCustomer.csv');
    }
    public function exportSalesCustomerHTML(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new SalesCustomerExport,'SalesCustomer.html');
    }


    public function totalSales(){
        abort_if(Gate::denies('report_access'),403);

        $products = CustomerOrder::select(
            [
            DB::raw(value: '(COUNT(*)) as count'), 
            DB::raw(value: '(SUM(total)) as total'),
            DB::raw(value: 'MONTHNAME(customer_orders.created_at) as month_name'),
            
            ]  
            )->whereYear('customer_orders.created_at', 2023)
            ->groupBy('month_name')->orderBy('month_name')->get();
            // dd($products->toArray());

        return view('admin.page.Report.totalSales',['products'=> $products]);
    }

    public function show(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');

        $products = CustomerOrder::select(
            [
            DB::raw(value: '(COUNT(*)) as count'), 
            DB::raw(value: '(SUM(total)) as total'),
            DB::raw(value: 'MONTHNAME(customer_orders.created_at) as month_name'),
            
            ]  
            )->where('customer_orders.created_at', '>=', $from)
            ->where('customer_orders.created_at', '<=', $to)
            ->groupBy('month_name')->orderBy('month_name', 'desc')->get();
        return view('admin.page.Report.totalSales',['products'=> $products]);
    }

    public function grossProfit(){
        abort_if(Gate::denies('report_access'),403);
        return view('admin.page.Report.grossProfit');
    }

    public function grossSales(){
        abort_if(Gate::denies('report_access'),403);

        $products = OrderedProduct::select(
            [
            // 'id',
            // 'name',
            // 'category_id',
            // 'brand_id',
            // 'cprice',
            // 'sprice',
            // DB::raw('(SELECT COUNT(*)
            //  FROM ordered_products as op WHERE op.product_id = product.id) as order_total'),
            // DB::raw('(SELECT SUM(quantity) FROM ordered_products where product_id = product.id) as order_quantity'),
            // DB::raw('(SELECT product.cprice*SUM(quantity) FROM ordered_products where product_id = product.id) as gross_sales'),
            // DB::raw('(SELECT product.sprice*SUM(quantity) FROM ordered_products where product_id = product.id) as total_sales'),
            
            DB::raw(value: '(COUNT(*)) as COUNT'),
            DB::raw(value: 'MONTHNAME(ordered_products.created_at) as month_name'),
            
            ]  
            )->whereYear('ordered_products.created_at', 2023)
            ->groupBy('month_name')->get();
            // dd($products->toArray());
        
        // $products = OrderedProduct::join('product', 'ordered_products.product_id', '=', 'product.id')->groupBy('product_name', 'product.id', 'order_total', 'month_name' )->orderBy('month_name', 'desc')
        // ->select(
        //     'product.name as product_name',
        //     'product.id',
        //     DB::raw('(SELECT COUNT(*)
        //         FROM ordered_products as op WHERE op.created_at = op.created_at) as order_total'),
        //     DB::raw(value: 'MONTHNAME(ordered_products.created_at) as month_name'),

        // )->whereYear('ordered_products.created_at', 2023)->get();
        
    // dd($products->get()->toArray());

        
        return view('admin.page.Report.grosssales',['products'=> $products]);
    }
}
