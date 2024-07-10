<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal{{ $item->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Scolarité restante - <span class="text-primary">
                                    <b>{{ $item->montant_scolarite_restant }}
                                        FCFA </b></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row g-3 needs-validation" method="post"
                                action="{{ route('versement.store') }}" novalidate>
                                @csrf
                                <p id="MsgErrorReliquat{{$item->id}}"></p>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="validationCustom01" class="form-label">Mode paiement</label>
                                        <select name="mode_paiement_id" class="form-control  js-example-basic-single"
                                            id="modePaiementReliquat" required>
                                            <option disabled selected value>Sélectionner...</option>
                                            @foreach ($data_mode_paiement as $data_mode)
                                                <option value="{{ $data_mode['id'] }}">{{ $data_mode['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="validationCustom01" class="form-label">Motif du paiement</label>
                                        <select name="motif_paiement_id" class="form-control  js-example-basic-single"
                                            id="motifPaiementReliquat" required>
                                            <option disabled selected value>Sélectionner...</option>
                                            @foreach ($data_motif_paiement as $data_motif)
                                                <option value="{{ $data_motif['id'] }}">{{ $data_motif['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="validationCustom01" class="form-label">Montant versé <span
                                                class="text-danger" id="montantMinimunReliquat{{$item->id}}"></span></label>
                                        <input type="number" name="montant_scolarite_paye" class="form-control"
                                            id="montantVerseReliquat{{$item->id}}" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="validationCustom01" class="form-label">Montant restant</label>
                                        <input type="number" value="{{ $item['montant_scolarite_restant'] }}"
                                            name="montant_scolarite_restant" class="form-control" id="montantRestantReliquat{{$item->id}}"
                                            readonly>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>

                                <input type="text" name="inscription_id" value="{{ $item['id'] }}" hidden>
                                <input type="text" id="reliquat{{$item->id}}" value="{{ $item['montant_scolarite_restant'] }}" hidden>


                                <input type="text" name="montant_scolarite"
                                    value="{{ $item['montant_remise_scolarite'] > 0 ? $item['montant_remise_scolarite'] : $item['montant_scolarite'] }}"
                                    hidden>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary btnSubmitReliquat{{$item->id}} ">Valider</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
<!--end row-->
