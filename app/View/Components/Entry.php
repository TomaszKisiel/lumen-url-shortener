<?php


namespace App\View\Components;

use Illuminate\View\Component;

/** @codeCoverageIgnore */
class Entry extends Component {


    /**
     * @var \App\Models\ShortLink
     */
    public $link;

    public function __construct( $link = null ) {
        $this->link = $link;
    }

    public function render() {
        return view( 'components.entry' );
    }
}
