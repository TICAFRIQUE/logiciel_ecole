@extends('backend.layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Eleve
        @endslot
        @slot('title')
            Créer un eleve
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" method="post" action="{{ route('eleve.store') }}" novalidate>
                        @csrf
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Matricule </label>
                            <input type="text" name="matricule" class="form-control" id="validationCustom01"
                                placeholder="Ex: MT000543T6" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Extrait de naissance (Numero) </label>
                            <input type="text" name="matricule" class="form-control" id="validationCustom01"
                                placeholder="Ex: N°000543T6" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Sexe</label>
                            <select name="sexe" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="masculin">M</option>
                                <option value="feminin">F</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Handicap</label>
                            <select name="handicap" class="form-control" required>
                                <option selected disabled value>Choisir</option>
                                <option value="oui">Oui</option>
                                <option value="non">Non</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Groupe sanguin </label>
                            <select name="groupe_sanguin" class="form-control">
                                <option selected disabled value>Choisir</option>
                                @foreach ($data_groupe_sanguin as $item)
                                    <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Nom de famille </label>
                            <input type="text" name="nom" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Prenoms</label>
                            <input type="text" name="prenoms" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Contact</label>
                            <input type="number" name="contact" class="form-control" id="validationCustom01"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Lieu de naissance</label>
                            <input type="text" name="lieu_naissance" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Pays</label>
                            <select name="country" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_pays as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['country'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                      

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Commune / Ville</label>
                            <select name="ville" class="form-control  js-example-basic-single" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_ville as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['city'] }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Quartier</label>
                            <input type="text" name="quartier" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Etablissement d'origine</label>
                            <input type="text" name="quartier" class="form-control" id="validationCustom01">
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
                    <button type="submit" class="btn btn-primary w-100 ">Valider</button>
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
@endsection
@endsection
