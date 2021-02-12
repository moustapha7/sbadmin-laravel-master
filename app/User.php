<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $name
 * @property string $phone
 * @property string $position
 * @property string $email
 * @property string $password
 * @property int $team_id
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Project[] $projects
 * @property Comment[] $comments
 * @property Team[] $teams
 * @property Team $team
 * @property Task[] $tasks
 */
class User extends Authenticatable
{
    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['first_name','name','phone','position', 'email','team_id', 'password','created_at', 'updated_at'];


    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user';


    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   /* public function projects()
    {
        return $this->hasMany('App\Project');
    }*/

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_project', 'user_id','project_id')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->belongsToMany(User::class,'user_id','task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments()
    {
        return $this->belongsTo('App\Comment');
    }


    public function roles(){
        return $this->belongsToMany(Role::class,'role_user', 'user_id', 'role_id');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }

    public function userProject()
    {
        return $this->belongsToMany(UserProject::class, 'user_project', 'project_id','user_id')->withTimestamps();
    }

    

}
