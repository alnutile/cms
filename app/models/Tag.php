<?php

class Tag extends \Eloquent {

    public function posts()
    {
        return $this->morphedByMany('Post', 'tagable');
    }

    public function projects()
    {
        return $this->morphedByMany('Project', 'tagable');
    }

}