<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal<?php echo e($item['id']); ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Informations sur la suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>N° versement : <?php echo e($item['code']); ?> </li>
                                <li>Montant annulé : <?php echo e($item['montant_verse']); ?> FCFA</li>
                                <li>Annulé par : <?php echo e($item->userDelete->last_name ?? ''); ?> <?php echo e($item->userDelete->first_name ?? ''); ?> | <?php echo e($item->userDelete->phone ?? ''); ?> </li>
                                <li>Date d'annulation : <?php echo e($item['date_delete']); ?> </li>

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
<!--end row-->


<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/versement/delete-detail.blade.php ENDPATH**/ ?>