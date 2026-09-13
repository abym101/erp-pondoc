<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\JournalEntry;

class LedgerController extends Controller
{
    public function index()
    {
        return JournalEntry::with(
            'account'
        )->latest()->get();
    }
}
