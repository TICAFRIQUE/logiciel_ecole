<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Eleve extends Model implements HasMedia
{
    use HasFactory,  InteractsWithMedia;

    public $incrementing = false;

    protected $fillable = [
        'code',
        'Matricule',
        'numero_extrait',
        'handicap',
        'sexe',
        'groupe_sanguin_id',
        'nom',
        'prenoms',
        'email',
        'contact',
        'date_naissance',
        'lieu_naissance',
        'pays_id', //pays de naissance
        'ville_id', //commune de residence
        'quartier', //quartier de residence
        'etablissement_origine',
        'nom_pere',
        'prenom_pere',
        'contact_pere',
        'statut_vivant_pere', //boolean --oui ou non
        'nom_mere',
        'prenom_mere',
        'contact_mere',
        'statut_vivant_mere', //boolean --oui ou non
        'date_emission',
        'date_sortie',

    ];



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'eleves', 'length' => 10, 'prefix' =>
            mt_rand()]);

            $model->code = IdGenerator::generate(['table' => 'eleves', 'length' => 4, 'prefix' =>
            mt_rand()]);
        });
    }


    //RelationShips

    public function groupe_sanguin()
    {
        return $this->belongsTo(GroupeSanguin::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }


    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
