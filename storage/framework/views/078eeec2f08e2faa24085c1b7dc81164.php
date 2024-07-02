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
        display: flex;

        margin-bottom: 10px;

    }

    .header p {
        margin: 2px;
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
    .header2,
    .header3 {
        text-align: justify;
        margin-top: 0
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
        margin: 5px;
    }
</style>

<body>
    <div id="body">
        <h4 style="text-align:center ; padding-top:5px">FICHE DE SCOLARITÉ</h4>

        <!-- ========== Start header-3block ========== -->
        <table id="header">
            <tr>
                <td class="box1">
                    <div class="header1">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
                    </div>
                </td>

                <td class="box2">
                    <div class="header2">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
                    </div>
                </td>

                <td class="box3">
                    <div class="header3">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
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
                    <?php for($i = 1; $i <= 7; $i++): ?>
                        <tr>
                            <td id="vers">1</td>
                            <td id="vers">1000</td>
                            <td id="vers">Versement 1</td>
                            <td id="vers">21/12/2021</td>
                        </tr>
                    <?php endfor; ?>
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
                        style="padding-right:20px; font-weight:bold ; background-color:bisque ; text-align:center">
                        <p>
                            <span> Scolarité: </span>
                            <span>50000 FCFA</span>
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                    </div>
                </td>

            </tr>

        </table>

        <!-- ========== End Section footer========== -->
        <p style="text-align:center">La présente fiche de scolarité a été imprimée le 02/07/2024</p>

        <hr style="border : 1px dotted rgb(60, 0, 255)">





    </div>


    <div id="body">
        <h4 style="text-align:center ; padding-top:5px">FICHE DE SCOLARITÉ</h4>

        <!-- ========== Start header-3block ========== -->
        <table id="header">
            <tr>
                <td class="box1">
                    <div class="header1">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
                    </div>
                </td>

                <td class="box2">
                    <div class="header2">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
                    </div>
                </td>

                <td class="box3">
                    <div class="header3">
                        <p>Fiche:2023</p>
                        <p>Date inscription: 21/12/2021</p>
                        <p>Année Scolaire :2022-2023</p>
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
                    <?php for($i = 1; $i <= 7; $i++): ?>
                        <tr>
                            <td id="vers">1</td>
                            <td id="vers">1000</td>
                            <td id="vers">Versement 1</td>
                            <td id="vers">21/12/2021</td>
                        </tr>
                    <?php endfor; ?>
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
                        style="padding-right:20px; font-weight:bold ; background-color:bisque ; text-align:center">
                        <p>
                            <span> Scolarité: </span>
                            <span>50000 FCFA</span>
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                        <p>
                            Scolarité: 50000 FCFA
                        </p>
                    </div>
                </td>

            </tr>

        </table>

        <!-- ========== End Section footer========== -->
        <p style="text-align:center">La présente fiche de scolarité a été imprimée le 02/07/2024</p>

    </div>


  

</body>

</html>
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/inscription/fiche-pdf.blade.php ENDPATH**/ ?>