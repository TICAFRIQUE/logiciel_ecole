<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <h4 class="text-white text-uppercase my-3"> <?php echo e(config('app.name')); ?> </h4>
        
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
                    src="<?php if(Auth::user()->avatar != ''): ?> <?php echo e(URL::asset('images/' . Auth::user()->avatar)); ?><?php else: ?><?php echo e(URL::asset('build/images/users/avatar-1.jpg')); ?> <?php endif; ?>"
                    alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text"><?php echo e(Auth::user()->name); ?></span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome <?php echo e(Auth::user()->name); ?>!</h6>
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
                    key="t-logout"><?php echo app('translator')->get('translation.logout'); ?></span></a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav" id="navbar-nav">
                

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e(Route::is('dashboard.*') ? 'active' : ''); ?> "
                        href="<?php echo e(route('dashboard.index')); ?>">
                        <i class="ri-dashboard-2-line"></i> <span>DASHBOARD</span>
                    </a>
                </li>



                


                <!-- ========== Start WEB LINK ========== -->
                

                <!-- ========== End WEB LINK ========== -->



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarConfiguration" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarConfiguration">
                        <i class="ri-list-settings-line"></i> <span>CONFIGURATIONS</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo e(Route::is('annee-scolaire.*') || Route::is('cycle.*') || Route::is('niveau.*') || Route::is('classe.*') || Route::is('groupe-sanguin.*') || Route::is('mode-paiement.*') || Route::is('motif-paiement.*') || Route::is('ville.*') || Route::is('matiere-category.*') || Route::is('matiere.*') ? 'show' : ''); ?>"
                        id="sidebarConfiguration">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('annee-scolaire.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('annee-scolaire.*') ? 'active' : ''); ?>">Années
                                    scolaires</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('cycle.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('cycle.*') ? 'active' : ''); ?>">Cycles</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('niveau.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('niveau.*') ? 'active' : ''); ?>">Niveaux</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('classe.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('classe.*') ? 'active' : ''); ?>">Classes</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('groupe-sanguin.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('groupe-sanguin.*') ? 'active' : ''); ?>">Groupe
                                    sanguin</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('mode-paiement.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('mode-paiement.*') ? 'active' : ''); ?>">Mode de
                                    paiement</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('motif-paiement.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('motif-paiement.*') ? 'active' : ''); ?>">Motif de
                                    paiement</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('ville.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('ville.*') ? 'active' : ''); ?>">Villes</a>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarMedia"
                                    class="nav-link <?php echo e(Route::is('matiere-category.*') || Route::is('matiere.*') ? 'active' : ''); ?>"
                                    data-bs-toggle="collapse" role="button" aria-expanded="false"
                                    aria-controls="sidebarMedia">
                                    Matières
                                </a>
                                <div class="collapse menu-dropdown <?php echo e(Route::is('matiere-category.*') || Route::is('matiere.*') ? 'show' : ''); ?>"
                                    id="sidebarMedia">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item ">
                                            <a href="<?php echo e(route('matiere-category.index')); ?>"
                                                class="nav-link <?php echo e(Route::is('matiere-category.*') ? 'active' : ''); ?>">
                                                Categories </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="<?php echo e(route('matiere.index')); ?>"
                                                class="nav-link <?php echo e(Route::is('matiere.*') ? 'active' : ''); ?>">
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
                    <div class="collapse menu-dropdown <?php echo e(Route::is('eleve.*') || Route::is('inscription.*') ? 'show' : ''); ?>"
                        id="sidebarEleve">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo e(Route::is('eleve.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('eleve.index')); ?>">
                                    <i class=" ri ri-user-add-fill"></i> <span>Liste des élèves</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo e(Route::is('inscription.*') ? 'active' : ''); ?>"
                                    href="<?php echo e(route('inscription.index')); ?>">
                                    <i class=" ri ri-user-add-fill"></i> <span>Liste des inscriptions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e(Route::is('admin-register.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin-register.index')); ?>">
                        <i class="ri ri-swap-line"></i> <span>CAISSE</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e(Route::is('admin-register.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('admin-register.index')); ?>">
                        <i class="ri ri-lock-2-line"></i> <span>ADMINISTRATEURS</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSetting" data-bs-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="sidebarSetting">
                        <i class=" ri-settings-2-fill"></i> <span>PARAMETRES</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo e(Route::is('setting.*') || Route::is('module.*') || Route::is('role.*') || Route::is('permission.*') ? 'show' : ''); ?>""
                        id="sidebarSetting">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="<?php echo e(route('setting.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('setting.*') ? 'active' : ''); ?>">Informations</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('module.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('module.*') ? 'active' : ''); ?>">Modules</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('role.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('role.*') ? 'active' : ''); ?>">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('permission.index')); ?>"
                                    class="nav-link <?php echo e(Route::is('permission.*') ? 'active' : ''); ?>">Permissions</a>
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
<?php /**PATH C:\laragon\www\logiciel_ecole\resources\views/backend/layouts/sidebar.blade.php ENDPATH**/ ?>