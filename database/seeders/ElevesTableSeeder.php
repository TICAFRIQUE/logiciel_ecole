<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ElevesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('eleves')->delete();
        
        \DB::table('eleves')->insert(array (
            0 => 
            array (
                'id' => 1190456951,
                'code' => '20623',
                'matricule' => 'MT0258655',
                'numero_extrait' => '937/14/09/2005 du Registre 09/12',
                'handicap' => 'oui',
                'sexe' => 'feminin',
                'nom' => 'kouamelan',
                'prenoms' => 'Tanoh Davy Alex',
                'contact' => '123344485',
                'email' => 'alexkouameluan96@gmail.com',
                'date_naissance' => '2000-06-30',
                'lieu_naissance' => 'Bingerville',
                'groupe_sanguin_id' => 5753791624,
                'pays_id' => 17105880351,
                'ville_id' => 2165621032,
                'quartier' => 'abobote',
                'etablissement_origine' => 'azerty',
                'nom_pere' => 'kouamelan',
                'prenoms_pere' => 'Tanoh Davy Alex',
                'contact_pere' => '2589666',
                'statut_vivant_pere' => 'non',
                'nom_mere' => 'kouamelan',
                'prenoms_mere' => 'Tanoh Davy Alex',
                'contact_mere' => '54568798',
                'statut_vivant_mere' => 'oui',
                'date_admission' => '2024-06-21',
                'date_sortie' => '2024-06-23',
                'created_at' => '2024-06-21 19:25:58',
                'updated_at' => '2024-06-25 11:41:35',
            ),
        ));
        
        
    }
}