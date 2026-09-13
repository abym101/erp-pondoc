<?php
namespace App\Http\Controllers\ERP;
use App\Http\Controllers\Controller;
use App\Models\Donation;
class DonationController extends Controller{
public function index(){
return response()->json([
'total_donation'=>Donation::sum('amount'),
'rows'=>Donation::count()
]);
}}
