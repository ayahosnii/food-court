<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales()
    {
        return view('admin.reports.sales_report');
    }

    public function lineChart()
    {
        return view('admin.reports.line_chart');
    }
}
