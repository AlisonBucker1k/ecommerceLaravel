<?php

namespace App;

use App\Enums\GridVariationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GridVariation extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'status', 'grid_id'];

    protected $dates = ['deleted_at'];

    public function getStatusDescriptionAttribute()
    {
        return GridVariationStatus::getDescription($this->status);
    }

    public function grid()
    {
        return $this->belongsTo('App\Grid');
    }
}
