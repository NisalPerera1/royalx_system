<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UUID;

class Repayment extends Model
{
    use HasFactory,UUID;

    protected $fillable = [
        'loan_id',
        'payment_date',
        'amount',
        'is_late',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function repayments()
{
    return $this->hasMany(Repayment::class);
}

public function getTotalPaidAttribute()
{
    return $this->repayments()->sum('amount');
}

public function getRemainingAmountAttribute()
{
    return ($this->amount + ($this->amount * $this->interest / 100)) - $this->total_paid;
}

public function getIsFullyPaidAttribute()
{
    return $this->remaining_amount <= 0;
}

}
