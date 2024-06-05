 <!-- Default Modals -->
 <div id="myModalEdit{{ $item['id'] }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
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
                     action="{{ route('niveau.update', $item['id']) }}" novalidate>
                     @csrf

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Cycles</label>
                         <select name="cycle" class="form-control" required>
                             <option disabled selected value>Sélectionner...</option>
                             @foreach ($data_cycle as $cycle)
                                 <option value="{{ $cycle['id'] }}" {{$item['cycle_id'] == $cycle['id'] ? 'selected' : ''}}>{{ $cycle['name'] }}</option>
                             @endforeach
                         </select>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>
                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Niveau</label>
                         <input type="text" name="name" value="{{$item['name']}}" class="form-control" id="validationCustom01" required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Frais inscription</label>
                         <input type="number" name="montant_inscription" value="{{$item['montant_inscription']}}" class="form-control" id="validationCustom01"
                             required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Montant scolarité</label>
                         <input type="number" name="montant_scolarite" value="{{$item['montant_scolarite']}}" class="form-control" id="validationCustom01"
                             required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>

                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Capacité</label>
                         <input type="number" name="capacite" value="{{$item['capacite']}}" class="form-control" id="validationCustom01" required>
                         <div class="valid-feedback">
                             Looks good!
                         </div>
                     </div>


                     <div class="col-md-12">
                         <label for="validationCustom01" class="form-label">Statut</label>
                         <select name="status" class="form-control">
                             <option value="active" {{ $item['status'] == 'active' ? 'selected' : '' }}>
                                 Activé
                             </option>
                             <option value="desactive" {{ $item['status'] == 'desactive' ? 'selected' : '' }}>Desactivé
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

 {{-- @section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection --}}
