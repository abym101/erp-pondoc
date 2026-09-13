<?php
namespace App\Http\Controllers\Workshop;
use App\Http\Controllers\Controller;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index()
    {
        return view(
            'customers.index',
            [
                'customers'=>Customer::latest()->get()
            ]
        );
    }
}
