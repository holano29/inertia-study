<?php

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::middleware('auth')->group( function () {

    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', function () {

        return Inertia::render('Users/Index',[
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                    -> paginate(10)
                    ->withQueryString()
                    ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),

                'filters' => Request::only(['search']),
                'can' => [
                    'createUser' => Auth::user()->can('create', User::class)
                ]
        ]);
        
        // Remember that map() return only the current 10
        // then destroy those objects after a request is sent to
        // return another set of data,
        // to solve that use through() instead of map()

        
        // return Inertia::render('Users', [
        //     'users' => User::all()->map(fn($users) => [
        //         'id' => $users->id,
        //         'name' => $users->name
        //     ])
        // ]);
    });


    // For Newer Version of Laravel
    Route::get('/users/create', function(){
        return Inertia::render('Users/Create');
    })->can('create, App\Models\User');

    // For older version of Laravel
    // Route::get('/users/create', function(){
    //     return Inertia::render('Users/Create');
    // })->middleware('can:create, App\Models\User');


    Route::post('/users', function(){
        //sleep(3);
        // Validate the request
        $attributes = Request::validate([
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => 'required',
            ]);

        // Create the user
        User::create($attributes);

        // Redirect Somewhere
        return redirect('/users');
    });


    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

});