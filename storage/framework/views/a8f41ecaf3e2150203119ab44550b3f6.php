<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModalEdit<?php echo e($item['id']); ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Modification </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row g-3 needs-validation" method="post"
                                action="<?php echo e(route('classe.update', $item['id'])); ?>" novalidate>
                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Niveau</label>
                                        <select name="niveau" class="form-control" required>
                                            <option disabled selected value>Sélectionner...</option>
                                            <?php $__currentLoopData = $data_niveaux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $niveau): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($niveau['id']); ?>"
                                                    <?php echo e($item['niveau_id'] == $niveau['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($niveau['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Classe</label>
                                        <input type="text" name="name" value="<?php echo e($item['name']); ?>"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Capacité min </label>
                                        <input type="number" name="capacite_min" value="<?php echo e($item['capacite_min']); ?>"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Capacité max </label>
                                        <input type="number" name="capacite_max" value="<?php echo e($item['capacite_max']); ?>"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Statut</label>
                                    <select name="status" class="form-control">
                                        <option value="active" <?php echo e($item['status'] == 'active' ? 'selected' : ''); ?>>
                                            Activé
                                        </option>
                                        <option value="desactive"
                                            <?php echo e($item['status'] == 'desactive' ? 'selected' : ''); ?>>Desactivé
                                        </option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary ">Modifier</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div><!-- /.modal -->
        </div><!-- end row -->
    </div><!-- end col -->
</div>






<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/configuration/classe/edit.blade.php ENDPATH**/ ?>