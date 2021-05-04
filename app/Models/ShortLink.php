<?php

namespace App\Models;

use App\Services\ConverterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model {

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

    public function getDuosexagesimalIdAttribute( ) {
        return ( new ConverterService() )->toDuosexagesimal( $this->id );
    }

    public function getShortenAttribute( ) {
        return config('app.url' ) . '/' . ( new ConverterService() )->toDuosexagesimal( $this->id );
    }

}
