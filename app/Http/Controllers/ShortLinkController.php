<?php

namespace App\Http\Controllers;

use App\Services\ConverterService;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ShortLinkController extends Controller {

    private $converter;

    public function __construct( ConverterService $converter ) {
        $this->converter = $converter;
    }

    public function __invoke( Request $request, string $hash ) {
        $request->request->add( [ "hash" => $hash ] );

        try {
            $this->validate( $request, [
                "hash" => [ "required", "alpha_num" ]
            ] );
        } catch ( ValidationException $e ) {
            return abort( 404 );
        }

        $url = ShortLink::find( $this->converter->toDec( $hash ) );
        if ( ! $url ) {
            return abort( 404 );
        }

        $url->increment('visits');
        $url->save();

        return redirect( $url->url );
    }
}
