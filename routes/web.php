<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackpackController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\GpxController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeatherFavoriteController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\BudgetController;




Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    // Profile 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // News 
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/dashboard/news', [NewsController::class, 'dashboard'])->name('dashboard.news');

    // Item 
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

    // Backpack 
    Route::get('/backpack/{item}/edit', [BackpackController::class, 'edit'])->name('backpack.edit');
    Route::put('/backpack/{item}', [BackpackController::class, 'update'])->name('backpack.update');
    Route::get('/backpack', [BackpackController::class, 'index'])->name('backpack.index');
    Route::get('/backpack/create', [BackpackController::class, 'create'])->name('backpack.create');
    Route::post('/backpack', [BackpackController::class, 'store'])->name('backpack.store');
    Route::delete('/backpack/{item}', [BackpackController::class, 'destroy'])->name('backpack.destroy');
    Route::get('/backpacks/{backpack}', [BackpackController::class, 'show'])->name('backpacks.show');
    Route::get('/backpack/{backpack}/edit-backpack', [BackpackController::class, 'editBackpack'])->name('backpack.editBackpack');
    Route::put('/backpack/{backpack}/update-backpack', [BackpackController::class, 'updateBackpack'])->name('backpack.updateBackpack');

    // Map 
    Route::get('/map', [MapController::class, 'show'])->name('map.show');
    Route::post('/upload-gpx', [GpxController::class, 'uploadGpx'])->name('gpx.upload');
    Route::post('/gpx/clear', [GpxController::class, 'clearGpxFiles'])->name('gpx.clear');
    Route::delete('/gpx/{gpxFile}', [GpxController::class, 'delete'])->name('gpx.delete');
    Route::get('/gpx/download/{gpxFile}', [GpxController::class, 'download'])->name('gpx.download');

    // Weather 
    Route::get('/weather', [WeatherController::class, 'showWeatherForm'])->name('weather.form');
    Route::post('/weather', [WeatherController::class, 'getWeather'])->name('weather.get');
    Route::get('/autocomplete', [WeatherController::class, 'autocomplete']);
    Route::post('/weather-favorites', [WeatherFavoriteController::class, 'store'])->name('weatherFavorites.store');
    Route::delete('/weather-favorites/{id}', [WeatherFavoriteController::class, 'destroy'])->name('weatherFavorites.remove');
    Route::get('/weather/details/{id}', [WeatherController::class, 'show'])->name('weather.details');

    // Trek (adventure)
    Route::resource('treks', TrekController::class);

    //Forum
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/category/{categoryId}', [ForumController::class, 'showCategory'])->name('forum.category');
    Route::get('/forum/discussion/{discussionId}', [ForumController::class, 'showDiscussion'])->name('forum.discussion');
    Route::post('/forum/discussion', [ForumController::class, 'storeDiscussion'])->name('forum.discussion.store');
    Route::post('/forum/discussion/{discussionId}/post', [ForumController::class, 'storePost'])->name('forum.discussion.post');

    //Budget
    Route::resource('budgets', BudgetController::class);
    Route::post('budgets/{budget}/participants', [BudgetController::class, 'addParticipant'])->name('budgets.addParticipant');
    Route::post('budgets/{budget}/transactions', [BudgetController::class, 'storeTransaction'])->name('budgets.storeTransaction');


    

});

require __DIR__.'/auth.php';
