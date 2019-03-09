<?php

namespace App;

use App\Support\Traits\Utilities\Uuid;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Uuid;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'title',
        'description',
        'users_limit'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return bool
     */
    public function hasReachedUsersLimit()
    {
        return $this->users()->count() >= $this->users_limit;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        return $this->users()->attach($user);
    }


}
