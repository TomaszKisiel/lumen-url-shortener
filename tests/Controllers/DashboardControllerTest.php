<?php

namespace Controllers;

use App\Models\ShortLink;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

/** @covers \App\Http\Controllers\DashboardController */
class DashboardControllerTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function show_view_with_paginated_short_links() {
        /** given */
        ShortLink::factory()->count( 20 )->create();

        /** when */
        $response = $this->call('GET', '/' );

        /** expected */
        $this->assertEquals( 200, $response->status() );

        $this->assertStringContainsString('<div id="entries">', $response->content());
        $this->assertStringContainsString('<ul class="pagination">', $response->content());
    }

    /** @test */
    public function short_link_can_be_created_with_valid_data() {
        /** when */
        $firstResponse = $this->call( 'POST', '/', [
            'url' => 'https://tkisiel.pl'
        ] );
        $secondResponse = $this->call( 'POST', '/', [
            'url' => 'https://tkisiel.pl',
            'hidden' => true
        ] );

        /** expected */
        $this->assertEquals( 201, $firstResponse->status() );
        $this->assertEquals( 201, $secondResponse->status() );

        $this->assertCount( 2, ShortLink::all() );
    }

    /** @test */
    public function short_link_cannot_be_created_with_invalid_data() {
        /** when */
        $firstResponse = $this->call( 'POST', '/', [
            'lurp' => 'https://tkisiel.pl'
        ] );
        $secondResponse = $this->call( 'POST', '/', [
            'url' => 'http...crash',
        ] );
        $thirdResponse = $this->call( 'POST', '/', [
            'hidden' => 'pfff_123'
        ] );

        /** expected */
        $this->assertEquals( 422, $firstResponse->status() );
        $this->assertEquals( 422, $secondResponse->status() );
        $this->assertEquals( 422, $thirdResponse->status() );

        $firstResponse->assertJsonValidationErrors( 'url', $responseKey = null );
        $secondResponse->assertJsonValidationErrors( 'url', $responseKey = null );
        $thirdResponse->assertJsonValidationErrors( 'url', $responseKey = null )
            ->assertJsonValidationErrors( 'hidden', $responseKey = null );

        $this->assertCount( 0, ShortLink::all() );
    }

    /** @test */
    public function link_in_response_after_creation_has_all_properties() {
        /** when */
        $firstResponse = $this->call( 'POST', '/', [
            'url' => 'https://tkisiel.pl'
        ] );

        /** expected */
        $this->assertArrayHasKey( "id", $link = $firstResponse[ "link" ] );
        $this->assertArrayHasKey( "duosexagesimal_id", $link );
        $this->assertArrayHasKey( "original_url", $link );
        $this->assertArrayHasKey( "shorten_url", $link );
        $this->assertArrayHasKey( "visits", $link );
        $this->assertArrayHasKey( "hidden", $link );
    }

    /** @test */
    public function link_in_response_after_creation_has_correct_properties() {
        /** when */
        $firstResponse = $this->call( 'POST', '/', [
            'url' => 'https://tkisiel.pl'
        ] );

        $link = $firstResponse[ "link" ];

        /** expected */
        $this->assertEquals( 250000, $link[ 'id' ] );
        $this->assertEquals( '132g', $link[ 'duosexagesimal_id' ] );
        $this->assertEquals( 'https://tkisiel.pl', $link[ 'original_url' ] );
        $this->assertEquals( config( 'app.url' ) . '/132g', $link[ 'shorten_url' ] );
        $this->assertEquals( 0, $link[ 'visits' ] );
        $this->assertEquals( false, $link[ 'hidden' ] );
    }

    /**
     * @test
     * It also means that the ID of the link being created is randomly larger than
     * the previous one. Which makes it harder to guess the shortening of links.
     */
    public function links_ids_difference_is_grater_then_one() {
        /** given */
        $firstLink = ShortLink::factory()->create();

        /** when */
        $response = $this->call( 'POST', '/', [
            'url' => 'https://tkisiel.pl'
        ] );
        $secondLink = $response[ "link" ];

        /** expected */
        $this->assertTrue( $secondLink[ "id" ] - $firstLink->id > 1 );
    }

}
