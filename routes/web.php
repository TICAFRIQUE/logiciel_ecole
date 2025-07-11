<?php

use App\Models\Equipe;
use App\Models\Optimize;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\VersementController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\AuthAdminController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\menu\MenuController;
use App\Http\Controllers\configuration\AnneeScolaire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\configuration\CycleController;
use App\Http\Controllers\configuration\VilleController;
use App\Http\Controllers\configuration\ClasseController;
use App\Http\Controllers\configuration\NiveauController;
use App\Http\Controllers\backend\module\ModuleController;
use App\Http\Controllers\configuration\MatiereController;
use App\Http\Controllers\backend\basic_site\SlideController;
use App\Http\Controllers\backend\blog\BlogContentController;
use App\Http\Controllers\backend\basic_site\EquipeController;
use App\Http\Controllers\backend\blog\BlogCategoryController;
use App\Http\Controllers\backend\basic_site\ServiceController;
use App\Http\Controllers\backend\media\MediaContentController;
use App\Http\Controllers\configuration\ModePaiementController;
use App\Http\Controllers\backend\media\MediaCategoryController;
use App\Http\Controllers\configuration\AnneeScolaireController;
use App\Http\Controllers\configuration\GroupeSanguinController;
use App\Http\Controllers\configuration\MotifPaiementController;
use App\Http\Controllers\backend\basic_site\ReferenceController;
use App\Http\Controllers\backend\basic_site\TemoignageController;
use App\Http\Controllers\backend\permission\PermissionController;
use App\Http\Controllers\configuration\MatiereCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


######################      START BACKEND ROUTE         ###########################################################

//login  for dashboard
Route::controller(AuthAdminController::class)->prefix('admin')->group(function () {
    route::get('/login', 'login')->name('admin.login');
    route::post('/login', 'login')->name('admin.login');
    route::post('/logout', 'logout')->name('admin.logout');
});


