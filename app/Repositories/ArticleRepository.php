<?php
/**
 * Created by PhpStorm.
 * User: zm
 * Date: 2017/7/22
 * Time: 15:35
 */
namespace App\Repositories;

use App\Tag;
use Cache;
use App\Article;

class ArticleRepository
{




    public function byId($id)
    {
        return Article::find($id);
    }

    public function normalizeTopics($tags)
    {
        return collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                Tag::find($tag)->increment('articles_count');
                return (int)$tag;
            }
            $newTag = Tag::create(['name' => $tag, 'articles_count' => 1]);
            return $newTag->id;
        })->toArray();
    }

    public function create(array $attributes)
    {
        return Article::create($attributes);
    }

}