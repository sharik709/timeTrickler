<?php

namespace App;

use App\Support\Traits\Utilities\Uuid;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use Uuid;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'task_number',
        'due_date',
        'uuid',
        'project_id'
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
     */
    public function removeUser(User $user):void
    {
        $this->users()->detach($user);
    }

}
