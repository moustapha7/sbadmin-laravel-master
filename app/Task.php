<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property string $name
 * @property string $description
 * @property string $comment
 * @property string $requestedDate
 * @property string $estcompletedDate
 * @property string $assignedDate
 * @property int $estHour
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Project $project
 * @property Comment[] $comments
 */
class Task extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'task';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'project_id', 'name', 'description', 'comment', 'requestedDate', 'estcompletedDate', 'assignedDate', 'estHour', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
       // return $this->belongsTo('App\User','user_id');
        return $this->belongsToMany(User::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project','project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
