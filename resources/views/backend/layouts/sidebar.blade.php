<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
            {{-- <a href="index" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ URL::asset($data_setting->getFirstMediaUrl('logo_header')) }}" alt="logo" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset($data_setting->getFirstMediaUrl('logo_header')) }}" alt="logo" height="17">
                </span>
            </a> --}}
    

        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
              @if ($data_setting && $data_setting->hasMedia('logo_header'))
                    <img src="{{ URL::asset($data_setting->getFirstMediaUrl('logo_header')) }}" alt="logo" width="30">
              @endif
            </span>
            <span class="logo-lg">
              @if ($data_setting && $data_setting->hasMedia('logo_header'))
                    <img src="{{ URL::asset($data_setting->getFirstMediaUrl('logo_header')) }}" alt="logo" width="150">
              @endif
            </span>
        </a>

        <span class="text-white fs-5 px-3">
            {{$data_annee->indice ?? ''}}
        </span>
        
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user"
                    src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                    alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">{{ Auth::user()->name }}</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome @auth
                {{ Auth::user()->name }}
            @endauth!</h6>
            <a class="dropdown-item" href="pages-profile"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat"><i
                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Messages</span></a>
            <a class="dropdown-item" href="apps-tasks-kanban"><i
                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Taskboard</span></a>
            <a class="dropdown-item" href="pages-faqs"><i
                    class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile"><i
                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance :
                    <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="pages-profile-settings"><span
                    class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic"><i
                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                    screen</span></a>

            <a class="dropdown-item " href="javascript:void();"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                    key="t-logout">@lang('translation.logout')</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav" id="navbar-nav">
                {{-- <li class="menu-title"><span>@lang('translation.menu')</span></li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('dashboard.*') ? 'active' : '' }} "
                        href="{{ route('dashboard.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span>DASHBOARD</span>
                    </a>
                </li>


                {{-- <li class="menu-title"><i class="ri-more-fill"></i> <span>@lang('translation.settings')</span></li> --}}


                <!-- ========== Start WEB LINK ========== -->
                {{-- @can('voir-page')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('page.index') }}">
                            <i class=" ri-file-4-line"></i> <span>PAGES</span>
                        </a>
                    </li>
                @endcan


                @can('voir-blog')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBlog" data-bs-toggle="collapse" role="button"
                            aria-expanded="true" aria-controls="sidebarAuth">
                            <i class=" ri-global-fill"></i> <span>BLOG</span>
                        </a>
                        <div class="collapse menu-dropdown {{ Route::is('blog-content.*') || Route::is('blog-category.*') ? 'show' : '' }} "
                            id="sidebarBlog">
                            <ul class="nav nav-sm flex-column">

                                <li class="nav-item ">
                                    <a href="{{ route('blog-category.index') }}"
                                        class="nav-link {{ Route::is('blog-category.*') ? 'active' : '' }}">Categorie</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog-content.index') }}"
                                        class="nav-link {{ Route::is('blog-content.*') ? 'active' : '' }} ">Contenu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBasicSite" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarAuth">
                        <i class=" ri-globe-fill"></i> <span>SITE BASIQUE</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('menu.*') || Route::is('service.*') || Route::is('reference.*') || Route::is('equipe.*') || Route::is('slide.*') || Route::is('media-category.*') || Route::is('media-content.*') ? 'show' : '' }} "
                        id="sidebarBasicSite">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{ route('menu.create') }}"
                                    class="nav-link {{ Route::is('menu.*') ? 'active' : '' }}">Menus</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('service.index') }}"
                                    class="nav-link {{ Route::is('service.*') ? 'active' : '' }}">Services</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('reference.index') }}"
                                    class="nav-link {{ Route::is('reference.*') ? 'active' : '' }}">Réferences</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('equipe.index') }}"
                                    class="nav-link {{ Route::is('equipe.*') ? 'active' : '' }}">Equipes</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('slide.index') }}"
                                    class="nav-link {{ Route::is('slide.*') ? 'active' : '' }}">Slide</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('temoignage.index') }}"
                                    class="nav-link {{ Route::is('temoignage.*') ? 'active' : '' }}">Témoignages</a>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarMedia"
                                    class="nav-link {{ Route::is('media-category.*') || Route::is('media-content.*') ? 'active' : '' }}"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarMedia">
                                    Mediathèque
                                </a>
                                <div class="collapse menu-dropdown {{ Route::is('media-category.*') || Route::is('media-content.*') ? 'show' : '' }}"
                                    id="sidebarMedia">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item ">
                                            <a href="{{ route('media-category.index') }}"
                                                class="nav-link {{ Route::is('media-category.*') ? 'active' : '' }}">
                                                Categories </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('media-content.index') }}"
                                                class="nav-link {{ Route::is('media-content.*') ? 'active' : '' }}">
                                                Medias </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- ========== End WEB LINK ========== -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarConfiguration" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarConfiguration">
                        <i class="ri-list-settings-line"></i> <span>CONFIGURATIONS</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('annee-scolaire.*') || Route::is('cycle.*') || Route::is('niveau.*') || Route::is('classe.*') || Route::is('groupe-sanguin.*') || Route::is('mode-paiement.*') || Route::is('motif-paiement.*') || Route::is('ville.*') || Route::is('matiere-category.*') || Route::is('matiere.*') ? 'show' : '' }}"
                        id="sidebarConfiguration">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('annee-scolaire.index') }}"
                                    class="nav-link {{ Route::is('annee-scolaire.*') ? 'active' : '' }}">Années
                                    scolaires</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cycle.index') }}"
                                    class="nav-link {{ Route::is('cycle.*') ? 'active' : '' }}">Cycles</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('niveau.index') }}"
                                    class="nav-link {{ Route::is('niveau.*') ? 'active' : '' }}">Niveaux</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('classe.index') }}"
                                    class="nav-link {{ Route::is('classe.*') ? 'active' : '' }}">Classes</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('groupe-sanguin.index') }}"
                                    class="nav-link {{ Route::is('groupe-sanguin.*') ? 'active' : '' }}">Groupe
                                    sanguin</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('mode-paiement.index') }}"
                                    class="nav-link {{ Route::is('mode-paiement.*') ? 'active' : '' }}">Mode de
                                    paiement</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('motif-paiement.index') }}"
                                    class="nav-link {{ Route::is('motif-paiement.*') ? 'active' : '' }}">Motif de
                                    paiement</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ville.index') }}"
                                    class="nav-link {{ Route::is('ville.*') ? 'active' : '' }}">Villes</a>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarMedia"
                                    class="nav-link {{ Route::is('matiere-category.*') || Route::is('matiere.*') ? 'active' : '' }}"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarMedia">
                                    Matières
                                </a>
                                <div class="collapse menu-dropdown {{ Route::is('matiere-category.*') || Route::is('matiere.*') ? 'show' : '' }}"
                                    id="sidebarMedia">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item ">
                                            <a href="{{ route('matiere-category.index') }}"
                                                class="nav-link {{ Route::is('matiere-category.*') ? 'active' : '' }}">
                                                Categories </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('matiere.index') }}"
                                                class="nav-link {{ Route::is('matiere.*') ? 'active' : '' }}">
                                                Matières </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEleve" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarEleve">
                        <i class=" ri ri-user-add-fill "></i> <span>ELEVES</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('eleve.*') || Route::is('inscription.*') ? 'show' : '' }}"
                        id="sidebarEleve">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link {{ Route::is('eleve.*') ? 'active' : '' }}"
                                    href="{{ route('eleve.index') }}">
                                    <i class=" ri ri-user-add-fill"></i> <span>Liste des élèves</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link {{ Route::is('inscription.*') ? 'active' : '' }}"
                                    href="{{ route('inscription.index') }}">
                                    <i class=" ri ri-user-add-fill"></i> <span>Liste des inscriptions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin-register.*') ? 'active' : '' }}"
                        href="{{ route('admin-register.index') }}">
                        <i class="ri ri-swap-line"></i> <span>CAISSE</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin-register.*') ? 'active' : '' }}"
                        href="{{ route('admin-register.index') }}">
                        <i class="ri ri-lock-2-line"></i> <span>ADMINISTRATEURS</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSetting" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarSetting">
                        <i class=" ri-settings-2-fill"></i> <span>PARAMETRES</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('setting.*') || Route::is('module.*') || Route::is('role.*') || Route::is('permission.*') ? 'show' : '' }}""
                        id="sidebarSetting">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('setting.index') }}"
                                    class="nav-link {{ Route::is('setting.*') ? 'active' : '' }}">Informations</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('module.index') }}"
                                    class="nav-link {{ Route::is('module.*') ? 'active' : '' }}">Modules</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="nav-link {{ Route::is('role.*') ? 'active' : '' }}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}"
                                    class="nav-link {{ Route::is('permission.*') ? 'active' : '' }}">Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>

    </div>
    <!-- Sidebar -->
</div>
<div class="sidebar-background"></div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
