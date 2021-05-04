<?php


namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component {

    public $author;
    public $year;

    public function __construct($author = "", $year = null) {
        $this->author = $author;
        $this->year = $year ?? date('Y');
    }

    public function render() {
        return view( 'components.footer' );
    }
}
