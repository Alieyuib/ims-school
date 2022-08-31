<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Teachers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/base_path', function(){
    return base_path();
});

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
 });

Route::get('/migrate', function(){
    Artisan::call('migrate');
    dd('migrated!');
});

 
 Route::get('/foo', function () {
    Artisan::call('storage:link');
    return 'Linked';
});

Route::group(['middleware' => ['auth']], function() {
   Route::get('/', function () {
    return view('layouts.app');
});

Route::any('/dashboard', 'DashboardController@index')->name('dashboard');
// Route::any('/dashboard/students', 'DashboardController@viewStudents')->name('view.students');
Route::post('/dashboard/student/enroll', 'DashboardController@enrollStudent')->name('enroll.student');
Route::get('/dashboard/students', 'DashboardController@fetchStudents')->name('fetch.students');
Route::get('/dashboard/student/new', 'DashboardController@newStudent')->name('dashboard-new-student');
Route::get('/dashboard/students/enrollment', 'DashboardController@getAwaitStudents')->name('dashboard-enroll-student');
Route::get('/dashboard/student/enrollment', 'DashboardController@getAwaitingStudents')->name('fetch.awaiting');
Route::get('/dashboard/student/enrollment/data', 'DashboardController@getStudentAwaitData')->name('get.await.student.data');
Route::post('/dashboard/student/enrollment/data', 'DashboardController@enrollAwaitingStudent')->name('enroll.await.student');
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
Route::get('/dashboard/users/', 'DashboardController@allUsers')->name('dashboard.all.users');
Route::get('/dashboard/user/new', 'DashboardController@newUser')->name('dashboard.new.user');
Route::post('/dashboard/user/new', 'DashboardController@createUser')->name('dashboard.new.user');
Route::get('/dashboard/users/all', 'DashboardController@viewAllUser')->name('dashboard.get.all.users');
Route::get('/dashboard/user/data', 'DashboardController@getUserData')->name('get.user.data');
Route::post('/dashboard/user/update', 'DashboardController@userDataUpdate')->name('user.data.update');
Route::get('/dashboard/item/new', 'DashboardController@newItem')->name('dashboard.new.item');
Route::post('/dashboard/item/new', 'DashboardController@addNewItem')->name('dashboard.add.item');
Route::get('/dashboard/item/all/list', 'DashboardController@viewAllItem')->name('dashboard.all.item');
Route::get('/dashboard/item/all', 'DashboardController@getItems')->name('dashboard.item.list');
Route::get('/dashboard/item/single', 'DashboardController@getItem')->name('dashboard.edit.item');
Route::post('/dashboard/item/update', 'DashboardController@updateItem')->name('dashboard.update.item');
Route::post('/dashboard/item/delete', 'DashboardController@deleteItem')->name('dashboard.delete.item');
Route::get('/dashboard/user/edit/{uid}', 'DashboardController@getEditUser')->name('dashboard.edit.user');
Route::post('/dashboard/user/edit/{uid}', 'DashboardController@editUser')->name('dashboard.edit.user');
Route::get('/dashboard/user/delete/{uid}', 'DashboardController@deleteUser')->name('dashboard.delete.user');
Route::get('/dashboard/user/edit-user-access/{uid}', 'DashboardController@editUserAccess')->name('dashboard.edit.useraccess');
Route::post('/dashboard/user/assign-user-access/{uid}', 'DashboardController@assignUserRole')->name('dashboard.assign.useraccess');
Route::post('/dashboard/user/assign-user-entities/{uid}', 'DashboardController@assignUserAccesibleEntities')->name('dashboard.assign.userentities');

// Transaction Routes


Route::get('/dashboard/accounts/', 'TransactionController@index')->name('dashboard.finance');
Route::get('/dashboard/finance/generate', 'TransactionController@indexGenerate')->name('dashboard.finance.generate');
Route::get('/dashboard/finance/edit', 'TransactionController@indexEdit')->name('dashboard.finance.edit');
Route::get('/dashboard/finance/logs', 'TransactionController@transactionHistoryAdmin')->name('dashboard.logs');
Route::get('/dashboard/finance/logs/generate', 'TransactionController@generateTransactionHistoryAdmin')->name('dashboard.logs.generate');
Route::get('/dashboard/finance/logs/edit', 'TransactionController@editTransactionHistoryAdmin')->name('dashboard.logs.edit');
Route::post('/dashboard/finance/logs/confirm', 'TransactionController@confirmTransaction')->name('dashboard.confirm.transaction');
Route::get('/dashboard/finance/logs/data', 'TransactionController@getInvoiceData')->name('get.invoice.data');
Route::get('/dashboard/account/edit/', 'TransactionController@getAccountBalance')->name('dashboard.edit.account');
Route::post('/dashboard/account/edit/', 'TransactionController@editAccountBalance')->name('dashboard.edit.account.balance');
Route::get('/dashboard/generate/invoice/{id}', 'TransactionController@invoiceCheckout')->name('dashboard.invoice.checkout');
Route::get('/dashboard/item/price/', 'TransactionController@getItemPrice')->name('dashboard.item.price');
Route::post('/dashboard/item/cart/', 'TransactionController@addItemToCart')->name('dashboard.add.item.cart');
Route::get('/dashboard/items/cart/', 'TransactionController@getCartItem')->name('dashboard.get.cart');
Route::get('/dashboard/items/carts/', 'TransactionController@generateInvoice2')->name('dashboard.invoice');
Route::post('/dashboard/add/invoice/', 'TransactionController@generateInvoice')->name('dashboard.add.invoice');
Route::get('/dashboard/invoice/recent/', 'TransactionController@recentInvoice')->name('dashboard.recent.invoice');
Route::post('/dashboard/invoice/send/', 'TransactionController@sendInvoice')->name('dashboard.send.invoice');
Route::post('/dashboard/invoice/discount/', 'TransactionController@invoiceDiscount')->name('dashboard.invoice.discount');



Route::get('/students', [StudentController::class, 'index']);
Route::post('/store', [StudentController::class, 'store'])->name('store');
Route::get('/fetch-all', [StudentController::class, 'fetchAll'])->name('fetchAll');
Route::get('/edit', [StudentController::class, 'edit'])->name('edit');
Route::post('/update', [StudentController::class, 'update'])->name('update');
Route::post('/delete', [StudentController::class, 'delete'])->name('delete');
Route::get('/studentData', [StudentController::class, 'studentData'])->name('studentData');

Route::get('/dashboard/students/class_one', [StudentController::class, 'classOneStudents'])->name('class_one');
Route::get('/dashboard/students/class_two', [StudentController::class, 'classTwoStudents'])->name('class_two');
Route::get('/dashboard/students/class_three', [StudentController::class, 'classThreeStudents'])->name('class_three');
Route::get('/dashboard/students/class_four', [StudentController::class, 'classFourStudents'])->name('class_four');
Route::get('/dashboard/students/class_hadaanah', [StudentController::class, 'classHadaanahStudents'])->name('class_hadaanah');
Route::get('/dashboard/students/class_fashul_hifiz', [StudentController::class, 'classHifizStudents'])->name('class_fashul_hifiz');
Route::get('/dashboard/students/class_arrauda_thaaniya', [StudentController::class, 'classThaaniyaStudents'])->name('class_arrauda_thaaniya');
Route::get('/dashboard/students/class_arraudatul_ola', [StudentController::class, 'classOlaStudents'])->name('class_arraudatul_ola');


// Registration Routes
Route::post('/online/register', 'RegistrationController@index')->name('registration.online');

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
Route::get('/student/portal/subject-record', 'PortalController@subjectRecord')->name('portal.subject.record');
Route::get('/student/portal/subject-records', 'PortalController@subjectRecordView')->name('portal.subject.records');

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
Route::get('/teacher/portal/class-student', 'TeachersController@fetchAllStudent')->name('portal.teacher.class');
Route::get('/teacher/portal/subject-data', 'TeachersController@getSubjectData')->name('portal.teacher.subject');
Route::post('/teacher/portal/update-scores', 'TeachersController@updateScores')->name('portal.teacher.scores');
Route::post('/teacher/portal/results', 'TeachersController@getResults')->name('portal.teacher.results')->middleware('can:get_results');
Route::get('/teacher/portal/logout', 'TeachersController@logout')->name('teacher.logout');

// Transaction route

Route::get('/finance/login', 'TransactionController@index')->name('finance.login');
Route::get('/student/portal/transaction/checkout', 'TransactionController@viewReceiptCheckout')->name('portal.checkout');
Route::post('/student/portal/transaction/checkout', 'TransactionController@checkout')->name('portal.checkout.final');
Route::get('/student/portal/transaction/history', 'TransactionController@transactionHistoryView')->name('portal.transaction.history');
Route::get('/student/portal/transaction/histories', 'TransactionController@transactionHistory')->name('portal.transaction.histories');
Route::get('/student/portal/invoice/', 'TransactionController@getInvoice')->name('portal.transaction.invoice');
Route::get('/student/portal/transaction/{id}', 'TransactionController@viewInvoice')->name('portal.transaction.invoice.view');

// Pdf Routes
Route::get('generate-pdf', 'PdfController@index')->name('download.invoice.pdf');

// Id Card Route
Route::get('/students/idcard', 'IdCardController@index')->name('dashboard.get.idcard');
Route::get('/students/idcard/{id}', 'IdCardController@generateIdCard')->name('dashboard.generate.idcard');

});

// front page

Route::get('/', 'FrontPageController@index')->name('front.page');
Route::get('/online/registration', 'FrontPageController@onlineRegView')->name('front.online.registration');


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


