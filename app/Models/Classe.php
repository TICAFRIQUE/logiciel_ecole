<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory , SoftDeletes,sluggable;

    public $incrementing = false;


    protected $fillable = [
        'name',
        'slug',
        'capacite_min',
        'capacite_max',
        'status',
        'position',
        'niveau_id',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'classes', 'length' => 10, 'prefix' =>
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
     * Get the user that owns the Niveau
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }



}

