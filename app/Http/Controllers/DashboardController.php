<?php

namespace App\Http\Controllers;

use App\Services\ConverterService;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class DashboardController extends Controller {

    public function index() {
        $urls = ShortLink::where( 'hidden', '0' )->orderBy( 'created_at', 'desc' )->paginate( 10 );

        return view( 'pages.home', [ "urls" => $urls ] );
    }

    public function store( Request $request ) {
        $this->validate( $request, [
            "url" => [ "required", "url" ],
            "hidden" => [ "nullable" ]
        ] );

        $url = ShortLink::make( [
            "url" => $request->get( "url" ),
            "hidden" => $request->get( "hidden" )
        ] );

        $latest = ShortLink::latest( 'created_at' )->first();
        if ( $latest ) {
            $url->id = $latest->id + rand( 1, 100 );
            $url->save();
        }

        return response()->json([ "url" => ShortLink::find( $url->id )->append(["shorten", "hash"]) ], 201);
    }
}
