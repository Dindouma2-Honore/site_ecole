<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        $childrenIds = Auth::user()->children()->pluck('learners.id');

        $invoices = Invoice::with(['learner', 'payments'])
            ->whereIn('learner_id', $childrenIds)
            ->orderBy('due_date', 'desc')
            ->get();

        return view('parent.finances', compact('invoices'));
    }
}
