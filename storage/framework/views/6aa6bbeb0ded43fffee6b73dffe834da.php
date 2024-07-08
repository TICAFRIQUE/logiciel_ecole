
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mt-5">
        <div class="col-xxl-12">
            <div class="card mt-n5">
                <a href="javascript:history.back()" class="btn btn-primary w-25"><i class="ri ri-arrow-left-fill"></i> Retour à
                    la liste </a>

                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="<?php echo e(URL::asset('build/images/users/avatar.jpg')); ?>"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                alt="user-profile-image">

                        </div>
                        <h5 class="fs-16 mb-1"> <?php echo e($data_eleve['nom']); ?> <?php echo e($data_eleve['prenoms']); ?>

                        </h5>
                        <p class="text-muted mb-0"><b><i class=" ri ri-calendar-fill"></i>
                                <?php echo e(\Carbon\carbon::parse($data_eleve['date_naissance'])->age); ?></b> Ans</p>
                        <p class="text-muted mb-0"><b><i class=" ri ri-phone-fill"></i> <?php echo e($data_eleve['contact']); ?></b></p>
                        <p class="text-muted mb-0"> Classe Actuelle : <?php echo e($data_inscription['classe']['name'] ?? '???'); ?>

                        </p>

                        <p class="mt-3">
                            Statut : <span class="badge badge-gradient-primary fs-4"><i
                                    class=" ri ri-money-dollar-circle-fill"></i>
                                <?php echo e($data_inscription['statut']); ?></span>

                        </p>

                    </div>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Informations Inscription</h5>
                        </div>

                    </div>
                    <div class="mb-3">
                        <ul class="d-flex">
                            <div class="col-md-4">
                                <li>Année scolaire : <b><?php echo e($data_inscription['anneeScolaire']['indice']); ?> </b></li>
                                <li>Niveau : <b><?php echo e($data_inscription['niveau']['name']); ?> </b></li>
                                <li>Classe : <b><?php echo e($data_inscription['classe']['name'] ?? 'pas defini'); ?> </b> </li>
                                <li>Redoublant(e) : <b><?php echo e($data_inscription['redoublant'] == 'on' ? 'OUI' : 'NON'); ?> </b>
                                </li>
                                <li>Affecté d'Etat : <b><?php echo e($data_inscription['affecte'] == 'on' ? 'OUI' : 'NON'); ?> </b>
                                </li>
                                <li>Boursier(e) : <b><?php echo e($data_inscription['boursier'] == 'on' ? 'OUI' : 'NON'); ?> </b></li>
                            </div>
                            <div class="col-md-4">
                                <li>Scolarité : <b><?php echo e($data_inscription['montant_scolarite']); ?> FCFA </b></li>
                                <li>Remise : <b><?php echo e($data_inscription['remise'] ?? 0); ?> % </b></li>
                                <li>Scolarité-remise : <b><?php echo e($data_inscription['montant_remise_scolarite'] ?? 0); ?> FCFA
                                    </b></li>
                                <li>Scolarité versée : <b><?php echo e($data_inscription['montant_scolarite_paye'] ?? 0); ?> FCFA </b>
                                </li>
                                <li>Scolarité Restante : <b><?php echo e($data_inscription['montant_scolarite_restant'] ?? 0); ?>

                                        FCFA</b></li>
                            </div>
                        </ul>
                    </div>

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-12">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#HistoriqueVersement" role="tab">
                                <i class="far fa-user"></i> Historiques des versements
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " data-bs-toggle="tab" href="#HistoriqueScolarite" role="tab">
                                <i class="fas fa-home"></i> Informations Elève
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="HistoriqueVersement" role="tabpanel">
                            
                            <?php echo $__env->make('backend.pages.inscription.versement-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <!--end tab-pane-historique-versement-->
                        <div class="tab-pane" id="HistoriqueScolarite" role="tabpanel">
                            <h3>Informations Personnelles</h3>
                            <div class="mb-3">
                                <ul class="d-flex">
                                    <div class="col-md-4">
                                        <li>Handicap : <b><?php echo e($data_eleve['handicap']); ?> </b></li>
                                        <li>Sexe : <b><?php echo e($data_eleve['sexe']); ?> </b></li>
                                        <li>Groupe Sanguin : <b><?php echo e($data_eleve['groupe_sanguin']['name'] ?? 'pas defini'); ?>

                                            </b>
                                        </li>
                                        <li>Date de naissance :
                                            <b><?php echo e(\Carbon\carbon::parse($data_eleve['date_naissance'])->format('d-m-Y')); ?>

                                            </b>
                                        </li>
                                        <li>Lieu de naissance : <b><?php echo e($data_eleve['lieu_naissance']); ?> </b></li>
                                        <li>Pays : <b><?php echo e($data_eleve['pays']['country'] ?? 'pas defini'); ?> </b></li>
                                        <li>Ville / Commune : <b><?php echo e($data_eleve['ville']['city'] ?? 'pas defini'); ?> </b>
                                        </li>
                                        <li>Quartier : <b><?php echo e($data_eleve['quartier']); ?> </b></li>
                                    </div>

                                    <div class="col-md-4">
                                        <li>Nom du père : <b><?php echo e($data_eleve['nom_pere']); ?> </b></li>
                                        <li>Prenoms du père : <b><?php echo e($data_eleve['prenoms_pere']); ?> </b></li>
                                        <li>Contact du père : <b><?php echo e($data_eleve['contact_pere']); ?> </b></li>
                                        <li>statut vivant (père): <b><?php echo e($data_eleve['statut_vivant_pere']); ?> </b></li>
                                        <li>Nom de la mère : <b><?php echo e($data_eleve['nom_mere']); ?> </b></li>
                                        <li>Prenoms de la mère : <b><?php echo e($data_eleve['prenoms_mere']); ?> </b></li>
                                        <li>Contact de la mère : <b><?php echo e($data_eleve['contact_mere']); ?> </b></li>
                                        <li>statut vivant(mère) : <b><?php echo e($data_eleve['statut_vivant_mere']); ?> </b></li>
                                    </div>

                                    <div class="col-md-4">
                                        <li>Date d'admission :
                                            <b><?php echo e(\Carbon\carbon::parse($data_eleve['date_admission'])->format('d-m-Y')); ?>

                                            </b>
                                        </li>
                                        <li>Date de sortie :
                                            <b><?php echo e(\Carbon\carbon::parse($data_eleve['date_sortie'])->format('d-m-Y')); ?>

                                            </b>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <!--end tab-pane-infod eleve-->

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <?php echo $__env->make('backend.pages.versement.create-versement', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/inscription/detail.blade.php ENDPATH**/ ?>