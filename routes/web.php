<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\Investor\InvestorProjectController;
use App\Http\Controllers\InvestmentController;

// Public routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/pricing', function () {
    return view('pricing');
});

use App\Http\Controllers\MessagingController;

use App\Http\Controllers\ChatController;

Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index'); // List conversations
    Route::get('/chat/{receiverId}', [ChatController::class, 'show'])->name('chat.show'); // View a specific chat
    Route::post('/chat/message', [ChatController::class, 'store'])->name('chat.store'); // Send a message
    Route::post('/chat/start/{userId}', [ChatController::class, 'start'])->name('chat.start'); // Start a new chat
});





// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(base_path('routes/admin.php'));

// Entrepreneur routes
Route::middleware(['auth', 'entrepreneur'])->prefix('entrepreneur')->group(function () {
    Route::get('/home', [EntrepreneurController::class, 'home'])->name('entrepreneur.home');
    // ...other entrepreneur routes...
    require base_path('routes/entrepreneur.php');
});

Route::resource('projects', ProjectController::class)->except(['index']);

Route::middleware(['auth', 'entrepreneur'])->group(function () {
    Route::get('/dashboard', [EntrepreneurController::class, 'dashboard'])->name('entrepreneur.dashboard');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/financial', [EntrepreneurController::class, 'financial'])->name('entrepreneur.financial');
    Route::get('/entrepreneur/profile', [ProfileController::class, 'show'])->name('entrepreneur.profile');
    Route::post('/entrepreneur/profile/update', [ProfileController::class, 'update'])->name('entrepreneur.profile.update');
    Route::get('/chat', function () {
        return view('entrepreneur.chat');
    })->name('entrepreneur.chat');
});

// Include route files
require __DIR__ . '/admin.php';
require __DIR__ . '/entrepreneur.php';

Route::middleware(['auth'])->group(function () {
    // ...existing routes...
    Route::post('/entrepreneur/profile/update', [ProfileController::class, 'update'])->name('entrepreneur.profile.update');
});

// Investor routes
Route::middleware(['auth', 'investor'])->prefix('investor')->group(function () {
    Route::get('/home', [InvestorController::class, 'home'])->name('investor.home');
    Route::get('/projects', [InvestorProjectController::class, 'index'])->name('investor.projects');
    Route::get('/projects/{project}', [InvestorProjectController::class, 'show'])->name('investor.project.details');
    Route::get('/portfolio', [InvestorController::class, 'portfolio'])->name('investor.portfolio');
    Route::get('/financial', [InvestorController::class, 'financial'])->name('investor.financial');
    Route::get('/profile', [InvestorController::class, 'profile'])->name('investor.profile');
    Route::post('/profile/update', [InvestorController::class, 'updateProfile'])->name('investor.profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('investor.logout');
    Route::get('/filter-projects', [InvestorProjectController::class, 'filterProjects'])->name('investor.filter.projects');
    Route::get('/investor/portfolio', function () {
        return view('investor.portfolio');
    });
    Route::get('/investor/financial', [InvestorController::class, 'financial'])->name('investor.financial');
    Route::post('/deposit', [InvestorController::class, 'deposit'])->name('investor.deposit');
    Route::get('/chat', function () {
        return view('investor.chat');
    })->name('investor.chat');
});

Route::post('/investor/projects/{project}/invest', [InvestmentController::class, 'invest'])->name('investor.invest')->middleware('auth');
