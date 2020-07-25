<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('user')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {

    Route::get('/', 'CredentialController@infoUI')->name('user');

    // Show login settings
    Route::get('/general', 'CredentialController@infoUI')->name('general');
    // Update email
    Route::get('/email/update', 'CredentialController@updateEmailUI')->name('email-update');
    Route::post('/email/update-result', 'CredentialController@doUpdateEmail')->name('email-update-result');
    Route::get('/email/resend', 'CredentialController@resendEmail')->name('resend-email');
    // Update phone
    Route::get('/phone/update', 'CredentialController@verifyPhoneUI')->name('phone-update');
    Route::post('/phone/update-result', 'CredentialController@doVerifyPhone')->name('phone-update-result');
    Route::get('/phone/resend', 'CredentialController@resendVerifyPhone')->name('resend-phone');
    // Update password
    Route::get('/pass/update', 'CredentialController@updatePasswordUI')->name('pass-update');
    Route::post('/pass/update-result', 'CredentialController@doUpdatePassword')->name('pass-update-result');

    // Show security settings
    Route::get('/secure', 'SecurityController@infoUI')->name('secure');
    // Secure by email
    Route::get('/secure/update-email', 'SecurityController@updateEmailUI')->name('secure-update-email');
    Route::post('/secure/update-email-result', 'SecurityController@doUpdateEmail')->name('secure-update-email-result');
    Route::get('/secure/resend-mail', 'SecurityController@resendEmail')->name('secure-resend-email');
    // Secure by password2
    Route::get('/secure/update-pass2', 'SecurityController@updatePass2')->name('secure-update-pass2');
    Route::post('/secure/update-pass2-result', 'SecurityController@doUpdatePass2')->name('secure-update-pass2-result');
    // Secure by question&answer
    Route::get('/secure/update-qna', 'SecurityController@updateQna')->name('secure-update-qna');
    Route::post('/secure/update-qna-result', 'SecurityController@doUpdateQna')->name('secure-update-qna-result');
    // Show personal settings
    Route::get('/personal', 'CredentialController@personalInfo')->name('personal');
    Route::get('/personal/update', 'CredentialController@updatePersonalUI')->name('personal-update');
    Route::post('/personal/update-result', 'CredentialController@doUpdatePersonal')->name('personal-update-result');
});

Route::middleware('web')->prefix('user')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {
    // Public routes
    Route::get('/email/verify/{token}', 'PublicController@verifyEmail')->name('email-verify');
    Route::get('/secure/verify/{token}', 'PublicController@verifySecureEmail')->name('secure-verify');
    // Reset password
    Route::get('/pass/forgot', 'PublicController@forgotPassUI')->name('forgot');
    Route::post('/pass/forgot-by-email', 'PublicController@forgotPass')->name('pass-forgot-do');
    // Reset process
    Route::get('/pass/reset', 'PublicController@resetPassUI')->name('pass-reset');
    Route::post('/pass/reset/do', 'PublicController@resetPass')->name('pass-reset-do');
});
