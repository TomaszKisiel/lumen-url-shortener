<?php

namespace Controllers;

use App\Models\ShortLink;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

/** @covers \App\Http\Controllers\ShortLinkController */
class ShortLinkControllerTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function can_handle_all_http_method() {
        /** given */
        $link = ShortLink::factory()->create( [ 'original_url' => 'https://tkisiel.pl' ] );

        /** when */
        $getResponse = $this->get( $link->shorten_url );
        $postResponse = $this->post( $link->shorten_url );
        $putResponse = $this->put( $link->shorten_url );
        $patchResponse = $this->patch( $link->shorten_url );
        $deleteResponse = $this->delete( $link->shorten_url );
        $headResponse = $this->head( $link->shorten_url );
        $optionsResponse = $this->options( $link->shorten_url );

        /** expected */
        $getResponse->assertResponseStatus( 302 );
        $postResponse->assertResponseStatus( 302 );
        $putResponse->assertResponseStatus( 302 );
        $patchResponse->assertResponseStatus( 302 );
        $deleteResponse->assertResponseStatus( 302 );
        $headResponse->assertResponseStatus( 302 );
        $optionsResponse->assertResponseStatus( 302 );
    }

    /** @test */
    public function give_404_for_wrong_formatted_short() {
        /** when */
        $getResponse = $this->get( "/ab___cd" );

        /** expected */
        $getResponse->assertResponseStatus( 404 );
    }


    /** @test */
    public function give_404_for_non_existent_short_link() {
        /** when */
        $postResponse = $this->post( '/ABCD' );

        /** expected */
        $postResponse->assertResponseStatus( 404 );
    }

    /** @test */
    public function visits_counter_increase_after_shorten_link_use() {
        /** given */
        $link = ShortLink::factory()->create( [ 'original_url' => 'https://tkisiel.pl', 'visits' => 0 ] );

        /** when */
        $this->put( $link->shorten_url );
        $this->patch( $link->shorten_url );

        /** expected */
        $this->assertEquals( 2, ShortLink::find( $link->id )->visits );
    }
}
