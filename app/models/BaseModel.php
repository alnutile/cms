<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 5/16/14
 * Time: 5:55 AM
 */

class BaseModel extends \Eloquent {

    public function scopePublished($query)
    {
        return $query->where("published", "=", 1);
    }

    public function scopeOrderByOrder($query)
    {
        return $query->orderBy('order');
    }
} 