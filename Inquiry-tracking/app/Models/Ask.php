<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Renderable;

class Ask extends Model implements Renderable
{
    use HasFactory;
    protected $fillable = [
        'site_id',
        'message_name',
        'message',
        'sent_from',
        'sent_to',
        'location',
        'source',
        'rating',
        'note',
        'date_time',
        'message_info',
    ];

    protected $casts = [
        'message_info' => 'json',
    ];

    public function web(){
        return $this->belongsTo(Web::class);
    }

    public function render($key = null)
    {
        dump(Ask::find($key)->toArray());
    }
}
