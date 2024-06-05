<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModalEdit{{ $item['id'] }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
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
                                action="{{ route('classe.update', $item['id']) }}" novalidate>
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Niveau</label>
                                        <select name="niveau" class="form-control" required>
                                            <option disabled selected value>Sélectionner...</option>
                                            @foreach ($data_niveaux as $niveau)
                                                <option value="{{ $niveau['id'] }}"
                                                    {{ $item['niveau_id'] == $niveau['id'] ? 'selected' : '' }}>
                                                    {{ $niveau['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Classe</label>
                                        <input type="text" name="name" value="{{ $item['name'] }}"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Capacité min </label>
                                        <input type="number" name="capacite_min" value="{{ $item['capacite_min'] }}"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Capacité max </label>
                                        <input type="number" name="capacite_max" value="{{ $item['capacite_max'] }}"
                                            class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Statut</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ $item['status'] == 'active' ? 'selected' : '' }}>
                                            Activé
                                        </option>
                                        <option value="desactive"
                                            {{ $item['status'] == 'desactive' ? 'selected' : '' }}>Desactivé
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





{{-- @section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection --}}
