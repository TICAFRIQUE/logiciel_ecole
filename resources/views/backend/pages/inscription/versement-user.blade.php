@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Liste des versements</h5>

                <button type="button"
                    class="btn btn-primary {{ $data_inscription['montant_scolarite_restant'] == 0 ? 'd-none' : 'd-block' }} "
                    data-bs-toggle="modal" data-bs-target="#myModal">Ajouter
                    un versement</button>


                {{-- <a href="{{ route('inscription.create') }}" type="button" class="btn btn-primary ">Ajouter
                    un versement</a> --}}

            </div>
            <div class="card-header alert alert-info">
                <p> <i class=" ri-information-fill"></i> Les versements barrés sont ceux qui ont été supprimés</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Montant scolarité</th>
                                <th>Montant versé</th>
                                <th>Montant restant</th>
                                <th>Mode de paiement</th>
                                <th>Motif de paiement</th>
                                <th>Date de paiement</th>
                                <th>Crée par<i class=" ri-user-2-fill"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_versement as $key => $item)
                                <tr id="row_{{ $item['id'] }}"
                                    class="{{ $item->deleted_at != null ? 'text-decoration-line-through text-danger' : '' }}">

                                    <td> {{ ++$key }} </td>
                                    <td>{{ $item['code'] }}</td>
                                    <td>{{ $item['montant_scolarite'] }}</td>
                                    <td>{{ $item['montant_verse'] }}</td>
                                    <td>{{ $item['montant_restant'] }}</td>
                                    <td>{{ $item['modePaiement']['name'] }}</td>
                                    <td>{{ $item['motifPaiement']['name'] }}</td>
                                    <td> {{ $item['created_at'] }} </td>
                                    <td> {{ $item['user']['last_name'] }} <br> {{ $item['user']['phone'] }} </td>

                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li class="{{ $item->deleted_at != null ? 'd-none' : '' }}"><a
                                                        href="" class="dropdown-item"><i
                                                            class=" ri-printer-fill  align-bottom me-2 text-muted"></i>
                                                        Imprimer</a>
                                                </li>

                                                <li class="{{ $item->deleted_at != null ? 'd-block' : 'd-none' }} "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#myModal{{ $item->id }}">
                                                    <a href="#" type="button"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class=" ri-info-i align-bottom me-2 text-muted"></i>
                                                        Details</a>
                                                </li>



                                                <li class="{{ $item->deleted_at != null ? 'd-none' : '' }}">
                                                    <a href="#" class="dropdown-item remove-item-btn delete"
                                                        data-id={{ $item['id'] }}>
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </a>
                                                </li>

                                                @include('backend.pages.versement.delete-detail')

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.delete').on("click", function(e) {
                e.preventDefault();
                var Id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    customClass: {
                        confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                        cancelButton: 'btn btn-danger w-xs mt-2',
                    },
                    buttonsStyling: false,
                    showCloseButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "/versement/delete/" + Id,
                            dataType: "json",

                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your file has been deleted.',
                                        icon: 'success',
                                        customClass: {
                                            confirmButton: 'btn btn-primary w-xs mt-2',
                                        },
                                        buttonsStyling: false
                                    })

                                    $('#row_' + Id).remove();
                                    location.reload();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
