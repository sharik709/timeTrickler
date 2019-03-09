<?php namespace App\Support\Traits\Utilities;

use Webpatser\Uuid\Uuid as UuidFactory;

trait Uuid {


    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) UuidFactory::generate(4);
        });
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function scopeFindByUuidOrFail($builder, $uuid)
    {
        return $builder->where('uuid', $uuid)->firstOrFail();
    }



}
