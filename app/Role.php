<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $fillable=['name','description'];

    public function users()
    {
      return $this->belongsToMany(User::class,'role_user', 'user_id', 'role_id');
    }
}
