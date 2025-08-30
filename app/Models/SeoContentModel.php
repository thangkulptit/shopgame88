<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoContentModel extends Model
{
    protected $table = 'seo_content';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'description', 'domain', 'keywords', 'content_seo', 'title_h2', 'title_h3'
    ];
}
