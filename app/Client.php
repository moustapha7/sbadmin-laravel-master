<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $contactPhone
 * @property string $contactEmail
 * @property string $contactAdresse
 * @property string $created_at
 * @property string $updated_at
 * @property Department $department
 * @property Project[] $projects
 */
class Client extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'client';

    /**
     * @var array
     */
    protected $fillable = ['department_id', 'name', 'phone', 'email', 'contactPhone', 'contactEmail', 'contactAdresse', 'created_at', 'updated_at','contactName'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        public function projects()
        {
            return $this->hasMany('App\Project', 'requestor_id');
        }
}
