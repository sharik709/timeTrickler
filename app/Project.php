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
        'description'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


}
