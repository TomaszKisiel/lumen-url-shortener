<?php

namespace App\Http\Controllers;

use App\Actions\UrlConverter;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ConverterController extends Controller {

    private $converter;

    public function __construct( UrlConverter $converter ) {
        $this->converter = $converter;
    }

    public function __invoke( Request $request, string $dec ) {
        $request->request->add( [ "dec" => $dec ] );

        try {
            $this->validate( $request, [
                "dec" => [ "required", "integer" ]
            ] );
        } catch ( ValidationException $e ) {
            return abort( 404 );
        }

        return $this->converter->toHash( $dec );
    }
}
