<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Task extends Model
{
    protected $fillable=[
        'user_id',
        'title',
        'description',
        'priority',
        'due_date',
        'is_complected'
        ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subtasks()
    {
        return $this->hasMany(Subtasks::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'task_tag');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachments::class);
    }
}
