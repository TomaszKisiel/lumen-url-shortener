<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Services\ConverterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ShortLinkController extends Controller {

    private $converter;

    public function __construct( ConverterService $converter ) {
        $this->converter = $converter;
    }

    public function __invoke( Request $request, string $link ) {
        $request->request->add( [ "short_link" => $link ] );

        try {
            $this->validate( $request, [
                "short_link" => [ "required", "alpha_num" ]
            ] );
        } catch ( ValidationException $e ) {
            return abort( 404 );
        }

        $link = ShortLink::find( $this->converter->toDec( $link ) );
        if ( ! $link ) {
            return abort( 404 );
        }

        $link->increment('visits');
        $link->save();

        return redirect( $link->original_url );
    }
}
