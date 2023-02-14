<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class AnalyticsController extends Controller
{
    //Show Analytics Page
    public function index(){
        abort_if(Gate::denies('analytics_access'),403);
        return view('admin.page.Report.analytics');
    }
}
