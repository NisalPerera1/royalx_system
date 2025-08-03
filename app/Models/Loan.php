<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UUID;

class Loan extends Model
{
    use HasFactory, UUID;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'client_id',
        'loan_amount',
        'total_amount',
        'daily_repayment',
        'duration_days',
        'start_date',
        'status',
        'notes',
    ];

    protected $dates = ['start_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function getTotalRepayableAttribute()
    {
        return $this->daily_repayment * $this->duration_days;
    }

    public function getProfitAttribute()
    {
        return $this->total_repayable - $this->loan_amount;
    }
}
