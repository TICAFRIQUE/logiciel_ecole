<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscription extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'numero_inscription',
        'type_inscription',
        'redoublant',
        'affecte', // affectation
        'boursier',
        'nom_tuteur',
        'prenoms_tuteur',
        'adresse_tuteur',
        'contact1_tuteur',
        'contact2_tuteur',
        'email_tuteur',
        'profession_tuteur',
        'eleve_id',
        'annee_scolaire_id',
        'niveau_id',
        'classe_id',

        //scolarité
        'remise', //en pourcentage
        'montant_scolarite',
        'montant_remise_scolarite', // montant apres remise
        'montant_scolarite_paye',
        'montant_scolarite_restant',
        'statut', // impayé , soldé

        'montant_cantine',
        'montant_transport',

        'observation',


    ];


    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'inscriptions', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }



    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }


    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function versements()
    {
        return $this->hasMany(Versement::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }


    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

}
