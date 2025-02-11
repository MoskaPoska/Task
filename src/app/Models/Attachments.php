<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use mysql_xdevapi\TableSelect;

class Attachments extends Model
{
    use HasFactory;
    protected $fillable=[
        'task_id',
        'file_path',
        'file_name'
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
