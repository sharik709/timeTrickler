<?php

namespace App;

use App\Support\Traits\Utilities\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use Uuid;
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'uuid',
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
     * @param User $user
     */
    public function addUser(User $user):void
    {
        $this->users()->attach($user);
    }

    /**
     * @param User $user
     * @return int
     */
    public function removeUser(User $user):void
    {
        $this->users()->detach($user);
    }

    /**
     * @return bool
     */
    public function hasReachedUsersLimit()
    {
        return $this->users()->count() >= $this->users_limit;
    }

}
