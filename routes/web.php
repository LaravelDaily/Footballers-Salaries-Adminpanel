<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('countries', 'Admin\CountriesController');
    Route::post('countries_mass_destroy', ['uses' => 'Admin\CountriesController@massDestroy', 'as' => 'countries.mass_destroy']);
    Route::post('countries_restore/{id}', ['uses' => 'Admin\CountriesController@restore', 'as' => 'countries.restore']);
    Route::delete('countries_perma_del/{id}', ['uses' => 'Admin\CountriesController@perma_del', 'as' => 'countries.perma_del']);
    Route::resource('seasons', 'Admin\SeasonsController');
    Route::post('seasons_mass_destroy', ['uses' => 'Admin\SeasonsController@massDestroy', 'as' => 'seasons.mass_destroy']);
    Route::post('seasons_restore/{id}', ['uses' => 'Admin\SeasonsController@restore', 'as' => 'seasons.restore']);
    Route::delete('seasons_perma_del/{id}', ['uses' => 'Admin\SeasonsController@perma_del', 'as' => 'seasons.perma_del']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::post('teams_restore/{id}', ['uses' => 'Admin\TeamsController@restore', 'as' => 'teams.restore']);
    Route::delete('teams_perma_del/{id}', ['uses' => 'Admin\TeamsController@perma_del', 'as' => 'teams.perma_del']);
    Route::resource('players', 'Admin\PlayersController');
    Route::post('players_mass_destroy', ['uses' => 'Admin\PlayersController@massDestroy', 'as' => 'players.mass_destroy']);
    Route::post('players_restore/{id}', ['uses' => 'Admin\PlayersController@restore', 'as' => 'players.restore']);
    Route::delete('players_perma_del/{id}', ['uses' => 'Admin\PlayersController@perma_del', 'as' => 'players.perma_del']);
    Route::resource('salaries', 'Admin\SalariesController');
    Route::post('salaries_mass_destroy', ['uses' => 'Admin\SalariesController@massDestroy', 'as' => 'salaries.mass_destroy']);
    Route::post('salaries_restore/{id}', ['uses' => 'Admin\SalariesController@restore', 'as' => 'salaries.restore']);
    Route::delete('salaries_perma_del/{id}', ['uses' => 'Admin\SalariesController@perma_del', 'as' => 'salaries.perma_del']);



    Route::get('search', 'MegaSearchController@search')->name('mega-search');
});
