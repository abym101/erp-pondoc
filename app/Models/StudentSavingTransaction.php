<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StudentSavingTransaction extends Model
{
    protected $fillable = [
        'student_saving_id',
        'transaction_date',
        'type',
        'amount',
        'description'
    ];
}
