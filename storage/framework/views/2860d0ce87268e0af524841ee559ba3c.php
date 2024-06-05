 <!-- Default Modals -->
 <div id="myModalEdit<?php echo e($item['id']); ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="myModalLabel">Modification </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                 </button>
             </div>
             <div class="modal-body">

                 <form class="row g-3 needs-validation" method="post"
                     action="<?php echo e(route('niveau.update', $item['id'])); ?>" novalidate>
                     <?php echo csrf_field(); ?>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Cycles</label>
                         <select name="cycle" class="form-control" required>
                             <option disabled selected value>Sélectionner...</option>
                             <?php $__currentLoopData = $data_cycle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cycle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($cycle['id']); ?>" <?php echo e($item['cycle_id'] == $cycle['id'] ? 'selected' : ''); ?>><?php echo e($cycle['name']); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Niveau</label>
                         <input type="text" name="name" value="<?php echo e($item['name']); ?>" class="form-control" id="validationCustom01" required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Frais inscription</label>
                         <input type="number" name="montant_inscription" value="<?php echo e($item['montant_inscription']); ?>" class="form-control" id="validationCustom01"
                             required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Montant scolarité</label>
                         <input type="number" name="montant_scolarite" value="<?php echo e($item['montant_scolarite']); ?>" class="form-control" id="validationCustom01"
                             required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Capacité</label>
                         <input type="number" name="capacite" value="<?php echo e($item['capacite']); ?>" class="form-control" id="validationCustom01" required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>


                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Statut</label>
                         <select name="status" class="form-control">
                             <option value="active" <?php echo e($item['status'] == 'active' ? 'selected' : ''); ?>>
                                 Activé
                             </option>
                             <option value="desactive" <?php echo e($item['status'] == 'desactive' ? 'selected' : ''); ?>>Desactivé
                             </option>
                         </select>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
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

 
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/configuration/niveau/edit.blade.php ENDPATH**/ ?>