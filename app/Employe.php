<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $team_id
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property string $created_at
 * @property string $updated_at
 * @property Team $team
 * @property Task[] $tasks
 * @property EmployeProject[] $employeProjects
 */
class Employe extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'employe';

    /**
     * @var array
     */
    protected $fillable = ['team_id', 'first_name', 'last_name', 'position', 'created_at', 'updated_at'];

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
    public function employeProjects()
    {
        return $this->hasMany('App\EmployeProject');
    }

    public function employeProject()
    {
        return $this->belongsToMany(EmployeProject::class, 'employe_project', 'project_id','employe_id')->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employe_project', 'employe_id','project_id')->withTimestamps();
    }
}
