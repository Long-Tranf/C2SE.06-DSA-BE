<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigBannersController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipFeeController;
use App\Http\Controllers\MembershipFeeDetailsController;
use App\Http\Controllers\PhotoLibraryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserController;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/Categories/data', [CategoriesController::class, 'getData']);
Route::get('/categories/{id}', [CategoriesController::class, 'getDataById']);
Route::post('/Categories/create', [CategoriesController::class, 'store']);
Route::delete('/Categories/delete{id}', [CategoriesController::class, 'destroy']);
Route::put('/Categories/update', [CategoriesController::class, 'update']);
Route::get('/categories/children/{parent_category_id}', [CategoriesController::class, 'getChildCategories']);
Route::get('/categories/{id}/posts', [CategoriesController::class, 'getPostsByCategory']);

Route::get('/ConfigBanners/data', [ConfigBannersController::class, 'getData']);
Route::get('/banners/top', [ConfigBannersController::class, 'getTopBanners']);
Route::post('/ConfigBanners/create', [ConfigBannersController::class, 'store']);
Route::delete('/ConfigBanners/delete{id}', [ConfigBannersController::class, 'destroy']);
Route::put('/ConfigBanners/update', [ConfigBannersController::class, 'update']);


Route::get('/Document/data', [DocumentController::class, 'getData']);
Route::post('/Document/create', [DocumentController::class, 'store']);
Route::delete('/Document/delete{id}', [DocumentController::class, 'destroy']);
Route::put('/Document/update', [DocumentController::class, 'update']);

Route::get('/Events/data', [EventsController::class, 'getData']);
Route::post('/Events/create', [EventsController::class, 'store']);
Route::delete('/Events/delete{id}', [EventsController::class, 'destroy']);
Route::put('/Events/update', [EventsController::class, 'update']);
Route::get('/events/organizer/{organizer_id}', [EventsController::class, 'getEventsByOrganizer']);
Route::get('/Events/total', [EventsController::class, 'getTotalEvents']);
Route::get('/events/latest', [EventsController::class, 'getLatestEvents']);
Route::get('/events/happening', [EventsController::class, 'getEventsIsHappening']);
Route::get('/events/upcoming', [EventsController::class, 'getUpcomingEvents']);

Route::get('/PhotoLibrary/data', [PhotoLibraryController::class, 'getData']);
Route::post('/PhotoLibrary/create', [PhotoLibraryController::class, 'store']);
Route::delete('/PhotoLibrary/delete{id}', [PhotoLibraryController::class, 'destroy']);
Route::put('/PhotoLibrary/update', [PhotoLibraryController::class, 'update']);

Route::get('/Post/data', [PostController::class, 'getData']);
Route::post('/Post/create', [PostController::class, 'store']);
Route::delete('/Post/delete{id}', [PostController::class, 'destroy']);
Route::put('/Post/update', [PostController::class, 'update']);
Route::get('/Post/data/{id}', [PostController::class, 'getPostById']);
Route::get('/posts/latest', [PostController::class, 'latest']);
Route::get('/posts/search', [PostController::class, 'search']);
Route::get('/posts/top', [PostController::class, 'getTopPosts']);
Route::get('/posts/latest/{category_id}', [PostController::class, 'getLatestPostsByCategory']);
Route::get('/posts/recommend', [PostController::class, 'recommend']);
Route::get('/posts/member/{member_id}', [PostController::class, 'getPostsByMember']);
Route::get('/Posts/latest-five', [PostController::class, 'getLatestPosts']);
Route::get('/posts/total', [PostController::class, 'getTotalPosts']);
Route::get('/posts/top-excluding/{id}', [PostController::class, 'getTopPostsExcludingCurrent']);
Route::get('/posts/view/{id}', [PostController::class, 'xemBaiViet']);

Route::get('/Association/data', [AssociationController::class, 'getData']);
Route::post('/Association/create', [AssociationController::class, 'store']);
Route::delete('/Association/delete{id}', [AssociationController::class, 'destroy']);
Route::put('/associations/update', [AssociationController::class, 'update']);
Route::get('/associations/avatars', [AssociationController::class, 'getAllAvatars']);
Route::get('/Associations/recommend', [AssociationController::class, 'recommend']);
Route::get('/Associations/{id}', [AssociationController::class, 'getAssociationById']);
Route::get('/Associations-total', [AssociationController::class, 'getTotalAssociations']);
Route::put('/Associations/update/{id}', [AssociationController::class,'updateAssociation']);

Route::get('/MembershipFee/data', [MembershipFeeController::class, 'getData']);
Route::post('/MembershipFee/create', [MembershipFeeController::class, 'store']);
Route::delete('/MembershipFee/delete{id}', [MembershipFeeController::class, 'destroy']);
Route::put('/MembershipFee/update', [MembershipFeeController::class, 'update']);
Route::put('/member/update/{id}', [MemberController::class, 'updateMember']);

Route::get('/MembershipFeeDetails/data', [MembershipFeeDetailsController::class, 'getData']);
Route::post('/MembershipFeeDetails/create', [MembershipFeeDetailsController::class, 'store']);
Route::delete('/MembershipFeeDetails/delete{id}', [MembershipFeeDetailsController::class, 'destroy']);
Route::put('/MembershipFeeDetails/update', [MembershipFeeDetailsController::class, 'update']);

Route::get('/Contact/data', [ContactController::class, 'getData']);
Route::post('/Contact/create', [ContactController::class, 'store']);
Route::delete('/Contact/delete{id}', [ContactController::class, 'destroy']);
Route::put('/Contact/update', [ContactController::class, 'update']);
Route::get('/Contacts/totaltoday', [ContactController::class, 'getTotalContactsToday']);


Route::get('/member/data', [MemberController::class, 'getData']);
Route::post('/member/create', [MemberController::class, 'store']);
Route::delete('/member/delete{id}', [MemberController::class, 'destroy']);
Route::put('/member/update', [MemberController::class, 'update']);
Route::get('/members/total', [MemberController::class, 'getTotalMembers']);
Route::put('/member/update/{id}', [MemberController::class, 'updateMember']);



Route::post('/dang-ky', [MemberController::class, 'dangKy']);
Route::post('/association/dang-nhap', [AssociationController::class, 'dangNhap']);
Route::post('/member/dang-nhap', [MemberController::class, 'dangNhap']);
Route::get('/posts/{id}/view', [PostController::class, 'xemBaiViet']);
Route::put('/member/{id}/change-password', [MemberController::class, 'changePassword']);


Route::get('/tracking', [TrackingController::class, 'totalVisitCount']);
Route::get('/tracking/today', [TrackingController::class, 'vitsitcountBydate']);
Route::get('/tracking/latest', [TrackingController::class, 'latestTracking']);

Route::middleware('auth:sanctum')->get('/kiem-tra-token-member', [MemberController::class, 'kiemTraToken']);
Route::middleware('auth:sanctum')->get('/kiem-tra-token-association', [AssociationController::class, 'kiemTraToken']);


Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/update', [MemberController::class, 'updateCurrentUser']);
});
