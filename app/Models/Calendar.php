<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Calendar extends Model
{
    protected $table = 'calendar';

    protected $fillable = [
        'sdate',
        'servid',
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'sdate' => 'date',
        'servid' => 'integer',
    ];

    public $timestamps = false;

    public function service()
    {
        return $this->belongsTo(Service::class, 'servid', 'id');
    }
}
