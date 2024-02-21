<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Bank;
use App\Models\BankUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function showLoginForm(Bank $bank)
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login', ['pageConfigs' => $pageConfigs, 'bank' => $bank]);
  }

  public function login(LoginRequest $request, Bank $bank)
  {
    $request->authenticate();

    $request->session()->regenerate();

    $is_bank_user = BankUser::where(['user_id' => auth()->id(), 'bank_id' => $bank->id])->first();

    if(!$is_bank_user) {
      auth()->logout();

      toastr()->error('', 'Invalid Credentials');

      return redirect()->route('login', ['bank' => $bank])->withErrors('Invalid Credentials');
    }

    return redirect()->route('dashboard', ['bank' => $bank]);
  }

  public function destroy(Request $request, Bank $bank): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login', ['bank' => $bank]);
  }
}
