<?php

use Illuminate\Support\Facades\Routes;
//Admin Dashboard Import
use App\Http\Controllers\Backend\Page\DashboardController;
//Admin Controller Import
use App\Http\Controllers\Backend\Page\ProfileController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ResetController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\ChangePasswordController;
use App\Http\Controllers\Backend\Auth\LogoutController;
//Import Admin Product Related Stuff
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\ProductImageController;
use App\Http\Controllers\Backend\Product\InventoryController;
use App\Http\Controllers\Backend\Product\InventoryTransferController;
use App\Http\Controllers\Backend\Product\SupplierController;
use App\Http\Controllers\Backend\Product\DiscountController;
//Import Admin Transaction Stuff
use App\Http\Controllers\Backend\Transaction\ChatController;
use App\Http\Controllers\Backend\Transaction\OrderController;
use App\Http\Controllers\Backend\Transaction\PostController;
use App\Http\Controllers\Backend\Reports\AnalyticsController;
use App\Http\Controllers\Backend\Reports\ReportController;
use App\Http\Controllers\Backend\Users\CustomerController;
use App\Http\Controllers\Backend\Users\RoleController;
use App\Http\Controllers\Backend\Users\UsersController;
use App\Http\Controllers\Backend\Users\PermissionController;

Route::group(['prefix' => 'admin'],function(){

    Route::middleware(['guest:web','PreventBackHistory'])->group(function () {
        Route::resource('login', LoginController::class)->only(['index','store']);
        Route::resource('register', RegisterController::class)->only(['index','store']);
        Route::get('reset/password/{token}', [ResetController::class, 'ShowResetForm'])->name('reset.password.form');
        Route::post('reset/password',[ResetController::class,'ResetPassword'])->name('reset.password');
        Route::resource('reset', ResetController::class)->only(['index','store']);
    });

    Route::middleware(['auth:web'])->group(function () {
        //Export Files for Category
        Route::get('/category/excel',[CategoryController::class,'exportcategoriesexcel'])->name('exportcategoriesexcel');
        Route::get('/category/csv',[CategoryController::class,'exportcategoriescsv'])->name('exportcategoriescsv');
        Route::get('/category/html',[CategoryController::class,'exportcategorieshtml'])->name('exportcategorieshtml');
        Route::get('/category/pdf',[CategoryController::class,'exportcategoriespdf'])->name('exportcategoriespdf');
        //Export Files for Brand
        Route::get('/brand/excel',[BrandController::class,'exportbrandexcel'])->name('exportbrandexcel');
        Route::get('/brand/csv',[BrandController::class,'exportbrandcsv'])->name('exportbrandcsv');
        Route::get('/brand/html',[BrandController::class,'exportbrandhtml'])->name('exportbrandhtml');
        Route::get('/brand/pdf',[BrandController::class,'exportbrandpdf'])->name('exportbrandpdf');
        //Export Files for Product
        Route::get('/product/excel',[ProductController::class,'exportproductexcel'])->name('exportproductexcel');
        Route::get('/product/csv',[ProductController::class,'exportproductcsv'])->name('exportproductcsv');
        Route::get('/product/html',[ProductController::class,'exportproducthtml'])->name('exportproducthtml');
        Route::get('/product/pdf',[ProductController::class,'exportproductpdf'])->name('exportproductpdf');
        //Export Files for Supplier
        Route::get('/supplier/excel',[SupplierController::class,'exportsupplierexcel'])->name('exportsupplierexcel');
        Route::get('/supplier/csv',[SupplierController::class,'exportsuppliercsv'])->name('exportsuppliercsv');
        Route::get('/supplier/html',[SupplierController::class,'exportsupplierhtml'])->name('exportsupplierhtml');
        Route::get('/supplier/pdf',[SupplierController::class,'exportsupplierpdf'])->name('exportsupplierpdf');
        //Export Files for Role
        Route::get('/role/excel',[RoleController::class,'exportroleexcel'])->name('exportroleexcel');
        Route::get('/role/csv',[RoleController::class,'exportrolecsv'])->name('exportrolecsv');
        Route::get('/role/html',[RoleController::class,'exportrolehtml'])->name('exportrolehtml');
        Route::get('/role/pdf',[RoleController::class,'exportrolepdf'])->name('exportrolepdf');
        //Export Files for Sales Product
        Route::get('/report/salesprod/pdf',[ReportController::class,'exportSalesProductPDF'])->name('exportSalesProductPDF');
        Route::get('/report/salesprod/excel',[ReportController::class,'exportSalesProductEXCEL'])->name('exportSalesProductEXCEL');
        Route::get('/report/salesprod/csv',[ReportController::class,'exportSalesProductCSV'])->name('exportSalesProductCSV');
        Route::get('/report/salesprod/html',[ReportController::class,'exportSalesProductHTML'])->name('exportSalesProductHTML');
        //Export Files for Sales Customer
        Route::get('/report/salescustomer/pdf',[ReportController::class,'exportSalesCustomerPDF'])->name('exportSalesCustomerPDF');
        Route::get('/report/salescustomer/excel',[ReportController::class,'exportSalesCustomerEXCEL'])->name('exportSalesCustomerEXCEL');
        Route::get('/report/salescustomer/csv',[ReportController::class,'exportSalesCustomerCSV'])->name('exportSalesCustomerCSV');
        Route::get('/report/salescustomer/html',[ReportController::class,'exportSalesCustomerHTML'])->name('exportSalesCustomerHTML');


        Route::middleware(['PreventBackHistory'])->group(function () {
            Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
            Route::resource('dashboard', DashboardController::class)->only(['index']);
            Route::resource('brand',  BrandController::class)->only(['index']);
            Route::resource('category',  CategoryController::class)->only('index');

            Route::resource('inventory',  InventoryController::class)->except(['edit','show','create']);
            Route::get('/receive', [InventoryTransferController::class, 'receive'])->name('inventory.receive');

            Route::resource('transfer', InventoryTransferController::class);

            //This 2 Might Get deleted soon waiting for confirmation
            Route::post('addimage/{id}', [ProductImageController::class,'addImages'])->name('add');
            Route::delete('/productimage/{id}', [ProductImageController::class,'removeImage']);

            Route::get('/product/archive', [ProductController::class,'ProductArchiveIndex'])->name('ProductArchiveIndex');
            Route::put('/product/archive/{id}', [ProductController::class, 'ProductArchiveRestore']);
            Route::delete('/product/archive/{id}', [ProductController::class, 'ProductArchiveDestroy']);
            Route::get('product/inventory_history/{id}',[ProductController::class, 'ProductInventoryHistory'])->name('ProductInventoryHistory');

            Route::resource('product',  ProductController::class);
            Route::resource('orders', OrderController::class)->only('index','show');
            Route::resource('chat', ChatController::class)->only('index');
            Route::resource('post', PostController::class)->only('index');
            Route::get('/supplier/archive', [SupplierController::class,'SupplierArchiveIndex'])->name('SupplierArchiveIndex');
            Route::resource('supplier', SupplierController::class);
            Route::get('/profile/changepassword', [ProfileController::class,'changepass'])->name('AdminChangePass');
            Route::post('/profile/changepassword', [ProfileController::class,'resetpass']);
            Route::resource('profile', ProfileController::class)->only('index');
            Route::resource('changepassword', ChangePasswordController::class)->only('index');
            Route::resource('analytics', AnalyticsController::class)->only('index');
            Route::resource('discount', DiscountController::class);
            

            Route::get('/report/totalsales/search',[ReportController::class,'searchDate'])->name('SearchDate');
            
            Route::get('/report/salesprod', [ReportController::class, 'salesProd'])->name('SalesProd');
            Route::get('/report/salesCustomer',[ReportController::class,'salesCustomer'])->name('SalesCustomer');
            Route::get('/report/totalsales',[ReportController::class,'totalSales'])->name('TotalSales');
            Route::get('/report/grosssales',[ReportController::class,'grossSales'])->name('GrossSales');
            Route::get('/report/grossprofit',[ReportController::class,'grossProfit'])->name('GrossProfit');
            
            Route::resource('report', ReportController::class);
            Route::resource('/', ReportController::class)->only('index');
            

            Route::get('/customer/archive',[CustomerController::class,'CustomerArchiveIndex'])->name('CustomerArchiveIndex');
            Route::resource('customer', CustomerController::class)->only('index','show');

            Route::get('/user/archive',[UsersController::class,'UserArchiveIndex'])->name('UserArchiveIndex');
            Route::resource('user', UsersController::class);
            Route::post('role/{role}/permissions',[RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('role/{role}/permissions/{permission}',[RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
            Route::resource('role', RoleController::class);
            Route::resource('permission', PermissionController::class)->only('index');

            
        });
    });
});

?>
