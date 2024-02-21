<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
  public function index()
  {
    $reports = [
      'All Payment Reports',
      'Final RTR Report',
      'Loans Pending Approval Report',
      'Loan Pending Disbursal Report',
      'Maturing Payment Report',
      'Maturity Extended Report',
      'Payment Report',
      'Rejected Loans Report',
      'Trial Balance Report',
      'User ID Maintenance Report',
      'Vendor\'s Daily Outstanding Balance',
      'DF - Anchorwise Dealer Report',
    ];

    return view('content.reports.index', ['reports' => $reports]);
  }

  public function ledger()
  {
    return view('content.reports.ledger');
  }
}
