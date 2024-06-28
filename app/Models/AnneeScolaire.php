<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnneeScolaire extends Model
{
    use HasFactory , SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'indice',
        'date_debut',
        'date_fin',
        'status',
        'position'
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'annee_scolaires', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }


    
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
