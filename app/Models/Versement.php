<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Versement extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'code',
        'montant_verse',
        'montant_restant',
        'montant_scolarite', //montant total de la scolarite
        'mode_paiement_id',
        'motif_paiement_id',
        'inscription_id',
        'user_id', // user create versement
        'user_delete', // user delete versement
        'date_delete', // date of delete versement
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'versements', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }


    public function modePaiement()
    {
        return $this->belongsTo(ModePaiement::class);
    }

    public function motifPaiement()
    {
        return $this->belongsTo(MotifPaiement::class);
    }

    public function user() // user to create versement
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function userDelete() // user to delete versement
    {
        return $this->belongsTo(User::class , 'user_delete');
    }

}
