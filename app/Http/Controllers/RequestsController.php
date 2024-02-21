<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
  public function reverseFactoring(Bank $bank)
  {
    return view('content.requests.vendor-financing');
  }

  public function factoring(Bank $bank)
  {
    return view('content.requests.factoring');
  }

  public function requests(Bank $bank)
  {
    return view('content.requests.payment-requests');
  }
}
