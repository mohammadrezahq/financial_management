<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)
            ->where('user_id', auth()->id());
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
