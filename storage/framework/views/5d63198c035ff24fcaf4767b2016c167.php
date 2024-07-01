
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    
    Inscription
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('backend.components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            inscription
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Créer un inscription
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" method="post" action="<?php echo e(route('inscription.store')); ?>" novalidate>
                        <?php echo csrf_field(); ?>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Année scolaire</label>
                            <select name="annee_scolaire_id" class="form-control  js-example-basic-single" required>
                                
                                <?php $__currentLoopData = $data_annee_scolaire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['indice']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Elèves</label>
                            <select name="eleve_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                <?php $__currentLoopData = $data_eleve; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['nom']); ?> <?php echo e($item['prenoms']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Niveaux</label>
                            <select id="niveau" name="niveau_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                <?php $__currentLoopData = $data_niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Classe</label>
                            <select name="classe_id" class="form-control  js-example-basic-single" id="classe">
                                <option disabled selected value>Sélectionner...</option>
                                
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>




                        <div class="col-md-1">
                            <label class="form-check-label" for="customAff">Affecté(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="affecte" class="form-check-input" id="customAff">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customRed">Redoublant(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="redoublant" class="form-check-input" id="customRed">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customBr">Boursier(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox"  name="boursier" class="form-check-input" id="customBr">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom du tuteur </label>
                            <input type="text" name="nom_tuteur" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Prenoms du tuteur</label>
                            <input type="text" name="prenoms_tuteur" class="form-control" id="validationCustom01"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Contact du tuteur</label>
                            <input type="number" name="contact1_tuteur" class="form-control" id="validationCustom01"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Autre Contact du tuteur</label>
                            <input type="number" name="contact2_tuteur" class="form-control" id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <hr>
                        <p id="MsgError"></p>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Remise (%)</label>
                            <input type="number" name="remise" class="form-control" id="remise">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais d'inscription</label>
                            <input type="number" class="form-control" id="montantInscription" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais scolarité</label>
                            <input type="number" class="form-control" id="montantScolarite" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais Transport</label>
                            <input type="number" class="form-control" id="validationCustom01" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais cantine</label>
                            <input type="number" class="form-control" id="validationCustom01" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Total net</label>
                            <input type="number" name="montant_scolarite" class="form-control"
                                id="montantTotalScolarite" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <!-- ========== Start Versement ========== -->

                        <div class="d-flex justify-content-between">
                            <hr class="w-50" size="5" style="background-color: #043eff">
                            <h4>Versements</h4>
                            <hr class="w-50" size="5" style="background-color: #043eff">
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Mode paiement</label>
                            <select name="mode_paiement_id" class="form-control  js-example-basic-single"
                                id="modePaiement" >
                                <option disabled selected value>Sélectionner...</option>
                                <?php $__currentLoopData = $data_mode_paiement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Motif du paiement</label>
                            <select name="motif_paiement_id" class="form-control  js-example-basic-single"
                                id="motifPaiement" >
                                <option disabled selected value>Sélectionner...</option>
                                <?php $__currentLoopData = $data_motif_paiement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Montant versé <span class="text-danger"
                                    id="montantMinimun"></span></label>
                            <input type="number" name="montant_scolarite_paye" class="form-control" id="montantVerse"
                                >
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Montant restant</label>
                            <input type="number" name="montant_scolarite_restant" class="form-control"
                                id="montantRestant" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <!-- ========== End Versement ========== -->

                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary w-100 btn-submit  ">Valider</button>
                </div>
                </form>
            </div>
        </div><!-- end row -->
    </div><!-- end col -->
    </div>
    <!--end row-->

<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>


    <script>
        $(function() {

            //filter la liste des classe et frais d'inscription lorsqu'on choisi un niveau
            $('#niveau').change(function(e) {
                e.preventDefault();
                var niveauId = $(this).val();

                //fltre de classe
                var classeList = <?php echo e(Js::from($data_classe)); ?> // variable venant du controller

                var filteredClasse = classeList.filter(function(item) {
                    return item.niveau_id == niveauId;
                });

                $('#classe').empty();
                $('#classe').append('<option value="">Choisir une classe</option>');
                $.each(filteredClasse, function(key, value) {
                    $('#classe').append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });


                //filtre des montant inscription scolarité
                var niveaux = <?php echo e(Js::from($data_niveaux)); ?>


                var getDataNiveaux = niveaux.filter(function(item) {
                    return item.id == niveauId;
                });
                // var mt = new Intl.NumberFormat('fr-FR').format(
                //     getDataNiveaux[0].montant_scolarite,
                // )


                $('#montantInscription').val(getDataNiveaux[0].montant_inscription);
                $('#montantScolarite').val(getDataNiveaux[0].montant_scolarite);
                $('#montantTotalScolarite').val(getDataNiveaux[0].total_scolarite);

                //on remise a null au change de niveau
                $('#remise').val('')

                // definir montant minimum
                $('#montantMinimun').html('(' + 'minimun ' + getDataNiveaux[0].montant_inscription + ')');

                //Initialisation lorsque la remise change d"etat
                $('#montantRestant').val(getDataNiveaux[0].total_scolarite);
                $('#montantVerse').val('');
                //

            });



            //gestion de la remise sur la scolarité
            $('#remise').keyup(function(e) {

                //Initialisation lorsque la remise change d"etat
                $('#montantRestant').val('');
                $('#montantVerse').val('');
                //

                var remise = $('#remise').val()
                var fraisInscription = $('#montantInscription').val();
                var fraisScolarite = $('#montantScolarite').val();
                var scolarite = parseFloat(fraisInscription) + parseFloat(
                    fraisScolarite) // total de : frais inscription + frais scolarite
                if (remise > 100) {
                    $('#MsgError').html('Le pourcentage ne doit pas exceder 100%').css({
                        'color': 'white',
                        'background-color': '#f06548',
                        'font-size': '16px'
                    });
                    $('.btn-submit').prop('disabled', true)

                    $('#montantTotalScolarite').val(scolarite)
                } else {
                    var montant_remise = parseFloat(scolarite) * (remise / 100)
                    var scolarite_remise = scolarite - montant_remise

                    $('#montantTotalScolarite').val((scolarite_remise.toFixed(0)))
                    $('#montantRestant').val((scolarite_remise.toFixed(0)))


                    $('#MsgError').html(' ')
                    $('.btn-submit').prop('disabled', false)
                }

            });

            //gestion des versements
            $('#montantVerse').keyup(function(e) {
                var fraisInscription = $('#montantInscription').val();
                var montantVersement = $('#montantVerse').val()
                var montantTotalScolarite = $('#montantTotalScolarite').val()
                var montantRestant = montantTotalScolarite - montantVersement

                // if (parseFloat(montantVersement) < parseFloat(fraisInscription)) {
                //     $('.btn-submit').prop('disabled', true)
                // }

                if (parseFloat(montantRestant) < 0) {
                    $('#MsgError').html(
                        'Le montant versement ne peut pas exceder le montant total de la scolarité'
                    ).css({
                        'color': 'white',
                        'background-color': '#f06548',
                        'font-size': '16px'
                    });
                    $('.btn-submit').prop('disabled', true)
                } else {
                    $('#montantRestant').val(parseFloat(montantRestant))
                    $('#MsgError').html(' ')
                    $('.btn-submit').prop('disabled', false)
                }
            });




        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/inscription/create.blade.php ENDPATH**/ ?>