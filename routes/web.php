<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAccountIsActive;
use App\Http\Middleware\EnsureIsAdminOrSecretaire;
use Illuminate\Support\Facades\Route;

// Page d'accueil : Redirection directe vers le login
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/mentions-legales', function () {
    return view('mentions-legales');
})->name('mentions.legales');

Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->name('newsletter.store');
Route::view('/confidentialite', 'confidentialite')->name('privacy');


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');
// Routes protégées par l'authentification ET la vérification que le compte est actif ('active')
Route::middleware(['auth', 'verified', 'active'])->group(function () {

    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Gestion du profil personnel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Resource CRUD pour les fiches (leads)
    Route::resource('leads', LeadController::class);

    // 4. Resource CRUD complet + Toggle Status pour les utilisateurs (UserController)
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('users', UserController::class);

    Route::resource('teams', TeamController::class)->except(['show']);
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->middleware('auth');

    // Route pour marquer une notification comme lue
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->middleware('auth');


    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');


    Route::post('/calendar/events', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get(
        '/newsletters',
        [AdminNewsletterController::class, 'index']
    )->name('newsletters.index');

    Route::delete(
        '/newsletters/{newsletter}',
        [AdminNewsletterController::class, 'destroy']
    )->name('newsletters.destroy');

    // Route Admin pour changer le statut
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});

// 5. Routes d'import/export réservées aux Admins et Secrétaires
Route::middleware(['auth', 'active', EnsureIsAdminOrSecretaire::class])->group(function () {
    Route::get('/leads/export/file', [LeadController::class, 'export'])->name('leads.export');
    Route::post('/leads/import/file', [LeadController::class, 'import'])->name('leads.import');
});

require __DIR__ . '/auth.php';