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
            Créer un inscription
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" method="post" action="{{ route('inscription.store') }}" novalidate>
                        @csrf

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Année scolaire</label>
                            <select name="annee_scolaire_id" class="form-control  js-example-basic-single" required>
                                {{-- <option disabled selected value>Sélectionner...</option> --}}
                                @foreach ($data_annee_scolaire as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['indice'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Elèves
                                <span class="text-danger">
                                    <a href="#" class="" data-bs-toggle="modal" data-bs-target="#myModal"> <i
                                            class="ri ri-user-add-fill"></i> Ajouter
                                        un élève</a>
                                </span></label>
                            </label>
                            <select id="eleve" name="eleve_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_eleve as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['nom'] }} {{ $item['prenoms'] }}
                                        ({{ $item['code'] }})
                                    </option>
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
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Classe</label>
                            <select name="classe_id" class="form-control  js-example-basic-single" id="classe" required>
                                <option disabled selected value>Sélectionner...</option>
                                {{-- @foreach ($data_classe as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach --}}
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>




                        <div class="col-md-1">
                            <label class="form-check-label" for="customAff">Affecté(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="affecte" class="form-check-input" id="customAff">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customRed">Redoublant(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="redoublant" class="form-check-input" id="customRed">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-1">
                            <label class="form-check-label" for="customBr">Boursier(e)</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="boursier" class="form-check-input" id="customBr">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom du tuteur </label>
                            <input type="text" name="nom_tuteur" class="form-control" id="nomTuteur" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Prenoms du tuteur</label>
                            <input type="text" name="prenoms_tuteur" class="form-control" id="prenomsTuteur" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Contact du tuteur</label>
                            <input type="number" name="contact1_tuteur" class="form-control" id="contactTuteur" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Autre Contact du tuteur</label>
                            <input type="number" name="contact2_tuteur" class="form-control" id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <hr>
                        <p id="MsgError"></p>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Remise (%)</label>
                            <input type="number" name="remise" class="form-control" id="remise">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais d'inscription</label>
                            <input type="number" class="form-control" id="montantInscription" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais scolarité</label>
                            <input type="number" class="form-control" id="montantScolarite" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais Transport</label>
                            <input type="number" name="montant_transport" class="form-control" id="fraisTransport">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Frais cantine</label>
                            <input type="number" name="montant_cantine" class="form-control" id="fraisCantine">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Total net</label>
                            <input type="number" name="montant_scolarite" class="form-control"
                                id="montantTotalScolarite" readonly>
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
                                id="modePaiement">
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
                                id="motifPaiement">
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_motif_paiement as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Montant versé <span class="text-danger"
                                    id="montantMinimun"></span></label>
                            <input type="number" name="montant_scolarite_paye" class="form-control" id="montantVerse">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Montant restant</label>
                            <input type="number" name="montant_scolarite_restant" class="form-control"
                                id="montantRestant" readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Réliquat en cour</label>
                            <input type="text" id="reliquat" name="reliquat" class="form-control border-danger text-danger fw-medium"
                               readonly>
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

    @include('backend.pages.inscription.modal-create-eleve')

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

            //Afficher les infos parent elève lorsqu'on choisi un eleve
            $('#eleve').change(function(e) {
                e.preventDefault();
                var eleveId = $(this).val();
                // variable venant du controller
                var eleveList = Object.values({{ Js::from($data_eleve) }});

                var filteredEleve = eleveList.filter(function(item) {
                    return item.id == eleveId;
                });

                var eleve = filteredEleve[0];
                $('#nomTuteur').val(eleve.nom_pere);
                $('#prenomsTuteur').val(eleve.prenoms_pere);
                $('#contactTuteur').val(eleve.contact_pere);



                //recuperer la liste des inscriptions de l'eleve selectionner
                var dataEleveList =
                    {{ Js::from($data_inscription_eleve) }} // variable venant du controller

                var filteredDataEleve = dataEleveList.filter(function(item) {
                    return item.id == eleveId;
                });

                let reliquatSum = 0
                var dataEleveInscription = filteredDataEleve[0].inscriptions;
                $.each(dataEleveInscription, function(key, value) {
                    reliquatSum += value.montant_scolarite_restant;
                });



                if (reliquatSum > 0) {
                    var reliquat = new Intl.NumberFormat('fr-FR').format(
                        reliquatSum,
                    )

                    Swal.fire({
                        title: 'Réliquat en cours',
                        text: "Ce élève a un reliquat de " + reliquat + " FCFA",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Voir les reliquats',
                        cancelButtonText: 'Poursuire l\'inscription',
                        customClass: {
                            confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                            cancelButton: 'btn btn-danger w-xs mt-2',
                        },
                        buttonsStyling: false,
                        showCloseButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //lien pour rediriger vers la somme des reliquat de l'eleve
                        }
                    });
                    //afficher la somme dans le champs somme
                    $('#reliquat').val(reliquat);

                } else {
                    $('#MsgError').html('');
                    $('#reliquat').val(0);

                }


            });


            //filter la liste des classe et frais d'inscription lorsqu'on choisi un niveau
            $('#niveau').change(function(e) {
                e.preventDefault();
                var niveauId = $(this).val();


                //fltre de classe a partir du niveau selectioné
                var classeList = {{ Js::from($data_classe) }} // variable venant du controller
                var filteredClasse = classeList.filter(function(item) {
                    return item.niveau_id == niveauId;
                });

                //infos de niveau
                var NiveauList = {{ Js::from($data_niveaux) }} // variable venant du controller
                var filteredNiveau = NiveauList.filter(function(item) {
                    return item.id == niveauId;
                });
                // console.log(filteredClasse.length);


                if (filteredClasse.length == 0) {
                    $('#classe').empty();
                    $('#classe').append('<option value="' + filteredNiveau[0].id + '">' + filteredNiveau[0]
                        .name +
                        '</option>');
                } else {
                    $('#classe').empty();
                    $('#classe').append('<option value="">Choisir une classe</option>');
                    $.each(filteredClasse, function(key, value) {
                        $('#classe').append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

                }


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
                $('#montantMinimun').html('(' + 'min: ' + getDataNiveaux[0].montant_inscription + ')');

                //Initialisation lorsque la remise change d"etat
                $('#montantRestant').val(getDataNiveaux[0].total_scolarite);
                $('#montantVerse').val('');
                //

            });



            //Start fonction pour la mise à jour des montants
            function miseAJourMontant() {

                //Initialisation lorsque la remise change d"etat
                // $('#montantRestant').val('');
                // $('#montantVerse').val('');

                var remise = $('#remise').val()
                var fraisInscription = $('#montantInscription').val();
                var fraisScolarite = $('#montantScolarite').val();
                var fraisCantine = $('#fraisCantine').val();
                var fraisTransport = $('#fraisTransport').val();


                var scolarite = parseFloat(fraisInscription) + parseFloat(fraisScolarite) + parseFloat(fraisCantine
                    .length > 0 ? fraisCantine : 0) + parseFloat(fraisTransport.length > 0 ? fraisTransport : 0);



                // total de : frais inscription + frais scolarite
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
                    $('#montantRestant').val((scolarite_remise.toFixed(0)))


                    $('#MsgError').html(' ')
                    $('.btn-submit').prop('disabled', false)
                }

            };

            $("#remise, #fraisCantine ,#fraisTransport ").on("input", function() {
                miseAJourMontant();
            });

            //end



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
