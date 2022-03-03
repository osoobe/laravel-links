<?php


namespace Osoobe\Linkable\Traits;

use Osoobe\Linkable\Models\Link;

trait HasLinks {

    /**
     * Get all of the object's links.
     */
    public function links()
    {
        return $this->morphMany(config('links.link_model', Link::class), 'linkable');
    }

}


?>
