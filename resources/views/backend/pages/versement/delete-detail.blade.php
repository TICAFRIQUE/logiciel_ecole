<div class="row">
    <div class="col-xxl-6">
        <div class="card">
            <!-- Default Modals -->
            <div id="myModal{{$item['id']}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Informations sur la suppression</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                <li>N° versement : {{$item['code']}} </li>
                                <li>Montant annulé : {{$item['montant_verse']}} FCFA</li>
                                <li>Annulé par : {{$item->userDelete->last_name ?? ''}} {{$item->userDelete->first_name ?? ''}} | {{$item->userDelete->phone ?? ''}} </li>
                                <li>Date d'annulation : {{$item['date_delete']}} </li>

                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                            {{-- <button type="submit" class="btn btn-primary btn-submit ">Valider</button> --}}
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end col -->
<!--end row-->


