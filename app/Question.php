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
        return route("questions.show", $this->slug);
    }

    public function getStatusAttribute() {
        return ($this->best_answer_id > 0 ? "answer-accepted" : ($this->answers_count > 0 ? "answered" : "unanswered"));
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute() {
        return \Parsedown::instance()->text($this->body);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
        // $question->answers()->count() = OK
        // $question->answers = NOT ok, because of table column answers -> resolution: changed table column name to answers_name

    }

    public function acceptBestAnswer($answer) {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites() {
        return $this->belongsToMany(User::class,'favorites')->withTimestamps();
    }

    public function isFavorited() {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function  getIsFavoritedAttribute() {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute() {
        return $this->favorites->count();
    }
}
