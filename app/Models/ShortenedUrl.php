<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortenedUrl extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['original_url', 'short_code', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Generate a unique short code for the shortened URL.
     *
     * @return string
     */
    public static function generateUniqueShortCode()
    {
        do {
            $shortCode = Str::random(6); 
        } while (static::where('short_code', $shortCode)->exists());

        return $shortCode;
    }
}
