<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Teachers;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize'); 
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache'); 
});

// front page

Route::get('/', 'FrontPageController@index')->name('front.page');


// Route::any('/', 'MainController@index');
Route::get('/login', 'Authentication@index')->name('login');
Route::get('/forgot', 'Authentication@forgot')->name('forgot');
Route::get('/register', 'Authentication@register')->name('register');
// Route::get('/register', 'Authentication@register')->name('register');
Route::post('/register', 'Authentication@saveUser')->name('auth.register');
Route::post('/login', 'Authentication@loginUser')->name('auth.login');
Route::get('/profile', 'Authentication@profile')->name('profile');
Route::get('/logout', 'Authentication@logout')->name('logout');
// Route::any('/registration', 'MainController@registration');

// // Route::get('/', [UserController::class, 'login'])->name('login');
// Route::get('/register', [UserController::class, 'register'])->name('register');
// Route::get('/forgot', [UserController::class, 'forgot'])->name('forgot');
// Route::get('/reset', [UserController::class, 'reset'])->name('reset');


// Route::post('/register', [UserController::class, 'saveUser'])->name('auth.register');
// Route::post('/login', [UserController::class, 'loginUser'])->name('auth.login');
// Route::get('/profile', [UserController::class, 'profile'])->name('profile');
// Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::any('/dashboard', 'DashboardController@index')->name('dashboard');
// Route::any('/dashboard/students', 'DashboardController@viewStudents')->name('view.students');
Route::post('/dashboard/student/enroll', 'DashboardController@enrollStudent')->name('enroll.student');
Route::get('/dashboard/students', 'DashboardController@fetchStudents')->name('fetch.students');
Route::get('/dashboard/student/new', 'DashboardController@newStudent')->name('dashboard-new-student');
Route::any('/add-user', 'DashboardController@loginDashboard');
Route::any('/dashboard/student/new/add', 'DashboardController@addStudent')->name('newstudent');
Route::any('/dashboard/student/edit/{sid}', 'DashboardController@editStudent')->name('editstudent');
Route::any('/dashboard/student/edit/inst/{sid}', 'DashboardController@editInst');
Route::any('/dashboard/student/delete/{sid}', 'DashboardController@deleteStudent');
Route::any('/dashboard/student/grade-info', 'DashboardController@gradeInfo')->name('dashboard.grade.get');
Route::get('/dashboard/student/record', 'DashboardController@subjectRecords')->name('dashboard.records');
Route::get('/dashboard/student/records', 'DashboardController@subjectRecord')->name('dashboard.record');
Route::get('/dashboard/books', 'DashboardController@getBooks')->name('dashboard.books');
Route::post('/dashboard/book/upload', 'DashboardController@uploadBook')->name('dashboard.upload.book');
Route::get('/dashboard/book/load', 'DashboardController@loadBook')->name('dashboard.all.books');


Route::get('/students', [StudentController::class, 'index']);
Route::post('/store', [StudentController::class, 'store'])->name('store');
Route::get('/fetch-all', [StudentController::class, 'fetchAll'])->name('fetchAll');
Route::get('/edit', [StudentController::class, 'edit'])->name('edit');
Route::post('/update', [StudentController::class, 'update'])->name('update');
Route::post('/delete', [StudentController::class, 'delete'])->name('delete');

// Subjects Routes

Route::get('/dashboard/grade-student', 'DashboardController@gradeStudents')->name('dashboard.grade.students');
Route::post('/dashboard/grade-students', 'DashboardController@gradeStudent')->name('dashboard.grade.student');


// Students Routes
Route::get('/student/portal', 'PortalController@index')->name('portal.index');
Route::post('/student/portal/login', 'PortalController@portalLogin')->name('portal.login');
Route::get('/student/portal/dashboard', 'PortalController@dashboard')->name('portal.dashboard');
Route::get('/student/portal/logout', 'PortalController@logout')->name('portal.logout');

// Student Check Result
Route::get('/student/portal/myresults', 'PortalController@resultView')->name('portal.results');
Route::get('/student/portal/result', 'PortalController@viewResult')->name('portal.result');
Route::get('/student/portal/myresult', 'PortalController@getResults')->name('portal.get.result');
Route::get('/student/portal/myresult/signle', 'PortalController@getResultSingle')->name('portal.result.single');

Route::get('/student/portal/finance', 'PortalController@financeView')->name('portal.finance');
Route::get('/student/portal/finance/print-fee', 'PortalController@printFee')->name('portal.finance.view');
Route::get('/student/portal/finance/view-receipt', 'PortalController@viewReceipt')->name('portal.receipt');
Route::get('/student/portal/bio-data', 'PortalController@viewBioData')->name('portal.biodata');
Route::get('/student/portal/bio-data/get', 'PortalController@getBioData')->name('portal.biodata.get');
Route::post('/student/portal/bio-data/update', 'PortalController@updateBioData')->name('portal.biodata.update');
Route::get('/student/portal/course-registration', 'PortalController@courseRegistration')->name('portal.course.registration');
Route::post('/student/portal/course-registration', 'PortalController@coursesRegistration')->name('portal.courses.registration');
Route::get('/student/portal/get-books', 'PortalController@getBooks')->name('portal.get.books');
Route::get('/student/portal/get-book', 'PortalController@loadBook')->name('portal.all.books');

// portal.course.registration
// portal.course.registrationportal.course.registration

// Route::any('/students', [StudentController::class, 'index'])->name('students');
// Route::any('/dashboard/student/new/add', [DashboardController::class, 'addStudent'])->name('newstudent');
// Route::any('/student/add', [StudentController::class, 'store'])->name('newStudent');

// Teachers Routes

Route::get('/teacher/portal', 'TeachersController@index')->name('portal.teacher.index');
Route::post('/teacher/portal/login', 'TeachersController@portalLogin')->name('portal.teacher.login');
Route::get('/teacher/portal/dashboard', 'TeachersController@dashboardView')->name('portal.teacher.dashboard');
Route::get('/teacher/portal/grade-students', 'TeachersController@gradeView')->name('portal.teacher.grade');
Route::get('/teacher/portal/grade-student', 'TeachersController@fetchAllStudentCourse')->name('portal.teacher.grades');
Route::get('/teacher/portal/subject-data', 'TeachersController@getSubjectData')->name('portal.teacher.subject');
Route::post('/teacher/portal/update-scores', 'TeachersController@updateScores')->name('portal.teacher.scores');

// Transaction route

Route::get('/finance/login', 'TransactionController@index')->name('finance.login');
Route::get('/student/portal/transaction/checkout', 'TransactionController@viewReceiptCheckout')->name('portal.checkout');
Route::post('/student/portal/transaction/checkout', 'TransactionController@checkout')->name('portal.checkout.final');
Route::get('/student/portal/transaction/history', 'TransactionController@transactionHistoryView')->name('portal.transaction.history');
Route::get('/student/portal/transaction/histories', 'TransactionController@transactionHistory')->name('portal.transaction.histories');