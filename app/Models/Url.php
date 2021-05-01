<?php

namespace App\Models;

use App\Actions\UrlConverter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'url', 'visits', 'hidden'
    ];

    protected $casts = [
        'hidden' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function getHashAttribute( ) {
        return ( new UrlConverter() )->toHash( $this->id );
    }

    public function getShortenAttribute( ) {
        return config('app.url' ) . '/' . ( new UrlConverter() )->toHash( $this->id );
    }

}
