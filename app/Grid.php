<?php

namespace App;

use App\Enums\GridStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grid extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'status'];

    protected $dates = ['deleted_at'];

    public function getStatusDescriptionAttribute()
    {
        return GridStatus::getDescription($this->status);
    }

    public function activeGrids()
    {
        return $this->query()->where('status', GridStatus::ACTIVE)->get();
    }

    public function variations()
    {
        return $this->hasMany('App\GridVariation');
    }
}
