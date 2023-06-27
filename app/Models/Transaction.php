<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'description',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWhereThisMonth($query)
    {
        return $query->whereDate('created_at', '>=', verta()->startMonth()->formatGregorian('Y-n-j H:i:s'));
    }
}
