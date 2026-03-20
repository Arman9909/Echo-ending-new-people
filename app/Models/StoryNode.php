<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryNode extends Model
{
    protected $fillable = [
        'story_id',
        'parent_id',
        'text',
        'choice_text'
    ];

    public function children()
    {
        return $this->hasMany(StoryNode::class, 'parent_id');
    }
}

