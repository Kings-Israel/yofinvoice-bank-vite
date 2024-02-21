<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
  public function showForgotPasswordForm(Bank $bank)
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.forgot-password', ['pageConfigs' => $pageConfigs, 'bank' => $bank]);
  }
}
