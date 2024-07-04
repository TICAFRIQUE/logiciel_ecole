<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Enregistrer un élève</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row g-3 needs-validation" method="post" action="{{ route('eleve.store') }}"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Matricule </label>
                                    <input type="text" name="matricule" class="form-control" id="validationCustom01"
                                        placeholder="Ex: MT000543T6" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Extrait de naissance (Numero)
                                    </label>
                                    <input type="text" name="numero_extrait" class="form-control"
                                        id="validationCustom01" placeholder="Ex: N°000543T6" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="validationCustom01" class="form-label">Sexe</label>
                                    <select name="sexe" class="form-control" required>
                                        <option selected disabled value>Choisir</option>
                                        <option value="masculin">Masculin</option>
                                        <option value="feminin">Feminin</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    @inject('carbon', 'Carbon\Carbon')
                                    @php
                                        $date_now = $carbon::now()->format('Y-m-d');
                                    @endphp
                                    <label for="validationCustom01" class="form-label">Date d'admision</label>
                                    <input type="date" name="date_admission" value="{{ $date_now }}"
                                        class="form-control" id="date_start" required readonly>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <hr>
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Nom de famille </label>
                                    <input type="text" name="nom" class="form-control" id="validationCustom01"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>


                                <div class="col-md-5">
                                    <label for="validationCustom01" class="form-label">Prenoms</label>
                                    <input type="text" name="prenoms" class="form-control" id="validationCustom01"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Contact</label>
                                    <input type="number" name="contact" class="form-control" id="validationCustom01">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100 btn-submit ">Valider</button>
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
