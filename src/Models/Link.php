<?php

namespace Osoobe\Linkable\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Osoobe\LaravelTraits\Support\Active;
use Osoobe\LaravelTraits\Support\TimeDiff;
use Osoobe\LaravelTraits\Support\Userstamp;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Link extends Model
{
    use Active;
    use HasFactory;
    use HasSlug;
    use TimeDiff;
    use Timestamp;
    use Userstamp;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'url',
        'source',
        'linkable_id',
        'linkable_type',
        'country_id',
        'creator_id',
        'editor_id',
        'is_active'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


    /**
     * Get the parent linkable model (job).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function linkable()
    {
        return $this->morphTo();
    }


    /**
     * Get domain name
     *
     * @return string
     */
    public function getDomain() {
        $parse = parse_url($this->url);
        return $parse['host'];
    }

    /**
     * Get domain title from the domain name
     *
     * @return string
     */
    public function getDomainTitle($asHeadline=true) {
        $hostParts = explode('.', $this->getDomain());
        $hostParts = array_reverse($hostParts);
        $hostTitle = $hostParts[1];
        if ( $asHeadline ) {
            return Str::headline($hostTitle);
        }
        return $hostTitle;
    }

}
