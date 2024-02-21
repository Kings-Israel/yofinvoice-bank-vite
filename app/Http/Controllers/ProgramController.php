<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Bank;
use App\Models\Company;
use App\Models\ProgramCompanyRole;
use App\Models\ProgramRole;
use App\Models\ProgramType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
  public function index(Bank $bank, $status = NULL)
  {
    $programs = Program::with('programType', 'programCode')
                ->where('bank_id', $bank->id)
                ->when($status && $status != NULL, function ($query) use ($status) {
                  $query->where('account_status', $status);
                })
                ->get();

    foreach ($programs as $program) {
      $program['anchor'] = $program->getAnchor();
      $program['vendors'] = $program->getVendors();
    }

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $programs,
      ], 200);
    }

    $pending_programs = $programs->where('account_status', 'pending');

    return view('content.programs.index', [
      'bank' => $bank,
      'programs' => $programs,
      'pending_programs' => $pending_programs
    ]);
  }

  public function create(Bank $bank)
  {
    $companies = Company::where('bank_id', $bank->id)
                        ->where('approval_status', 'approved')
                        ->get();

    $program_types = ProgramType::with('programCodes')->get();

    $reset_frequencies = [
      'Daily' => 1,
      'Monthly' => 30,
      'Quarterly' => 90,
      'Half Annually' => 180,
      'Annually' => 365
    ];

    $benchmark_rates = [
      'Benchmark Rate 1' => 2,
      'Benchmark Rate 2' => 3,
      'Benchmark Rate 3' => 6,
    ];

    $taxes = [
      'VAT (16%)',
      'Withholding Vat (2%)'
    ];

    return view('content.bank.programs.create', [
      'bank' => $bank,
      'companies' => $companies,
      'program_types' => $program_types,
      'reset_frequencies' => $reset_frequencies,
      'benchmark_rates' => $benchmark_rates,
      'taxes' => $taxes,
    ]);
  }

  public function store(Request $request, Bank $bank)
  {
    $request->validate([
      'program_type_id' => ['required'],
      'name' => ['required'],
      'anchor_id' => ['required'],
      'eligibility' => ['required', 'integer', 'max:100'],
      'credit_spread' => ['required', 'integer', 'max:100'],
      'benchmark_rate' => ['required', 'integer', 'max:100'],
      // 'fee_names' => ['nullable', 'array'],
      // 'fee_names.*' => ['nullable', 'string'],
      // 'fee_types' => ['nullable', 'array'],
      // 'fee_types.*' => ['nullable', 'string'],
      // 'fee_values' => ['nullable', 'array'],
      // 'fee_values.*' => ['nullable', 'integer'],
      // 'fee_anchor_bearing_discount' => ['nullable', 'array'],
      // 'fee_anchor_bearing_discount.*' => ['nullable', 'integer'],
      // 'fee_vendor_bearing_discount' => ['nullable', 'array'],
      // 'fee_vendor_bearing_discount.*' => ['nullable', 'integer'],
    ], [
      'program_type_id' => ['Selecct program type'],
      'name' => 'Enter Program Name',
      'eligibility' => 'Enter Program Invoice Eligibility',
    ]);

    try {
      DB::beginTransaction();

      $program = $bank->programs()->create([
        'name' => $request->name,
        'program_type_id' => $request->program_type_id,
        'program_code_id' => $request->has('program_code_id') && !empty($request->program_code_id) ? $request->program_code_id : NULL,
        'eligibility' => $request->eligibility,
        'code' => 'PR-'.$bank->name.''.time(),
        'invoice_margin' => $request->invoice_margin,
        'program_limit' => $request->program_limit,
        'approved_date' => Carbon::parse($request->approved_date)->format('Y-m-d'),
        'limit_expiry_date' => Carbon::parse($request->limit_expiry_date)->format('Y-m-d'),
        'max_limit_per_account' => $request->max_limit_per_account,
        'collection_account' => $request->collection_account,
        'request_auto_finance' => $request->request_auto_finance,
        'stale_invoice_period' => $request->stale_invoice_period,
        'min_financing_days' => $request->min_financing_days,
        'max_financing_days' => $request->max_financing_days,
        'segment' => $request->segment,
        'auto_debit_anchor_financed_invoices' => $request->auto_debit_anchor_financed_invoices,
        'auto_debit_anchor_non_financed_invoices' => $request->auto_debit_anchor_non_financed_invoices,
        'anchor_can_change_due_date' => $request->anchor_can_change_due_date,
        'max_days_due_date_extension' => $request->max_days_due_extension,
        'days_limit_for_due_date_change' => $request->days_limit_for_due_date_change,
        'default_payment_terms' => $request->default_payment_terms,
        'anchor_can_change_payment_term' => $request->anchor_can_change_payment_term,
        'repayment_appropriation' => $request->repayment_appropriation,
        'mandatory_invoice_attachment' => $request->mandatory_invoice_attachment,
        'partner' => $request->partner,
        'recourse' => $request->recourse,
        'due_date_calculated_from' => $request->due_date_calculated_from,
        'noa' => $request->noa,
        'account_status' => $request->account_status,
      ]);

      $program->discountDetails()->create([
        'benchmark_title' => $request->benchmark_title,
        'benchmark_rate' => $request->benchmark_rate,
        'reset_frequency' => $request->reset_frequency,
        'days_frequency_days' => $request->days_frequency_days,
        'business_strategy_spread' => $request->business_strategy_spread,
        'credit_spread' => $request->credit_spread,
        'total_spread' => $request->total_spread,
        'total_roi' => $request->total_roi,
        'anchor_discount_bearing' => $request->anchor_discount_bearing,
        'vendor_discount_bearing' => $request->vendor_discount_bearing,
        'discount_type' => $request->discount_type,
        'penal_discount_on_principle' => $request->penal_discount_on_principle,
        'anchor_fee_recovery' => $request->anchor_fee_recovery,
        'grace_period' => $request->grace_period,
        'grace_period_discount' => $request->grace_period_discount,
        'maturity_handling_on_holidays' => $request->maturity_handling_on_holidays,
      ]);

      if ($request->has('fee_names') && !empty($request->fee_names[0]) && count($request->fee_names) > 0 && $request->has('fee_types') && !empty($request->fee_types[0]) && count($request->fee_types) > 0 && $request->has('fee_values') && !empty($request->fee_values[0]) && count($request->fee_values) > 0) {
        foreach ($request->fee_names as $key => $value) {
          $program->fees()->create([
            'fee_name' => $value,
            'type' => $request->fee_types[$key],
            'value' => $request->fee_values[$key],
            'anchor_bearing_discount' => array_key_exists($key, $request->fee_anchor_bearing_discount) ? $request->fee_anchor_bearing_discount[$key] : NULL,
            'vendor_bearing_discount' => array_key_exists($key, $request->fee_vendor_bearing_discount) ? $request->fee_vendor_bearing_discount[$key] : NULL,
            'taxes' => array_key_exists($key, $request->taxes) ? $request->taxes[$key] : NULL,
          ]);
        }
      }

      if ($request->has('anchor_emails') && !empty($request->anchor_emails[0]) && count($request->anchor_emails) > 0 && $request->has('anchor_phone_numbers') && !empty($request->anchor_phone_numbers[0]) && count($request->anchor_phone_numbers) > 0) {
        foreach ($request->anchor_emails as $key => $value) {
          $program->anchorDetails()->create([
            'email' => $value,
            'phone_number' => array_key_exists($key, $request->anchor_phone_numbers) ? $request->anchor_phone_numbers[$key] : NULL
          ]);
        }
      }

      if ($request->has('bank_user_emails') && !empty($request->bank_user_emails[0]) && count($request->bank_user_emails) > 0 && $request->has('bank_user_phone_numbers') && !empty($request->bank_user_phone_numbers[0]) && count($request->bank_user_phone_numbers) > 0) {
        foreach ($request->bank_user_emails as $key => $value) {
          $program->bankUserDetails()->create([
            'email' => $value,
            'name' => array_key_exists($key, $request->bank_user_nammes) ? $request->bank_user_nammes[$key] : NULL,
            'phone_number' => array_key_exists($key, $request->bank_user_phone_numbers) ? $request->bank_user_phone_numbers[$key] : NULL
          ]);
        }
      }

      if ($request->has('bank_names_as_per_banks') && !empty($request->bank_names_as_per_banks[0]) && count($request->bank_names_as_per_banks) > 0 && $request->has('account_numbers') && !empty($request->account_numbers[0]) && count($request->account_numbers) > 0 && $request->has('bank_names') && !empty($request->bank_names[0]) && count($request->bank_names) > 0) {
        foreach ($request->bank_names_as_per_banks as $key => $value) {
          $program->bankDetails()->create([
            'name_as_per_bank' => $value,
            'account_number' => array_key_exists($key, $request->account_numbers) ? $request->account_numbers[$key] : NULL,
            'bank_name' => array_key_exists($key, $request->bank_names) ? $request->bank_names[$key] : NULL,
            'branch' => array_key_exists($key, $request->branches) ? $request->branches[$key] : NULL,
            'swift_code' => array_key_exists($key, $request->swift_codes) ? $request->swift_codes[$key] : NULL,
            'account_type' => array_key_exists($key, $request->account_types) ? $request->account_types[$key] : NULL,
          ]);
        }
      }

      $anchor_role = ProgramRole::where('name', 'anchor')->first();

      ProgramCompanyRole::create([
        'program_id' => $program->id,
        'company_id' => $request->anchor_id,
        'role_id' => $anchor_role->id
      ]);

      DB::commit();

      toastr()->success('', 'Program created successfully.');

      return redirect()->route('programs.index', ['bank' => $bank]);
    } catch (\Throwable $th) {
      info($th);
      DB::rollback();
      toastr()->error('', 'An error occurred while creating the program.');
      return back();
    }
  }

  public function show(Bank $bank, Program $program)
  {
    $program['anchor'] = $program->getAnchor();
    $program['vendors'] = $program->getVendors();

    if (request()->wantsJson()) {
      return response()->json(['data' => $program]);
    }

    return view('content.bank.programs.show', ['bank' => $bank, 'program' => $program]);
  }

  public function updateStatus(Request $request, Bank $bank, Program $program, string $status)
  {
    $program->update([
      'account_status' => $status
    ]);

    toastr()->success('', 'Program status updated successfully');

    return back();
  }

  public function showMapVendor(Bank $bank, Program $program)
  {
    $anchor = $program->getAnchor();
    $vendors = $program->getVendors();
    $companies = $bank->companies;
    $companies = $companies->filter(function ($company) use ($anchor, $vendors) {
      $vendors_ids = $vendors->pluck('id');
      return $company->id != $anchor->id && !collect($vendors_ids)->contains($company->id);
    });

    $program->load('discountDetails');

    $reset_frequencies = [
      'Daily' => 1,
      'Monthly' => 30,
      'Quarterly' => 90,
      'Half Annually' => 180,
      'Annually' => 365
    ];

    $benchmark_rates = [
      'Benchmark Rate 1' => 2,
      'Benchmark Rate 2' => 3,
      'Benchmark Rate 3' => 6,
    ];

    $taxes = [
      'VAT (16%)',
      'Withholding Vat (2%)'
    ];

    return view('content.programs.vendors.map', compact('bank', 'program', 'companies', 'reset_frequencies', 'benchmark_rates', 'taxes'));
  }

  public function mapVendor(Request $request, Bank $bank, Program $program)
  {
    $request->validate([
      'vendor_id' => ['required'],
    ]);

    // TODO: Add check to make sure vendor is not already mapped to the program

    try {
      DB::beginTransaction();

      $vendor = Company::find($request->vendor_id);

      $vendor_role = ProgramRole::where('name', 'vendor')->first();

      ProgramCompanyRole::create([
        'program_id' => $program->id,
        'company_id' => $request->vendor_id,
        'role_id' => $vendor_role->id
      ]);

      $vendor->programConfigurations()->create([
        'program_id' => $program->id,
        'payment_account_number' => $request->payment_account_number,
        'sanctioned_limit' => $request->sanctioned_limit,
        'limit_approved_date' => $request->limit_approved_date,
        'limit_expiry_date' => $request->limit_expiry_date,
        'limit_review_date' => $request->limit_review_date,
        'drawing_power' => $request->drawing_power,
        'request_auto_finance' => $request->request_auto_finance,
        'auto_approve_finance' => $request->auto_approve_finance,
        'eligibility' => $request->eligibility,
        'invoice_margin' => $request->invoice_margin,
        'schema_code' => $request->schema_code,
        'product_description' => $request->product_description,
        'vendor_code' => $request->vendor_code,
        'gst_number' => $request->gst_number,
        'classification' => $request->classification,
        'tds' => $request->tds,
        'status' => $request->status
      ]);

      $vendor->programDiscountDetails()->create([
        'program_id' => $program->id,
        'benchmark_title' => $request->benchmark_title,
        'benchmark_rate' => $request->benchmark_rate,
        'reset_frequency' => $request->reset_frequency,
        'days_frequency_days' => $request->days_frequency_days,
        'business_strategy_spread' => $request->business_strategy_spread,
        'credit_spread' => $request->credit_spread,
        'total_spread' => $request->total_spread,
        'total_roi' => $request->total_roi,
        'anchor_discount_bearing' => $request->anchor_discount_bearing,
        'vendor_discount_bearing' => $request->vendor_discount_bearing,
        'penal_discount_on_principle' => $request->penal_discount_on_principle,
        'grace_period' => $request->grace_period,
        'grace_period_discount' => $request->grace_period_discount,
        'maturity_handling_on_holidays' => $request->maturity_handling_on_holidays,
      ]);

      if ($request->has('fee_names') && !empty($request->fee_names[0]) && count($request->fee_names) > 0 && $request->has('fee_types') && !empty($request->fee_types[0]) && count($request->fee_types) > 0 && $request->has('fee_values') && !empty($request->fee_values[0]) && count($request->fee_values) > 0) {
        foreach ($request->fee_names as $key => $value) {
          $vendor->programFeeDetails()->create([
            'program_id' => $program->id,
            'fee_name' => $value,
            'type' => array_key_exists($key, $request->fee_types) ? $request->fee_types[$key] : NULL,
            'value' => array_key_exists($key, $request->fee_values) ? $request->fee_values[$key] : NULL,
            'anchor_bearing_discount' => array_key_exists($key, $request->fee_anchor_bearing_discount) ? $request->fee_anchor_bearing_discount[$key] : NULL,
            'vendor_bearing_discount' => array_key_exists($key, $request->fee_vendor_bearing_discount) ? $request->fee_vendor_bearing_discount[$key] : NULL,
            'taxes' => array_key_exists($key, $request->taxes) ? $request->taxes[$key] : NULL,
          ]);
        }
      }

      if ($request->has('vendor_emails') && !empty($request->vendor_emails[0]) && count($request->vendor_emails) > 0 && $request->has('vendor_phone_numbers') && !empty($request->vendor_phone_numbers[0]) && count($request->vendor_phone_numbers) > 0) {
        foreach ($request->vendor_emails as $key => $value) {
          $vendor->programContactDetails()->create([
            'program_id' => $program->id,
            'email' => $value,
            'phone_number' => array_key_exists($key, $request->vendor_phone_numbers) ? $request->vendor_phone_numbers[$key] : NULL,
          ]);
        }
      }

      if ($request->has('bank_names_as_per_banks') && !empty($request->bank_names_as_per_banks[0]) && count($request->bank_names_as_per_banks) > 0 && $request->has('account_numbers') && !empty($request->account_numbers[0]) && count($request->account_numbers) > 0 && $request->has('bank_names') && !empty($request->bank_names[0]) && count($request->bank_names) > 0) {
        foreach ($request->bank_names_as_per_banks as $key => $value) {
          $vendor->programBankDetails()->create([
            'program_id' => $program->id,
            'name_as_per_bank' => $value,
            'account_number' => array_key_exists($key, $request->account_numbers) ? $request->account_numbers[$key] : NULL,
            'bank_name' => array_key_exists($key, $request->bank_names) ? $request->bank_names[$key] : NULL,
            'branch' => array_key_exists($key, $request->branches) ? $request->branches[$key] : NULL,
            'swift_code' => array_key_exists($key, $request->swift_codes) ? $request->swift_codes[$key] : NULL,
            'account_type' => array_key_exists($key, $request->account_types) ? $request->account_types[$key] : NULL,
          ]);
        }
      }

      DB::commit();

      toastr()->success('', 'Vendor mapped successfully.');

      return redirect()->route('programs.show', ['bank' => $bank, 'program' => $program]);
    } catch (\Throwable $th) {
      info($th);
      DB::rollback();
      toastr()->error('', 'An error occurred while creating the program.');
      return back();
    }
  }
}
