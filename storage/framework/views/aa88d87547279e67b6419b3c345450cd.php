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

                 <form class="row g-3 needs-validation" method="post" action="<?php echo e(route('ville.update', $item['id'])); ?>"
                     novalidate>
                     <?php echo csrf_field(); ?>


                     <div class="row">
                         <div class="col-md-6">
                             <label for="validationCustom01" class="form-label">Pays</label>
                             <select name="country" class="js-example-basic-single form-control" required>
                                 <option disabled selected value>Sélectionner...</option>
                                 <?php $__currentLoopData = $data_pays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($item['id']); ?>"><?php echo e($item['country']); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                             <div class="valid-feedback">
                                 Looks good!
                             </div>
                         </div>

                         <div class="col-md-6">
                             <label for="validationCustom01" class="form-label">Ville ou commune</label>
                             <input type="text" name="city" value="<?php echo e($item['city']); ?>" class="form-control"
                                 id="validationCustom01" required>
                             <div class="valid-feedback">
                                 Looks good!
                             </div>
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
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/pages/configuration/ville/edit.blade.php ENDPATH**/ ?>