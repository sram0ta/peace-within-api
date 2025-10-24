<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalendarDate extends Model
{
    protected $table = 'dates';
    protected $fillable = ['title','value'];

    public function tasks(): HasMany {
        return $this->hasMany(Task::class, 'date_id');
    }
}
