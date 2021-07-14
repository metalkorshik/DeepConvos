<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class BankDetails extends Model
{
    use AsSource, HasFactory, Filterable;

    public $timestamps = false;

    protected $table = 'users_bank_details';

    protected $fillable = [
        'card_number', 'card_owner', 'card_validity', 'cvv', 'is_verified', 'user_id'
    ];

    protected $allowedFilters = [
        'card_number', 'card_owner', 'card_validity'
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
