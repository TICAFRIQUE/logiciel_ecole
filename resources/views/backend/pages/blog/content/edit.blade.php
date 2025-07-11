@extends('backend.layouts.master')

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            BLOG
        @endslot
        @slot('title')
            Modifier un contenu
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- action="{{ route('blog-content.update', $data_blog_content['id']) }}" --}}
                    <form id="formSend" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-8">
                            <label for="validationCustom01" class="form-label">Titre du blog</label>
                            <input type="text" value="{{ $data_blog_content['title'] }}" name="title"
                                class="form-control" id="validationCustom01" placeholder="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Categories</label>
                            <select name="category" class="form-control" required>
                                <option disabled selected value>Sélectionner...</option>
                                @foreach ($data_blog_category as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ $data_blog_content['blog_categories_id'] == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="validationCustom01" class="form-label">Statut (Mise en ligne)</label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $data_blog_content['status'] == 'active' ? 'selected' : '' }}>
                                    Activé
                                </option>
                                <option value="desactive"
                                    {{ $data_blog_content['status'] == 'desactive' ? 'selected' : '' }}>Desactivé
                                </option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>


                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Résumé du blog</label>
                            <textarea class="form-control" name="resume" rows="5" class=""> 
                                {{ $data_blog_content['resume'] }}
                            </textarea><!-- End TinyMCE Editor -->
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>




                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Contenu de la page</label>
                            <textarea name="description" class="tinymce-editor">
                                {{ $data_blog_content['description'] }}
                            </textarea><!-- End TinyMCE Editor -->
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>






                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Image à la une</label>
                            <input type="file" name="image" class="form-control" id="validationCustom01">
                            <div class="valid-feedback">
                                Looks good!
                            </div>

                            <div class="col-md-12">
                                <img src="{{ asset($data_blog_content->getFirstMediaUrl('blogImage')) }}" alt=""
                                    width="80">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Gallery (Ajouter un ou plusieurs
                                images)</label>
                            <input type="file" class="form-control" id="imageInput" accept="image/*" multiple>
                            <div class="valid-feedback">
                                Looks good!
                            </div>

                            <div class="row" id="imageTableBody">

                            </div>

                            {{-- <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="imageTableBody">
                                </tbody>
                            </table> --}}
                        </div>
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
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script> --}}
    <script src="{{ URL::asset('build/tinymce/tinymce.min.js') }}"></script>

    <script>
        /**
         * Initiate TinyMCE Editor
         */

        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            deprecation_warnings: false,
            selector: 'textarea.tinymce-editor',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'https://www.tiny.cloud'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        //get gallery Image from controller for edit
        var getGalleryBlog = {{ Js::from($galleryBlog) }}

        for (let i = 0; i < getGalleryBlog.length; i++) {
            const element = getGalleryBlog[i];
            var image = ` <div class="col-4"><img src="data:image/jpeg;base64,${element}" width="100" height="100">
                                    <br><button type="button" class="btn btn-danger my-2 remove-image">Delete</button>
                                    </div>`;

            console.log('edit:', image);
            $('#imageTableBody').append(image);
        }



        //script for to send data images gallery
        $('#imageInput').on('change', function(e) {
            var files = e.target.files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {


                    var image = ` <div class="col-4"><img src="${e.target.result}" width="100" height="100">
                                    <br><button type="button" class="btn btn-danger my-2 remove-image">Delete</button>
                                    </div>`;

                    console.log(image);

                    $('#imageTableBody').append(image);
                }
                reader.readAsDataURL(files[i]);
            }
        });

        $(document).on('click', '.remove-image', function() {
            $(this).closest('div').remove();
        });

        $('#formSend').on('submit', function(e) {

            e.preventDefault();
            var formData = new FormData(this);

            $('#imageTableBody div').each(function() {
                var imageFile = $(this).find('img').attr('src');
                formData.append('images[]', imageFile);

            });


            var getBlogId = {{ Js::from($id) }}

            $.ajax({
                url: "/blog-content/update/" + getBlogId, // Adjust the route as needed
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#imageTableBody').empty();

                    if (response.message == 'operation reussi') {
                        Swal.fire({
                            title: 'Good job!',
                            text: 'You clicked the button!',
                            icon: 'success',
                            showCancelButton: true,
                            customClass: {
                                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                                cancelButton: 'btn btn-danger w-xs mt-2',
                            },
                            buttonsStyling: false,
                            showCloseButton: true
                        })

                        location.reload()
                    }
                },

            });
        });
    </script>
@endsection
@endsection
