<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Créer un classe </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row g-3 needs-validation" method="post" action="<?php echo e(route('classe.store')); ?>"
                                novalidate>

                                <?php echo csrf_field(); ?>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Niveau</label>
                                    <select name="niveau" class="form-control" required>
                                        <option disabled selected value>Sélectionner...</option>
                                        <?php $__currentLoopData = $data_niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($item['id']); ?>"><?php echo e($item['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">classe</label>
                                    <input type="text" name="name" class="form-control" id="validationCustom01"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Capacité min </label>
                                    <input type="number" name="capacite_min" class="form-control" id="validationCustom01"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Capacité max </label>
                                    <input type="number" name="capacite_max" class="form-control" id="validationCustom01"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Statut</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Activé</option>
                                        <option value="desactive">Desactivé</option>

                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary ">Valider</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end col -->
</div>
<!--end row-->


<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/configuration/classe/create.blade.php ENDPATH**/ ?>