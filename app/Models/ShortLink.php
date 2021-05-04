<?php

namespace App\Models;

use App\Services\ConverterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where( string $string, string $string1 )
 * @method static latest( string $string )
 * @method static find( float|int $toDec )
 */
class ShortLink extends Model {

    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'original_url', 'visits', 'hidden'
    ];

    protected $casts = [
        'hidden' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function getDuosexagesimalIdAttribute( ) {
        return ( new ConverterService() )->toDuosexagesimal( $this->id );
    }

    public function getShortenUrlAttribute( ) {
        return config('app.url' ) . '/' . ( new ConverterService() )->toDuosexagesimal( $this->id );
    }

}
