<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Calendar;
use App\Models\ResDem;


class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'wtype',
        'description',
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'wtype' => 'string',
        'description' => 'string',
    ];

    public $timestamps = false;

    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'servid', 'id');
    }

    public function resdems()
    {
        return $this->hasMany(ResDem::class, 'servid', 'id');
    }
}
