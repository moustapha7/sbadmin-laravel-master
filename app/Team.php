<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Project[] $projects
 * @property Employe[] $employes
 */
class Team extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'team';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employes()
    {
        return $this->hasMany('App\Employe');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
