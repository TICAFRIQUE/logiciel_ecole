<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fiche de scolarité</title>
</head>

<style>
    #body {
        /* background-color: #f2f2f2;   */
        margin-right: 50px;
        margin-left: 50px;
        font-size: 12px;
    }

    .header {
        /* background-color: #f1f1f1; */

        margin-bottom: 10px;
        padding: 50px;

    }

    .header p {
        margin: 0px;
        line-height: 6em
    }
    p{
        margin: 0px;
        line-height: 2em
    }



    .header1,
    /* .header2, */
    .header3 {
        border: 1px solid rgb(56, 56, 56);
        border-radius: 5px;
        padding-left: 5px;
        margin: 0px;
    }
 

    .header1,
    /* .header2, */
    .header3 {
        text-align: justify;
        margin-top: 0;
    }


   
    .header2
    {
        text-align: center;
        margin-top: 0;
    }
    
    



    table {
        width: 100%;
    }

    #versement,
    th,
    #vers {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 14px
    }



    th {
        background-color: rgb(175, 174, 174)
    }

    .montant p {
        margin: 2px;
        text-align:right;
      
    }
</style>

<body>
  <?php for($i = 1; $i <=2; $i++): ?>
  <div id="body">
    <h4 style="text-align:center ; padding-top:5px">FICHE DE SCOLARITÉ</h4>

    <!-- ========== Start header-3block ========== -->
    <table id="header">
        <tr>
            <td class="box1">
                <div class="header1" style="padding: 10px">
                    <p>Fiche: <?php echo e($data_inscription->numero_inscription); ?>  </p>
                    <p>Date inscription: <?php echo e(\Carbon\Carbon::parse($data_inscription->created_at)->format('d-m-Y')); ?> </p>
                    <p>Année Scolaire :<?php echo e($data_inscription->anneeScolaire->indice); ?></p>
                </div>
            </td>

            <td class="box2">
                <div class="header2">
                    <p><img src="https://school.maxisujets.net/img/config/1132511702.png" width="50px" alt="logo"></p>
                    <p> <?php echo e($data_setting->localisation); ?> </p>
                    <p> <?php echo e($data_setting->phone1); ?></p>
                    <p> <?php echo e($data_setting->email1); ?></p>

                </div>
            </td>

            <td class="box3">
                <div class="header3" style="padding: 5px">
                    <p>Code:<?php echo e($data_inscription->eleve->code); ?></p>
                    <p>Nom & prenoms: <?php echo e($data_inscription->eleve->nom); ?> <?php echo e($data_inscription->eleve->prenoms); ?></p>
                    <p>Age :  <?php echo e(\Carbon\carbon::parse($data_inscription->eleve->date_naissance)->age); ?> Ans</p>
                    <p>Classe :  <?php echo e($data_inscription->classe->name); ?></p>

                </div>
            </td>
        </tr>

    </table>

    <!-- ========== End header-3block ========== -->

    <p style="text-align: center">Type :1 - Date inscription: 21/12/2021 - Date Limite : 21/12/2021
    </p>

    <!-- ========== Start Table Versement ========== -->
    <div>
        <table id="versement" style="margin-bottom:10px">
            <thead>
                <tr>
                    <th>N° Versement</th>
                    <th>Montant versés</th>
                    <th>Libellé</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $data_inscription->versements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td id="vers"><?php echo e($item->code); ?></td>
                    <td id="vers"><?php echo e($item->montant_verse); ?></td>
                    <td id="vers"><?php echo e($item->motifPaiement->name); ?></td>
                    <td id="vers"><?php echo e(\Carbon\carbon::parse($data_inscription->created_at)->format('d-m-Y')); ?></td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!-- ========== End Table Versement ========== -->


    <!-- ========== Start Section footer========== -->

    <table>
        <tr>
            <td>
                <div style="padding-right:100px">
                    <p style="margin-top:20px ; text-decoration:underline">
                        Observation:
                    </p>
                </div>
            </td>
            <td colspan="4"></td>

            <td>
                <div class="montant"
                    style="padding-right:20px; font-weight:bold ; text-align:justify">
                    <p>
                        <span> Scolarité: </span>
                        <span><?php echo e($data_inscription['montant_remise_scolarite'] > 0 ? $data_inscription['montant_remise_scolarite'] : $data_inscription['montant_scolarite']); ?> FCFA</span>
                    </p>
                    <p>
                        Remise: <?php echo e($data_inscription->remise); ?> %
                    </p>
                    <p>
                        Scolarité à payer: <?php echo e($data_inscription->montant_scolarite); ?> FCFA
                    </p>
                    <p>
                        Scolarité payé: <?php echo e($data_inscription->montant_scolarite_paye); ?> FCFA
                    </p>
                    <p>
                        Reste à payer: <?php echo e($data_inscription->montant_scolarite_restant); ?> FCFA
                    </p>
                </div>
            </td>

        </tr>

    </table>

    <!-- ========== End Section footer========== -->
    <p style="text-align:center">La présente fiche de scolarité a été imprimée le <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?> </p>

    <hr style="border : 1px dotted rgb(60, 0, 255)">





</div>
  <?php endfor; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/inscription/fiche-pdf.blade.php ENDPATH**/ ?>