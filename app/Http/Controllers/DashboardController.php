<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Bank $bank)
  {
    return view('content.dashboard', compact('bank'));
  }
}
