<?php
// classes.php
class Movie {
    public $title;
    public $poster_url;
    public $days_until;
    public $release_date;
    public $following_production;

    public function __construct($title, $poster_url, $days_until, $release_date, $following_production = null) {
        $this->title = $title;
        $this->poster_url = $poster_url;
        $this->days_until = $days_until;
        $this->release_date = $release_date;
        $this->following_production = $following_production;
    }
}
