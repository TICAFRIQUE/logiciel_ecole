<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory , SoftDeletes,sluggable;

    public $incrementing = false;


    protected $fillable = [
        'name',
        'slug',
        'montant_inscription',
        'montant_scolarite',
        'total_scolarite',
        'capacite',
        'status',
        'position',
        'cycle_id',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'niveaux', 'length' => 10, 'prefix' =>
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
     * Get the cycle that owns the Niveau
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }


    /**
     * Get all of the classes for the Niveau
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }



}
