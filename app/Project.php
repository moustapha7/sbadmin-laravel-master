<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $team_id
 * @property int $requestor_id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $comment
 * @property string $requestedDate
 * @property string $estcompletedDate
 * @property string $assignedDate
 * @property int $estDay
 * @property int $estHour
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $projectType_id
 * @property Client $client
 * @property ProjectType $projectType
 * @property User $user
 * @property Team $team
 * @property Task[] $tasks
 * @property Comment[] $comments
 * @property EmployeProject[] $employeProjects
 */
class Project extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'project';

    /**
     * @var array
     */
    protected $fillable = ['team_id', 'requestor_id', 'user_id', 'name', 'description', 'comment', 'requestedDate', 'estcompletedDate', 'assignedDate', 'estDay', 'estHour', 'status', 'created_at', 'updated_at', 'projectType_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client', 'requestor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projectType()
    {
        return $this->belongsTo('App\ProjectType', '"projectType_id"');
    }

    public function type()
    {
        return $this->belongsTo('App\ProjectType', 'projectType_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeProjects()
    {
        return $this->hasMany('App\EmployeProject');
    }

    public function employeProject()
    {
        return $this->belongsToMany('App\EmployeProject', 'employe_project', 'project_id','employe_id')->withTimestamps();
    }

    public function employes()
    {
        return $this->belongsToMany('App\Employe', 'employe_project', 'project_id','employe_id')->withPivot(['comment','type','assignedDate','reassignedDate','employeStatus'])->withTimestamps();
    }
}
