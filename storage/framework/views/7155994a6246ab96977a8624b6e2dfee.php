<?php $__env->startSection('css'); ?>
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header alert alert-info">
                <p> <i class=" ri-information-fill"></i> Les inscriptions en fond sont les non soldés (réliquat)</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Annee Scolaire</th>
                                <th>No inscription</th>
                                
                                <th>Niveau</th>
                                <th>classe</th>
                                <th>Scolarité</th>
                                <th>Montant payé</th>
                                <th>Montant restant</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data_reliquat['inscriptions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($item->montant_scolarite_restant > 0 ? 'bg-danger text-white' : ''); ?>">
                                    <td> <?php echo e(++$key); ?> </td>
                                    <td><?php echo e($item['anneeScolaire']['indice']); ?></td>
                                    <td><?php echo e($item['numero_inscription']); ?></td>
                                    
                                    <td><?php echo e($item['niveau']['name']); ?></td>
                                    <td><?php echo e($item['classe']['name']); ?></td>
                                    <td><?php echo e($item['montant_remise_scolarite'] > 0 ? $item['montant_remise_scolarite'] : $item['montant_scolarite']); ?></td>
                                    <td><?php echo e($item['montant_scolarite_paye']); ?></td>
                                    <td><?php echo e($item['montant_scolarite_restant']); ?></td>
                                    <td><?php echo e($item['statut']); ?></td>
                                    <td> <?php echo e($item['created_at']); ?> </td>
                                    <td class="<?php echo e($item->montant_scolarite_restant == 0 ? 'd-none' : ''); ?>">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                

                                                <li><a href="#" class="dropdown-item reliquatBtn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#myModal<?php echo e($item->id); ?>"
                                                        data-id=<?php echo e($item->id); ?>><i
                                                            class=" ri-add-fill align-bottom me-2 text-muted"></i>
                                                        Ajouter un versement</a>
                                                </li>
                                                <?php echo $__env->make('backend.pages.reliquat.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/datatables.init.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>


    <script>
        $(document).ready(function() {
            $('.reliquatBtn').on('click', function() {
                var id = $(this).attr('data-id');

                //gestion du versement reliquat
                $('#montantVerseReliquat' + id).keyup(function(e) {

                    var montantVersement = parseFloat($('#montantVerseReliquat' + id).val())
                    var montantReliquat = parseFloat($('#reliquat' + id).val())

                    var montantRestant = montantReliquat -
                        montantVersement; // nouveau montant restant
                    $('#montantRestantReliquat' + id).val(montantRestant);


                    if (parseFloat(montantVersement) > montantReliquat) {
                        $('#MsgErrorReliquat' + id).html(
                            'Le montant versement ne peut pas exceder le montant total de la scolarité'
                        ).css({
                            'color': 'white',
                            'background-color': '#f06548',
                            'font-size': '16px'
                        });
                        $('.btnSubmitReliquat' + id).prop('disabled', true)
                        $('#montantRestantReliquat' + id).val(parseFloat(montantReliquat))
                    } else if (isNaN(montantVersement)) {
                        $('#montantRestantReliquat' + id).val(parseFloat(montantReliquat))
                    } else {
                        // $('#montantRestant').val(parseFloat(montantRestantOld))
                        $('#MsgErrorReliquat' + id).html(' ')
                        $('.btnSubmitReliquat' + id).prop('disabled', false)
                    }
                });
            })





        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/reliquat/index.blade.php ENDPATH**/ ?>