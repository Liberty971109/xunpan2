<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'site_name',
    ];
    
    protected $casts = [
        'site_info' => 'json',
    ];

    public function ask(){
        return $this->hasMany(Ask::class);
    }
}
