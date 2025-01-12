<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Auth\Register;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\ResetPassword;
use App\Livewire\Admin\Auth\Logout;
use App\Livewire\Admin\Dashboard;
// Users
use App\Livewire\Admin\User\UserList;
use App\Livewire\Admin\User\UserCreate;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Admin\User\UserShow;

// if route is /admin redirect to admin/dashboard

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {

        // Register
        Route::get('register', Register::class)->name('register');

        // Login
        Route::get('login', Login::class)->name('login');

        // Forgot Password
        Route::get('forgot-password', ForgotPassword::class)->name('forgot.password');

        // Reset Password
        Route::get('reset/{email}/{token}', ResetPassword::class)->name('password.reset');
    });

    Route::middleware('auth:admin')->group(function () {

        // Logout
        Route::get('logout', Logout::class)->name('logout');

        // Dashboard
        Route::get('dashboard', Dashboard::class)->name('dashboard');

        /**
         * Users
         */
        // User List
        Route::get('users', UserList::class)->name('users');
        // User Create
        Route::get('user/create', UserCreate::class)->name('user.create');
        // User Edit
        Route::get('user/{id}/edit', UserEdit::class)->name('user.edit');
        // User Show
        Route::get('user/{id}', UserShow::class)->name('user.show');
    });
});
