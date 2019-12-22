<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * Accessor accessable by using question->url
     * @return string
     */
    public function getUrlAttribute()
    {
        return route("questions.show", $this->id);
    }

    public function getVotesAttribute() {
        return $this->votes_count;
    }
    public function getAnswersAttribute() {
        return $this->answers_count;
    }
    public function getStatusAttribute() {
        return ($this->besta_answer_id > 0 ? "answer-accepted" : ($this->answers > 0 ? "answered" : "unanswered"));
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
