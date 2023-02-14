<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\PurchaseOrder;
class InventoryTransferController extends Controller
{
    public function index(){
        abort_if(Gate::denies('inventory_transfer'),403);
        return view('admin.page.product.inventorytransfer');
    }
    public function create(){
        abort_if(Gate::denies('inventory_transfer_create'),403);
        return view('admin.page.product.inventorytransferadd');
    }
    public function edit($id){
        $orderinfo = PurchaseOrder::findorfail($id);
        abort_if(Gate::denies('inventory_transfer_edit'),403);
        return view('admin.page.product.inventorytransferedit',[
            'orderinfos' => $orderinfo
        ]);
    }
    public function receive(){
        abort_if(Gate::denies('inventory_transfer_receive'),403);
        return view('admin.page.product.inventoryreceive');
    }
}
