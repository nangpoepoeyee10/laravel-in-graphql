<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
     protected $fillable = [
        'post_id',  // Add this
        'content',  // Add this
        'user_id', // Add this
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
