<?php

namespace App\Support\Traits;

use willvincent\Rateable\Rating;

trait Rateable
{
    use \willvincent\Rateable\Rateable;

    public function rateOnce($value, $comment = null, $user_id = null)
    {
        $user_id = $this->byUser($user_id);
        $rating  = Rating::query()
            ->where('rateable_type', '=', $this->getMorphClass())
            ->where('rateable_id', '=', $this->id)
            ->where('user_id', '=', $user_id)
            ->first();

        if ($rating) {
            $rating->rating  = $value;
            $rating->comment = $comment;
            $rating->ip      = request()->ip();
            $rating->agent   = request()->userAgent();
            $rating->save();
        } else {
            $this->rate($value, $comment);
        }
    }

    public function rate($value, $comment = null, $user_id = null)
    {
        $user_id         = $this->byUser($user_id);
        $rating          = new Rating();
        $rating->rating  = $value;
        $rating->comment = $comment;
        $rating->user_id = $user_id;
        $rating->ip      = request()->ip();
        $rating->agent   = request()->userAgent();

        $this->ratings()->save($rating);
    }

    public function userRating()
    {
        return $this->ratings()
            ->where(['ip' => request()->ip()])
            ->where('user_id', ! auth()->check() ?: auth()->id())
            ->first();
    }

    public function usersRated()
    {
        return $this->ratings()
            ->where('rateable_type', '=', $this->getMorphClass())
            ->where('rateable_id', '=', $this->id)
            ->count();
    }
}