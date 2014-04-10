<?php

class Page extends \Eloquent {
    protected $fillable = [];

    public function getAll()
    {
        $pages = Page::where("published", '=', '1')->get();
    }
}