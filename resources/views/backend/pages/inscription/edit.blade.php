@extends('backend.layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('title')
    {{-- @lang('translation.datatables') --}}
    Inscription
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            inscription
        @endslot
        @slot('title')
            Modifier une inscription
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" method="post"
                        action="{{ route('inscription.update', $data_inscription['id']) }}" novalidate>
                        @csrf

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Année scolaire</label>
                            <select name="annee_scolaire_id" class="form-control  js-example-basic-single" required>
                                {{-- <option disabled selected value>Sélectionner...</option> --}}
                                @foreach ($data_annee_scolaire as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $item['id'] == $data_inscription['annee_scolaire_id'] ? 'selected' : '' }}>
                                        {{ $item['indice'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Elèves</label>
                            <select name="eleve_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_eleve as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $item['id'] == $data_inscription['eleve_id'] ? 'selected' : '' }}>
                                        {{ $item['nom'] }} {{ $item['prenoms'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Niveaux</label>
                            <select id="niveau" name="niveau_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_niveaux as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $item['id'] == $data_inscription['niveau_id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Classe</label>
                            <select name="classe_id" class="form-control  js-example-basic-single" id="classe">
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_classe_edit as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $item['id'] == $data_inscription['classe_id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>



                        <div class="col-md-1">
                            <label class="form-check-label" for="customAff">Affecté(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="affecte" class="form-check-input" id="customAff"
                                    {{ $data_inscription['affecte'] != null ? 'checked' : '' }}>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customRed">Redoublant(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="redoublant" class="form-check-input" id="customRed"
                                    {{ $data_inscription['redoublant'] != null ? 'checked' : '' }}>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customBr">Boursier(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="boursier" class="form-check-input" id="customBr"
                                    {{ $data_inscription['boursier'] != null ? 'checked' : '' }}>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <hr>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom du tuteur </label>
                            <input type="text" name="nom_tuteur" value="{{ $data_inscription['nom_tuteur'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Prenoms du tuteur</label>
                            <input type="text" name="prenoms_tuteur" value="{{ $data_inscription['prenoms_tuteur'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Contact du tuteur</label>
                            <input type="number" name="contact1_tuteur" value="{{ $data_inscription['contact1_tuteur'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Autre Contact du tuteur</label>
                            <input type="number" name="contact2_tuteur"
                                value="{{ $data_inscription['contact2_tuteur'] }}" class="form-control"
                                id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <hr>
                        <p id="MsgError"></p>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Remise (%)</label>
                            <input type="number" name="remise" value="{{ $data_inscription['remise'] }}"
                                class="form-control" id="remise">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais d'inscription</label>
                            <input type="number" value="{{ $data_inscription['niveau']['montant_inscription'] }}"
                                class="form-control" id="montantInscription" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais scolarité</label>
                            <input type="number" value="{{ $data_inscription['niveau']['montant_scolarite'] }}"
                                class="form-control" id="montantScolarite" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais Transport</label>
                            <input type="number" class="form-control" id="validationCustom01" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais cantine</label>
                            <input type="number" class="form-control" id="validationCustom01" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Total net</label>
                            <input type="number" value="{{ $data_inscription['versements'][0]['montant_scolarite'] }}"
                                name="montant_scolarite" class="form-control" id="montantTotalScolarite" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <!-- ========== Start Versement ========== -->

                        <div class="d-flex justify-content-between">
                            <hr class="w-50" size="5" style="background-color: #043eff">
                            <h4>Versements</h4>
                            <hr class="w-50" size="5" style="background-color: #043eff">
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Mode paiement</label>
                            <select name="mode_paiement_id" class="form-control  js-example-basic-single"
                                id="modePaiement" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_mode_paiement as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $item['id'] == $data_inscription['versements'][0]['mode_paiement_id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}</option>
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
                                    <option
                                        value="{{ $item['id'] }}"{{ $item['id'] == $data_inscription['versements'][0]['motif_paiement_id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Montant versé <span class="text-danger"
                                    id="montantMinimun"></span></label>
                            <input type="number" value="{{ $data_inscription['versements'][0]['montant_verse'] }}" name="montant_scolarite_paye" class="form-control" id="montantVerse"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Montant restant</label>
                            <input type="number" value="{{ $data_inscription['versements'][0]['montant_restant'] }}" name="montant_scolarite_restant" class="form-control"
                                id="montantRestant" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>





                        <!-- ========== End Versement ========== -->

                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary w-100 btn-submit  ">Valider</button>
                </div>
                </form>
            </div>
        </div><!-- end row -->
    </div><!-- end col -->
    </div>
    <!--end row-->

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>


    <script>
        $(function() {

            //filter la liste des classe et frais d'inscription lorsqu'on choisi un niveau
            $('#niveau').change(function(e) {
                e.preventDefault();
                var niveauId = $(this).val();

                //fltre de classe
                var classeList = {{ Js::from($data_classe) }} // variable venant du controller

                var filteredClasse = classeList.filter(function(item) {
                    return item.niveau_id == niveauId;
                });

                $('#classe').empty();
                $('#classe').append('<option value="">Choisir une classe</option>');
                $.each(filteredClasse, function(key, value) {
                    $('#classe').append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });


                //filtre des montant inscription scolarité
                var niveaux = {{ Js::from($data_niveaux) }}

                var getDataNiveaux = niveaux.filter(function(item) {
                    return item.id == niveauId;
                });
                // var mt = new Intl.NumberFormat('fr-FR').format(
                //     getDataNiveaux[0].montant_scolarite,
                // )


                $('#montantInscription').val(getDataNiveaux[0].montant_inscription);
                $('#montantScolarite').val(getDataNiveaux[0].montant_scolarite);
                $('#montantTotalScolarite').val(getDataNiveaux[0].total_scolarite);

                //on remise a null au change de niveau
                $('#remise').val('')

                // definir montant minimum
                $('#montantMinimun').html('(' + 'minimun ' + getDataNiveaux[0].montant_inscription + ')');

                //Initialisation lorsque la remise change d"etat
                $('#montantRestant').val('');
                $('#montantVerse').val('');
                //

            });



            //gestion de la remise sur la scolarité
            $('#remise').keyup(function(e) {

                //Initialisation lorsque la remise change d"etat
                $('#montantRestant').val('');
                $('#montantVerse').val('');
                //

                var remise = $('#remise').val()
                var fraisInscription = $('#montantInscription').val();
                var fraisScolarite = $('#montantScolarite').val();
                var scolarite = parseFloat(fraisInscription) + parseFloat(
                    fraisScolarite) // total de : frais inscription + frais scolarite
                if (remise > 100) {
                    $('#MsgError').html('Le pourcentage ne doit pas exceder 100%').css({
                        'color': 'white',
                        'background-color': '#f06548',
                        'font-size': '16px'
                    });
                    $('.btn-submit').prop('disabled', true)

                    $('#montantTotalScolarite').val(scolarite)
                } else {
                    var montant_remise = parseFloat(scolarite) * (remise / 100)
                    var scolarite_remise = scolarite - montant_remise

                    $('#montantTotalScolarite').val((scolarite_remise.toFixed(0)))

                    $('#MsgError').html(' ')
                    $('.btn-submit').prop('disabled', false)
                }

            });

            //gestion des versements
            $('#montantVerse').keyup(function(e) {
                var fraisInscription = $('#montantInscription').val();
                var montantVersement = $('#montantVerse').val()
                var montantTotalScolarite = $('#montantTotalScolarite').val()
                var montantRestant = montantTotalScolarite - montantVersement

                // if (parseFloat(montantVersement) < parseFloat(fraisInscription)) {
                //     $('.btn-submit').prop('disabled', true)
                // }

                if (parseFloat(montantRestant) < 0) {
                    $('#MsgError').html(
                        'Le montant versement ne peut pas exceder le montant total de la scolarité'
                    ).css({
                        'color': 'white',
                        'background-color': '#f06548',
                        'font-size': '16px'
                    });
                    $('.btn-submit').prop('disabled', true)
                } else {
                    $('#montantRestant').val(parseFloat(montantRestant))
                    $('#MsgError').html(' ')
                    $('.btn-submit').prop('disabled', false)
                }
            });




        });
    </script>
@endsection
@endsection
