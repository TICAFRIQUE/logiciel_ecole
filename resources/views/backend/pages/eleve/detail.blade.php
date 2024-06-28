@extends('backend.layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-xxl-4">
            <div class="card mt-n5">
                <a href="javascript:history.back()" class="btn btn-primary w-50"><i class="ri ri-arrow-left-fill"></i> Retour à la liste </a>
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ URL::asset('build/images/users/avatar.jpg') }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow"
                                alt="user-profile-image">

                        </div>
                        <h5 class="fs-16 mb-1"> {{ $data_eleve['nom'] }} {{ $data_eleve['prenoms'] }}
                        </h5>
                        <p class="text-muted mb-0"><b><i class=" ri ri-calendar-fill"></i>
                                {{ \Carbon\carbon::parse($data_eleve['date_naissance'])->age }}</b> Ans</p>
                        <p class="text-muted mb-0"><b><i class=" ri ri-phone-fill"></i> {{ $data_eleve['contact'] }}</b></p>
                        <p class="text-muted mb-0"> Classe Actuelle : ???</p>

                    </div>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Autres informations </h5>
                        </div>

                    </div>
                    <div class="mb-3 d-flex">
                        <ul>
                            <li>Handicap : <b>{{ $data_eleve['handicap'] }} </b></li>
                            <li>Sexe : <b>{{ $data_eleve['sexe'] }} </b></li>
                            <li>Groupe Sanguin : <b>{{ $data_eleve['groupe_sanguin']['name'] }} </b></li>
                            <li>Date de naissance :
                                <b>{{ \Carbon\carbon::parse($data_eleve['date_naissance'])->format('d-m-Y') }} </b></li>
                            <li>Lieu de naissance : <b>{{ $data_eleve['lieu_naissance'] }} </b></li>
                            <li>Pays : <b>{{ $data_eleve['pays']['country'] }} </b></li>
                            <li>Ville / Commune : <b>{{ $data_eleve['ville']['city'] }} </b></li>
                            <li>Quartier : <b>{{ $data_eleve['quartier'] }} </b></li>


                            <hr>
                            <li>Nom du père : <b>{{ $data_eleve['nom_pere'] }} </b></li>
                            <li>Prenoms du père : <b>{{ $data_eleve['prenoms_pere'] }} </b></li>
                            <li>Contact du père : <b>{{ $data_eleve['contact_pere'] }} </b></li>
                            <li>statut vivant (père): <b>{{ $data_eleve['statut_vivant_pere'] }} </b></li>


                            <hr>
                            <li>Nom de la mère : <b>{{ $data_eleve['nom_mere'] }} </b></li>
                            <li>Prenoms de la mère : <b>{{ $data_eleve['prenoms_mere'] }} </b></li>
                            <li>Contact de la mère : <b>{{ $data_eleve['contact_mere'] }} </b></li>
                            <li>statut vivant(mère) : <b>{{ $data_eleve['statut_vivant_mere'] }} </b></li>

                            <hr>
                            <li>Date d'admission :
                                <b>{{ \Carbon\carbon::parse($data_eleve['date_admission'])->format('d-m-Y') }} </b></li>
                            <li>Date de sortie :
                                <b>{{ \Carbon\carbon::parse($data_eleve['date_sortie'])->format('d-m-Y') }} </b></li>



                        </ul>
                    </div>

                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-8">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#HistoriqueScolarite" role="tab">
                                <i class="fas fa-home"></i> Historiques des scolarités
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#HistoriqueVersement" role="tab">
                                <i class="far fa-user"></i> Historiques des versements
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="HistoriqueScolarite" role="tabpanel">
                            <h3>Historique des scolarites</h3>
                        </div>
                        <!--end tab-pane-historique-scolarite-->
                        <div class="tab-pane" id="HistoriqueVersement" role="tabpanel">
                            <h3>Historique des versements</h3>
                        </div>
                        <!--end tab-pane-historique-versement-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
