<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Matiere extends Model
{
    use HasFactory , sluggable;
    public $incrementing = false;

    protected $fillable = [
        'name',
        'slug',
        'abreviation',
        'status',
        'position',
        'matiere_categories_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'matieres', 'length' => 10, 'prefix' =>
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

    public function matiere_category(): BelongsTo
    {
        return $this->belongsTo(MatiereCategory::class , 'matiere_categories_id' , 'id' );
    }

}
