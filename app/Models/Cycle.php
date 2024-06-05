<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cycle extends Model
{
    use HasFactory , SoftDeletes , sluggable;

    
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
        'status', 
        'position',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'cycles', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Get all of the comments for the Cycle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function niveaux(): HasMany
    {
        return $this->hasMany(Niveau::class);
    }
}
