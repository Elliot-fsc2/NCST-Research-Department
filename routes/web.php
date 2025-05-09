`<?php
use App\Livewire\CourseManagement;
use App\Livewire\DepartmentCourseManagement;
use App\Livewire\Groups;
use App\Livewire\HeadAnnouncement;
use App\Livewire\HeadDashboard;
use App\Livewire\HeadGroupMasterlist;
use App\Livewire\InstructorCourses;
use App\Livewire\InstructorDashboard;
use App\Livewire\InstructorGroups;
use App\Livewire\InstructorManagement;
use App\Livewire\InstructorSections;
use App\Livewire\PersonnelManagement;
use App\Livewire\RoleManagement;
use App\Livewire\StudentDashboard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Welcome;
use App\Services\RedirectService;


Route::fallback(function (): RedirectResponse {
    return redirect('/'); // Redirect to home instead of showing 404
});

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('welcome');
    }
    $redirectService = new RedirectService();
    return redirect($redirectService->afterLogin());
})->name('home');

Route::get('/test', function () {
    return 'sadasd';
});

Route::middleware(['guest'])->group(function () {
    Route::get('/welcome', function(){
        return view('welcome');
    })->name('welcome');
    Volt::route('/login', 'login')->name('login');
    Volt::route('/register', 'register');
});

// Define the logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});

//head routes
Route::middleware(['auth', 'research-head'])->prefix('head')->name('head.')->group(function () {
    Route::get('/dashboard', HeadDashboard::class)->name('dashboard');
    Route::get('/announcements', HeadAnnouncement::class)->name('announcements');
    Route::get('/groups', Groups::class)->name('groups');
    Route::get('/masterlist', HeadGroupMasterlist::class)->name('masterlist');

    //Manaagement Routes
    Route::get('/personnel-management', PersonnelManagement::class)->name('personnel');
    Route::get('/instructor-management', InstructorManagement::class)->name('instructor');
    Route::get('/role-management', RoleManagement::class)->name('role');
    Route::get('/department-course-management', DepartmentCourseManagement::class)->name('dept');
    Route::get('/department-course-management/{department}', CourseManagement::class)->name('dept.course');
});

//professor routes
Route::middleware(['auth', 'professor'])->prefix('professor')->name('professor.')->group(function () {
    Route::get('/dashboard', InstructorDashboard::class)->name('dashboard');

    //Group Masterlist Routes
    Route::get('/courses', InstructorCourses::class)->name('courses');
    Route::get('/courses/{course_id}', InstructorSections::class)->name('courses.section');
    Route::get('/courses/{course_id}/{section_id}', InstructorGroups::class)->name('courses.section.groups');

    
});

//student routes
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', StudentDashboard::class)->name('dashboard');
});