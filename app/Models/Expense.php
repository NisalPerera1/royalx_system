<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',    // e.g. salary, rent, marketing
        'amount',
        'expense_date',
        'note',
    ];
}
