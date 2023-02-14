<?php

namespace App\Http\Controllers\Backend\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class ChatController extends Controller
{
    //Show Transaction Page
    public function index(){
        abort_if(Gate::denies('chat_access'),403);
        return view('admin.page.Transaction.chat');
    }
}