Route::middleware(['admin'])->group(function () {

    //Dashboard
    Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
        route::get('', 'index')->name('dashboard.index');
    });


    //register admin
    Route::prefix('register')->controller(AuthAdminController::class)->group(function () {
        route::get('', 'index')->name('admin-register.index');
        route::post('store', 'store')->name('admin-register.store');
        route::post('update/{id}', 'update')->name('admin-register.update');
        route::get('delete/{id}', 'delete')->name('admin-register.delete');
        route::get('profil/{id}', 'profil')->name('admin-register.profil');
        route::post('change-password', 'changePassword')->name('admin-register.new-password');
    });

    //role
    Route::prefix('role')->controller(RoleController::class)->group(function () {
        route::get('', 'index')->name('role.index');
        route::post('store', 'store')->name('role.store');
        route::post('update/{id}', 'update')->name('role.update');
        route::post('delete/{id}', 'delete')->name('role.delete');
    });

    //permission
    Route::prefix('permission')->controller(PermissionController::class)->group(function () {
        route::get('', 'index')->name('permission.index');
        route::post('store', 'store')->name('permission.store');
        route::get('load-permission/{id}', 'getPermissionOfModule')->name('loadpermission'); // get permission of module with ajax
        route::post('update/{id}', 'update')->name('permission.update');
        route::post('delete/{id}', 'delete')->name('permission.delete');
    });

    //module
    Route::prefix('module')->controller(ModuleController::class)->group(function () {
        route::get('', 'index')->name('module.index');
        route::post('store', 'store')->name('module.store');
        route::post('update/{id}', 'update')->name('module.update');
        route::post('delete/{id}', 'delete')->name('module.delete');
    });


    //page
    Route::prefix('page')->controller(PageController::class)->group(function () {
        route::get('', 'index')->name('page.index');
        route::get('create', 'create')->name('page.create');
        route::post('store', 'store')->name('page.store');
        route::get('edit/{id}', 'edit')->name('page.edit');
        route::post('update/{id}', 'update')->name('page.update');
        route::post('delete/{id}', 'delete')->name('page.delete');
    });


    //Setting
    Route::prefix('setting')->controller(SettingController::class)->group(function () {
        route::get('', 'index')->name('setting.index');
        route::post('store', 'store')->name('setting.store');
    });


    #############  BLOG  #####################
    //blog---category
    Route::prefix('blog-category')->controller(BlogCategoryController::class)->group(function () {
        route::get('', 'index')->name('blog-category.index');
        route::post('store', 'store')->name('blog-category.store');
        route::post('update/{id}', 'update')->name('blog-category.update');
        route::get('delete/{id}', 'delete')->name('blog-category.delete');
        route::post('position/{id}', 'position')->name('blog-category.position');
    });


    //blog---content
    Route::prefix('blog-content')->controller(BlogContentController::class)->group(function () {
        route::get('', 'index')->name('blog-content.index');
        route::get('create', 'create')->name('blog-content.create');
        route::post('store', 'store')->name('blog-content.store');
        route::get('edit/{id}', 'edit')->name('blog-content.edit');
        route::post('update/{id}', 'update')->name('blog-content.update');
        route::get('delete/{id}', 'delete')->name('blog-content.delete');
    });


    #############  MENU  #####################
    Route::prefix('menu')->controller(MenuController::class)->group(function () {
        // route::get('', 'index')->name('menu.index');
        route::get('create', 'create')->name('menu.create');
        route::post('store', 'store')->name('menu.store');
        route::get('add-item/{id}', 'addMenuItem')->name('menu.add-item'); // add subMenu
        route::post('add-item-store', 'addMenuItemStore')->name('menu.add-item-store'); // add subMenu

        route::get('edit/{id}', 'edit')->name('menu.edit');
        route::post('update/{id}', 'update')->name('menu.update');
        route::get('delete/{id}', 'delete')->name('menu.delete');
    });


    #############  SERVICE  #####################

    //service of basic site
    Route::prefix('service')->controller(ServiceController::class)->group(function () {
        route::get('', 'index')->name('service.index');
        route::get('create', 'create')->name('service.create');
        route::post('store', 'store')->name('service.store');
        route::get('edit/{id}', 'edit')->name('service.edit');
        route::post('update/{id}', 'update')->name('service.update');
        route::get('delete/{id}', 'delete')->name('service.delete');
    });


    #############  REFERENCE  #####################

    //reference of basic site
    Route::prefix('reference')->controller(ReferenceController::class)->group(function () {
        route::get('', 'index')->name('reference.index');
        route::post('store', 'store')->name('reference.store');
        route::post('update/{id}', 'update')->name('reference.update');
        route::get('delete/{id}', 'delete')->name('reference.delete');
    });



    #############  EQUIPE  #####################

    //equipe of basic site
    Route::prefix('equipe')->controller(EquipeController::class)->group(function () {
        route::get('', 'index')->name('equipe.index');
        route::post('store', 'store')->name('equipe.store');
        route::post('update/{id}', 'update')->name('equipe.update');
        route::get('delete/{id}', 'delete')->name('equipe.delete');
    });

    #############  SLIDER  #####################

    //slider of basic site
    Route::prefix('slide')->controller(SlideController::class)->group(function () {
        route::get('', 'index')->name('slide.index');
        route::post('store', 'store')->name('slide.store');
        route::post('update/{id}', 'update')->name('slide.update');
        route::get('delete/{id}', 'delete')->name('slide.delete');
    });


    #############  TEMOIGNAGE  #####################

    //slider of basic site
    Route::prefix('temoignage')->controller(TemoignageController::class)->group(function () {
        route::get('', 'index')->name('temoignage.index');
        route::post('store', 'store')->name('temoignage.store');
        route::post('update/{id}', 'update')->name('temoignage.update');
        route::get('delete/{id}', 'delete')->name('temoignage.delete');
    });


    #############  MEDIATHEQUE  #####################

    //mediatheque---category
    Route::prefix('media-category')->controller(MediaCategoryController::class)->group(function () {
        route::get('', 'index')->name('media-category.index');
        route::post('store', 'store')->name('media-category.store');
        route::post('update/{id}', 'update')->name('media-category.update');
        route::get('delete/{id}', 'delete')->name('media-category.delete');
        route::post('position/{id}', 'position')->name('media-category.position');
    });


    //mediatheque---media
    Route::prefix('media-content')->controller(MediaContentController::class)->group(function () {
        route::get('', 'index')->name('media-content.index');
        route::get('create', 'create')->name('media-content.create');
        route::post('store', 'store')->name('media-content.store');
        route::get('edit/{id}', 'edit')->name('media-content.edit');
        route::post('update/{id}', 'update')->name('media-content.update');
        route::get('delete/{id}', 'delete')->name('media-content.delete');
    });



    #############  SETTING  #####################
    //optimize clear : cache:clear  , route:cache , config:cache , 'view:clear' , optimize:clear
    Route::get('/cache-clear', function () {
        Artisan::call('optimize:clear');
        Optimize::create([
            'type_clear' => 'cache',
        ]);
        return response()->json(['message' => 'cache clear', 'status' => 200], 200);
    })->name('setting.cache-clear');

    //maintenance mode up
    Route::get(
        '/disable-maintenance-mode',
        function () {
            Artisan::call('up');
            Maintenance::create([
                'type' => 'up',
            ]);
            return response()->json(['message' => 'mode maintenance desactivé', 'status' => 200], 200);
        }
    )->name('setting.maintenance-up');

    //maintenance mode down
    Route::get(
        '/enable-maintenance-mode',
        function () {
            Artisan::call('down', [
                '--secret' => 'admin@2024',
                '--render' => 'backend.pages.maintenance-mode-view',
            ]);
            Maintenance::create([
                'type' => 'down',
            ]);
            return response()->json(['message' => 'mode maintenance activé', 'status' => 200], 200);
        }
    )->name('setting.maintenance-down');




    ######################      START LOGICIEL ECOLE  ROUTE     ###########################################################

    //configuration-Annee-scolaire
    Route::prefix('annee-scolaire')->controller(AnneeScolaireController::class)->group(function () {
        route::get('', 'index')->name('annee-scolaire.index');
        route::post('store', 'store')->name('annee-scolaire.store');
        route::post('update/{id}', 'update')->name('annee-scolaire.update');
        route::get('delete/{id}', 'delete')->name('annee-scolaire.delete');
        route::post('position/{id}', 'position')->name('annee-scolaire.position');
    });


    //configuration-cycle
    Route::prefix('cycle')->controller(CycleController::class)->group(function () {
        route::get('', 'index')->name('cycle.index');
        route::post('store', 'store')->name('cycle.store');
        route::post('update/{id}', 'update')->name('cycle.update');
        route::get('delete/{id}', 'delete')->name('cycle.delete');
        route::post('position/{id}', 'position')->name('cycle.position');
    });


    //configuration-niveau
    Route::prefix('niveau')->controller(NiveauController::class)->group(function () {
        route::get('', 'index')->name('niveau.index');
        route::post('store', 'store')->name('niveau.store');
        route::post('update/{id}', 'update')->name('niveau.update');
        route::get('delete/{id}', 'delete')->name('niveau.delete');
        route::post('position/{id}', 'position')->name('niveau.position');
    });


    //configuration-classe
    Route::prefix('classe')->controller(ClasseController::class)->group(function () {
        route::get('', 'index')->name('classe.index');
        route::post('store', 'store')->name('classe.store');
        route::post('update/{id}', 'update')->name('classe.update');
        route::get('delete/{id}', 'delete')->name('classe.delete');
        route::post('position/{id}', 'position')->name('classe.position');
    });

    //configuration-groupe-sanguin
    Route::prefix('groupe-sanguin')->controller(GroupeSanguinController::class)->group(function () {
        route::get('', 'index')->name('groupe-sanguin.index');
        route::post('store', 'store')->name('groupe-sanguin.store');
        route::post('update/{id}', 'update')->name('groupe-sanguin.update');
        route::get('delete/{id}', 'delete')->name('groupe-sanguin.delete');
        route::post('position/{id}', 'position')->name('groupe-sanguin.position');
    });

    //configuration-mode de paiement
    Route::prefix('mode-paiement')->controller(ModePaiementController::class)->group(function () {
        route::get('', 'index')->name('mode-paiement.index');
        route::post('store', 'store')->name('mode-paiement.store');
        route::post('update/{id}', 'update')->name('mode-paiement.update');
        route::get('delete/{id}', 'delete')->name('mode-paiement.delete');
        route::post('position/{id}', 'position')->name('mode-paiement.position');
    });


    //configuration-motif de paiement
    Route::prefix('motif-paiement')->controller(MotifPaiementController::class)->group(function () {
        route::get('', 'index')->name('motif-paiement.index');
        route::post('store', 'store')->name('motif-paiement.store');
        route::post('update/{id}', 'update')->name('motif-paiement.update');
        route::get('delete/{id}', 'delete')->name('motif-paiement.delete');
        route::post('position/{id}', 'position')->name('motif-paiement.position');
    });

    //configuration-vile & commune
    Route::prefix('ville')->controller(VilleController::class)->group(function () {
        route::get('', 'index')->name('ville.index');
        route::post('store', 'store')->name('ville.store');
        route::post('update/{id}', 'update')->name('ville.update');
        route::get('delete/{id}', 'delete')->name('ville.delete');
        // route::post('position/{id}', 'position')->name('ville.position');
        route::get('convertData', 'convertData')->name('ville.convertData');
    });

    //configuration-matiere-categorie
    Route::prefix('matiere-category')->controller(MatiereCategoryController::class)->group(function () {
        route::get('', 'index')->name('matiere-category.index');
        route::post('store', 'store')->name('matiere-category.store');
        route::post('update/{id}', 'update')->name('matiere-category.update');
        route::get('delete/{id}', 'delete')->name('matiere-category.delete');
        route::post('position/{id}', 'position')->name('matiere-category.position');
    });


    //configuration-matiere-categorie
    Route::prefix('matiere')->controller(MatiereController::class)->group(function () {
        route::get('', 'index')->name('matiere.index');
        route::post('store', 'store')->name('matiere.store');
        route::post('update/{id}', 'update')->name('matiere.update');
        route::get('delete/{id}', 'delete')->name('matiere.delete');
        route::post('position/{id}', 'position')->name('matiere.position');
    });


    //Eleve--Fiche 
    Route::prefix('eleve')->controller(EleveController::class)->group(function () {
        route::get('', 'index')->name('eleve.index');
        route::get('create', 'create')->name('eleve.create');
        route::get('detail/{id}', 'detail')->name('eleve.detail');
        route::get('edit/{id}', 'edit')->name('eleve.edit');
        route::post('store', 'store')->name('eleve.store');
        route::post('update/{id}', 'update')->name('eleve.update');
        route::get('delete/{id}', 'delete')->name('eleve.delete');
        route::post('position/{id}', 'position')->name('eleve.position');
    });


    //Eleve--Inscription 
    Route::prefix('inscription')->controller(InscriptionController::class)->group(function () {
        route::get('', 'index')->name('inscription.index');
        route::get('create', 'create')->name('inscription.create');
        route::get('detail/{id}', 'detail')->name('inscription.detail');
        route::get('edit/{id}', 'edit')->name('inscription.edit');
        route::post('store', 'store')->name('inscription.store');
        route::post('update/{id}', 'update')->name('inscription.update');
        route::get('delete/{id}', 'delete')->name('inscription.delete');
        route::get('print/{id}', 'print')->name('inscription.print');
    });


    //Eleve--Versement 
    Route::prefix('versement')->controller(VersementController::class)->group(function () {
        route::get('', 'index')->name('versement.index');
        route::get('create', 'create')->name('versement.create');
        route::get('detail/{id}', 'detail')->name('versement.detail');
        route::get('edit/{id}', 'edit')->name('versement.edit');
        route::post('store', 'store')->name('versement.store');
        route::post('update/{id}', 'update')->name('versement.update');
        route::get('delete/{id}', 'delete')->name('versement.delete');
    });


    ######################      END LOGICIEL ECOLE  ROUTE     ###########################################################

});



######################      END BACKEND ROUTE         ###########################################################
