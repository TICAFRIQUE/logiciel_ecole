<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MatiereCategory extends Model
{
    use HasFactory , sluggable;
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
            $model->id = IdGenerator::generate(['table' => 'matiere_categories', 'length' => 10, 'prefix' =>
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
     * Get all of the comments for the BlogCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matieres(): HasMany
    {
        return $this->hasMany(Matiere::class);
    }
}
