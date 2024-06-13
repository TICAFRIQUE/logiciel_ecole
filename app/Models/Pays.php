<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pays extends Model
{
    use HasFactory, SoftDeletes;


    public $incrementing = false;

    protected $fillable = [
        'country',
        'nationality',
        'iso2'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'pays', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    //RelationShips

    public function villes(): HasMany
    {
        return $this->hasMany(Ville::class);
    }


    public function eleves(): HasMany
    {
        return $this->hasMany(Eleve::class);
    }
}
