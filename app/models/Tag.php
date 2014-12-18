<?php

class Tag extends \Eloquent {


    public function projects()
    {
        return $this->belongsToMany('Project');
    }

}