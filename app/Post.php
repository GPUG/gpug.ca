<?php

namespace GPUG;

use Carbon\Carbon;
use GPUG\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class)->where('created_at', '>', Carbon::now()->subHours(2))->orderBy('created_at');
    }

    public function firstComment()
    {
        $relation =  $this->hasOne(Comment::class);

        $relation->getQuery()->select('comments.*')
            ->join(
                $relation->getQuery()->getQuery()->raw('(select post_id, min(created_at) as created_at from comments group by post_id) first_comments'),
                function ($join) {
                    $join->on('comments.post_id', '=', 'first_comments.post_id')
                        ->on('comments.created_at', '=', 'first_comments.created_at');
                }
        );

        return $relation;
    }
}
