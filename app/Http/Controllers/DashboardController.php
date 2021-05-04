<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function index() {
        $links = ShortLink::where( 'hidden', '0' )->orderBy( 'created_at', 'desc' )->paginate( 10 );

        return view( 'pages.dashboard', [ "links" => $links ] );
    }

    public function store( Request $request ) {
        $this->validate( $request, [
            "url" => [ "required", "url" ],
            "hidden" => [ "nullable", "boolean" ]
        ] );

        $link = new ShortLink;
        $link->original_url = $request->get( "url" );
        $link->hidden = $request->get( "hidden" ) ?? false;
        $link->visits = 0;

        $latest = ShortLink::latest( 'created_at' )->first();
        if ( $latest ) {
            $link->id = $latest->id + rand( 2, 100 );
        }

        $link->save();

        return response()->json([
            "link" => $link->append(["duosexagesimal_id", "shorten_url"])
        ], 201);
    }
}
