<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $task_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Project $project
 * @property Task $task
 */
class Comment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'project_id', 'task_id', 'content', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->hasMany('App\Task');
    }
}
