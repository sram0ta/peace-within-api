<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['user_id','title','repeat','date_id'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function date(): BelongsTo {
        return $this->belongsTo(CalendarDate::class, 'date_id');
    }
}
