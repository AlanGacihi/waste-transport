<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ResDem extends Model
{
    protected $table = 'resdems';

    protected $fillable = [
        'user_id',
        'demand',
        'servid',
        'quantity',
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'demand' => 'date',
        'servid' => 'integer',
        'quantity' => 'integer',
    ];

    public $timestamps = false;

    public function service()
    {
        return $this->belongsTo(Service::class, 'servid', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
