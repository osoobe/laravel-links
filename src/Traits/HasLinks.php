<?php


namespace Osoobe\Linkable\Traits;

trait HasLinks {

    /**
     * Get all of the object's links.
     */
    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }
    
}


?>