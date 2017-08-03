<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['time', 'title', 'description'];

    public function users() {
    	return $this->belongsToMany('App\User');
    }
}

// Interacting with data
// Single entry
// $post = new Post(data);
// $post->save();
// $post->delete();

// Relation
// $post = Post::find(1);
// $comment = new Comment(data);
// $post->comments()->save($comment);

// Many-to-many
// $post = Post::find(1);
// $user = new User(data);
// $post->users()->attach($user);
// $post->users()->detach();
