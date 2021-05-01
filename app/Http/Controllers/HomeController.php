<?php

namespace App\Http\Controllers;

use App\Actions\UrlConverter;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class HomeController extends Controller {

    public function index() {
        $urls = Url::where( 'hidden', '0' )->orderBy( 'created_at', 'desc' )->paginate( 10 );

        return view( 'pages.home', [ "urls" => $urls ] );
    }

    public function store( Request $request ) {
        $this->validate( $request, [
            "url" => [ "required", "url" ],
            "hidden" => [ "nullable" ]
        ] );

        $url = Url::make( [
            "url" => $request->get( "url" ),
            "hidden" => $request->get( "hidden" )
        ] );

        $latest = Url::latest( 'created_at' )->first();
        if ( $latest ) {
            $url->id = $latest->id + rand( 1, 100 );
            $url->save();
        }

        return response()->json([ "url" => Url::find( $url->id )->append(["shorten", "hash"]) ], 201);
    }
}
