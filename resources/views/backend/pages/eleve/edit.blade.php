@extends('backend.layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            eleve
        @endslot
        @slot('title')
            Modifier un eleve
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" method="post"
                        action="{{ route('eleve.update', $data_eleve['id']) }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Matricule </label>
                            <input type="text" name="matricule" class="form-control" id="validationCustom01"
                                placeholder="Ex: MT000543T6" value="{{ $data_eleve['matricule'] }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Extrait de naissance (Numero) </label>
                            <input type="text" name="numero_extrait" class="form-control" id="validationCustom01"
                                placeholder="Ex: N°000543T6" value="{{ $data_eleve['numero_extrait'] }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Sexe</label>
                            <select name="sexe" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="masculin" {{ $data_eleve['sexe'] == 'masculin' ? 'selected' : '' }}>Masculin
                                </option>
                                <option value="feminin" {{ $data_eleve['sexe'] == 'feminin' ? 'selected' : '' }}>Feminin
                                </option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Handicap</label>
                            <select name="handicap" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="oui" {{ $data_eleve['handicap'] == 'oui' ? 'selected' : '' }}>Oui</option>
                                <option value="non" {{ $data_eleve['handicap'] == 'non' ? 'selected' : '' }}>Non</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Groupe sanguin </label>
                            <select name="groupe_sanguin_id" class="form-control">
                                <option selected disabled value>Choisir</option>
                                @foreach ($data_groupe_sanguin as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $data_eleve['groupe_sanguin_id'] == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <hr>
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom de famille </label>
                            <input type="text" name="nom" value="{{ $data_eleve['nom'] }}" class="form-control"
                                id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Prenoms</label>
                            <input type="text" name="prenoms" value="{{ $data_eleve['prenoms'] }}" class="form-control"
                                id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Contact</label>
                            <input type="number" name="contact" value="{{ $data_eleve['contact'] }}" class="form-control"
                                id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $data_eleve['email'] }}" class="form-control"
                                id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" value="{{ $data_eleve['date_naissance'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Lieu de naissance</label>
                            <input type="text" name="lieu_naissance" value="{{ $data_eleve['lieu_naissance'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Pays</label>
                            <select name="pays_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_pays as $item)
                                    <option
                                        value="{{ $item['id'] }}"{{ $data_eleve['pays_id'] == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['country'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>



                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Commune / Ville</label>
                            <select name="ville_id" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_ville as $item)
                                    <option
                                        value="{{ $item['id'] }}"{{ $data_eleve['ville_id'] == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['city'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Quartier</label>
                            <input type="text" name="quartier" value="{{ $data_eleve['quartier'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Etablissement d'origine</label>
                            <input type="text" name="etablissement_origine"
                                value="{{ $data_eleve['etablissement_origine'] }}" class="form-control"
                                id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom du père</label>
                            <input type="text" name="nom_pere" value="{{ $data_eleve['nom_pere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="validationCustom01" class="form-label">Prenoms du père</label>
                            <input type="text" name="prenoms_pere" value="{{ $data_eleve['prenoms_pere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Contact du père</label>
                            <input type="number" name="contact_pere" value="{{ $data_eleve['contact_pere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Vivant ? (Père)</label>
                            <select name="statut_vivant_pere" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="oui" {{ $data_eleve['statut_vivant_pere'] == 'oui' ? 'selected' : '' }}>
                                    Oui
                                </option>

                                <option value="non"{{ $data_eleve['statut_vivant_pere'] == 'non' ? 'selected' : '' }}>
                                    Non
                                </option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom de la mère</label>
                            <input type="text" name="nom_mere" value="{{ $data_eleve['nom_mere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="validationCustom01" class="form-label">Prenoms de la mere</label>
                            <input type="text" name="prenoms_mere" value="{{ $data_eleve['prenoms_mere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Contact de la mère</label>
                            <input type="number" name="contact_mere" value="{{ $data_eleve['contact_mere'] }}"
                                class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Vivant ? (Mère)</label>
                            <select name="statut_vivant_mere" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="oui" {{ $data_eleve['statut_vivant_pere'] == 'oui' ? 'selected' : '' }}>
                                    Oui
                                </option>

                                <option value="non"{{ $data_eleve['statut_vivant_pere'] == 'non' ? 'selected' : '' }}>
                                    Non
                                </option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <hr>
                        <!--Get date now with carbon-->
                        <p class="py-2 rounded-3" id="MsgError"></p>
                        @inject('carbon', 'Carbon\Carbon') <!--Import carbon in blade-->
                        @php
                            $date_now = $carbon::now()->format('Y-m-d');
                        @endphp
                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Date d'admision</label>
                            <input type="date" name="date_admission"
                                value="{{ $data_eleve['date_admission'] ?? $date_now }}" class="form-control"
                                id="date_start" required readonly>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div> <!-- End Get date now with carbon-->

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Date de sortie</label>
                            <input type="date" name="date_sortie" value="{{ $data_eleve['date_sortie'] }}"
                                class="form-control" id="date_end">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div>
                                <img src="{{ asset($data_eleve->getFirstMediaUrl('profilFile')) }}"
                                    alt="{{ asset($data_eleve->getFirstMediaUrl('profilFile')) }}" class="img-thumbnail"
                                    id="imgProfil" width="50">
                            </div>
                            <label for="validationCustom01" class="form-label">Ajouter une photo</label>
                            <input type="file" name="profil_file" accept=".jpg, .jpeg, .png"
                                class="form-control fileInsertProfil">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            @foreach ($data_eleve->getMedia('extraitFile') as $media)
                                <div>
                                    @if ($media->extension == 'pdf')
                                        <p>Lien du fichier: <a href="{{ $media->getUrl() }}"
                                                target="_blank">{{ $media->file_name }}</a> </p>
                                    @else
                                        <img src="{{ asset($media->getFullUrl()) }}"
                                            alt="{{ asset($media->getFullUrl()) }}" class="img-thumbnail"
                                            width="50">
                                    @endif
                                </div>
                            @endforeach


                            <label for="validationCustom01" class="form-label">Ajouter un extrait de naissance</label>
                            <input type="file" name="extrait_file" accept=".jpg, .jpeg, .png, .pdf"
                                class="form-control fileInsertExtrait">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>



                        {{-- <div class="col-md-2">
                            <label class="form-check-label" for="customSwitchsizelg">Handicap</label>

                            <div class="form-check form-switch form-switch-lg col-md-2" dir="ltr">
                                <input type="checkbox" name="handicap" class="form-check-input" id="customSwitchsizelg" checked="">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div> --}}





                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary w-100 btn-submit ">Valider</button>
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
            //comparaison des dates admission et sortie

            // $('#date_start').change(function(e) {
            //     var date_start = $(this).val();
            //     var date_end = $('#date_end').val();

            //     if (date_start > date_end) {
            //         $('#MsgError').html(
            //             'La date d\'admission  ne doit pas etre superieur à la date de sortie de l\'élève'
            //         ).css({
            //             'color': 'white',
            //             'text-align': 'center',
            //             'background-color': '#f06548',
            //             'font-size': '16px'
            //         });
            //         $('.btn-submit').prop('disabled', true)
            //     } else {
            //         $('#MsgError').html(' ')
            //         $('.btn-submit').prop('disabled', false)
            //     }
            // });


            // $('#date_end').change(function(e) {
            //     var date_end = $(this).val();
            //     var date_start = $('#date_start').val();

            //     if (date_end < date_start) {
            //         $('#MsgError').html(
            //             'La date de sortie ne doit pas etre inferieur à la date d\'admission de l\'élève'
            //         ).css({
            //             'color': 'white',
            //             'text-align': 'center',
            //             'background-color': '#f06548',
            //             'font-size': '16px'
            //         });
            //         $('.btn-submit').prop('disabled', true)
            //     } else {
            //         $('#MsgError').html(' ')
            //         $('.btn-submit').prop('disabled', false)
            //     }
            // });


            //Verifie size file
            $('.fileInsertProfil').change(function(e) {
                e.preventDefault();
                var size = this.files[0].size;
                var maxSize = 1024 * 1024 * 2; // 2Mo
                if (size > maxSize) {
                    $('.fileInsertProfil').val('')
                    $('#MsgError').html('La taille du fichier ne dois pas depasser 2MB')
                        .css({
                            'color': 'white',
                            'text-align': 'center',
                            'background-color': '#f06548',
                            'font-size': '16px',
                        });
                    $('.btn-submit').prop('disabled', true)
                } else {
                    $('#MsgError').html('')
                    $('.btn-submit').prop('disabled', false)
                }


            });

            $('.fileInsertExtrait').change(function(e) {
                e.preventDefault();
                var size = this.files[0].size;
                var maxSize = 1024 * 1024 * 2; // 2Mo
                if (size > maxSize) {
                    $('.fileInsertExtrait').val('')
                    $('#MsgError').html('La taille du fichier ne dois pas depasser 2MB')
                        .css({
                            'color': 'white',
                            'text-align': 'center',
                            'background-color': '#f06548',
                            'font-size': '16px',
                        });
                    $('.btn-submit').prop('disabled', true)
                } else {
                    $('#MsgError').html('')
                    $('.btn-submit').prop('disabled', false)
                }


            });




        });
    </script>
@endsection
@endsection
