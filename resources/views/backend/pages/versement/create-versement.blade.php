<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Nouveau versement - <span
                                    class="text-primary">Scolarité :
                                    <b>{{ $data_inscription['montant_remise_scolarite'] > 0 ? $data_inscription['montant_remise_scolarite'] : $data_inscription['montant_scolarite'] }}
                                        FCFA </b></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <form class="row g-3 needs-validation" method="post"
                                action="{{ route('versement.store') }}" novalidate>
                                @csrf
                                <p id="MsgError"></p>
                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Mode paiement</label>
                                    <select name="mode_paiement_id" class="form-control  js-example-basic-single"
                                        id="modePaiement" required>
                                        <option disabled selected value>Sélectionner...</option>
                                        @foreach ($data_mode_paiement as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Motif du paiement</label>
                                    <select name="motif_paiement_id" class="form-control  js-example-basic-single"
                                        id="motifPaiement" required>
                                        <option disabled selected value>Sélectionner...</option>
                                        @foreach ($data_motif_paiement as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Montant versé <span
                                            class="text-danger" id="montantMinimun"></span></label>
                                    <input type="number" name="montant_scolarite_paye" class="form-control"
                                        id="montantVerse" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="validationCustom01" class="form-label">Montant restant</label>
                                    <input type="number"
                                        value="{{ $data_inscription['montant_scolarite_restant'] ?? 0 }}"
                                        name="montant_scolarite_restant" class="form-control" id="montantRestant"
                                        readonly>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <input type="text" name="inscription_id" value="{{ $data_inscription['id'] }}"
                                    hidden>

                                <input type="text" name="montant_scolarite"
                                    value="{{ $data_inscription['montant_remise_scolarite'] > 0 ? $data_inscription['montant_remise_scolarite'] : $data_inscription['montant_scolarite'] }}"
                                    hidden>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary btn-submit ">Valider</button>
                        </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
<!--end row-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(function() {
        //gestion des versements

        $('#montantVerse').keyup(function(e) {
            var dataInscription = {{ Js::from($data_inscription) }}
            var montantRestantOld = dataInscription
                .montant_scolarite_restant; // ancien montant restant --par default
            var montantVersement = parseFloat($('#montantVerse').val())
            var montantRestantNew = montantRestantOld - montantVersement; // nouveau montant restant
            $('#montantRestant').val(montantRestantNew);


            if (parseFloat(montantVersement) > montantRestantOld) {
                $('#MsgError').html(
                    'Le montant versement ne peut pas exceder le montant total de la scolarité'
                ).css({
                    'color': 'white',
                    'background-color': '#f06548',
                    'font-size': '16px'
                });
                $('.btn-submit').prop('disabled', true)
                $('#montantRestant').val(parseFloat(montantRestantOld))
            } else if (isNaN(montantVersement)) {
                $('#montantRestant').val(parseFloat(montantRestantOld))
            } else {
                // $('#montantRestant').val(parseFloat(montantRestantOld))
                $('#MsgError').html(' ')
                $('.btn-submit').prop('disabled', false)
            }
        });
    });
</script>
