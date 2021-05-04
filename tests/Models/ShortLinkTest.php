<?php
namespace Models;

use App\Models\ShortLink;
use App\Services\ConverterService;
use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;

/** @covers \App\Models\ShortLink */
class ShortLinkTest extends TestCase {

    use DatabaseMigrations;

    /** @test */
    public function has_duosexagesimal_id_attribute() {
        /** given */
        $link = ShortLink::factory()->create(['original_url' => 'https://tkisiel.pl']);

        /** expected */
        $this->assertEquals(
            ( new ConverterService() )->toDuosexagesimal( $link->id ),
            $link->duosexagesimal_id
        );
    }

    /** @test */
    public function has_shorten_url_attribute() {
        /** given */
        $link = ShortLink::factory()->create(['original_url' => 'https://tkisiel.pl']);

        /** expected */
        $this->assertEquals(
            config('app.url') . '/' .( new ConverterService() )->toDuosexagesimal( $link->id ),
            $link->shorten_url
        );
    }
}
