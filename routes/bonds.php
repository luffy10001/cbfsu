<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BondController;

Route::group(['prefix'=>'bonds','groupName' => 'Bonds', 'access' => 'all'], function () {
    Route::get('/', [BondController::class, 'index'])->name('bond.index')->defaults('title','Listing');
    Route::get('create', [BondController::class, 'create'])->name('bond.create')->defaults('title','Create');
    Route::post('store', [BondController::class, 'store'])->name('bond.store')->defaults('title','Save');
    Route::get('create/{id}', [BondController::class, 'create'])->name('bond.edit')->defaults('title','Edit');
    Route::post('update', [BondController::class, 'update'])->name('bond.update')->defaults('title','Update');
//    Route::get('{bond}/view', [BondController::class, 'view'])->name('bond.view')->defaults('title','Details');
    Route::post('delete/{id}',[BondController::class,'delete'])->name('bond.delete')->defaults('title','Delete');
    Route::post('status/{id}/{status}',[BondController::class,'status'])->name('bond.status')->defaults('title','Status');
    Route::get('bid-bond-pdf/{id}',[BondController::class,'viewBidBondPdf'])->name('bond.bidBondPdf')->defaults('title','Bid Bond Pdf');
//    Route::get('attorney-pdf/{id}',[BondController::class,'viewAttorneyPdf'])->name('bond.attorneyPdf')->defaults('title','Power of Attorney Pdf');
    Route::get('per-pay-pdf/{id}',[BondController::class,'viewPerformancePaymentPdf'])->name('bond.viewPerformancePaymentPdf')->defaults('title','Performance & Payment Pdf');
    Route::post('issue-docs/{id}',[BondController::class,'IssueDocuments'])->name('bond.issue-docs')->defaults('title','Issue Bid Bond Documents');


    Route::get('convert-to-Performance/{id}',[BondController::class,'convertToPerformance'])->name('bond.convertToPerformance')->defaults('title','Create Convert inTo Performance');
    Route::post('store-convert-to-Performance',[BondController::class,'storeConvertToPerformance'])->name('bond.storeConvertToPerformance')->defaults('title','Save Convert inTo Performance');
    Route::post('cancel-request/{id}',[BondController::class,'cancelRequest'])->name('bond.cancelRequest')->defaults('title','Cancel Request');
    Route::post('issue-performance-doc/{id}',[BondController::class,'issuePerformanceDoc'])->name('bond.issuePerformanceDoc')->defaults('title','Issue Payment & Performance Documents');

    Route::get('review-bid-bond-document/{id}',[BondController::class,'detailBidBondDocument'])->name('bond.reviewBidBondDocument')->defaults('title','Review Bid Bond Documents');
    Route::get('review-performance-bond-document/{id}',[BondController::class,'reviewPerformanceBondDocument'])->name('bond.reviewPerformanceBondDocument')->defaults('title','Review Performance Bond Documents');
    Route::get('{bond}/view', [BondController::class, 'view'])->name('bond.view')->defaults('title','Details');


});


