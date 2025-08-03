<?php

namespace App\Models;
use App\Traits\UUID;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory,UUID;
    protected $fillable = [
        'name',
        'contact',
        'address',
        'id_proof',
        'id_proof_file',
        'guarantor',
    ];

   public function loans() {
    return $this->hasMany(Loan::class);
}

}

