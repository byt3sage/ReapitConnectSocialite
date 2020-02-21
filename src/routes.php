<?php
Route::group(['middleware' => ['web']], function() {
    Route::get('/reapit/login', 'JaeTooleDev\ReapitConnectSocialite\ReapitConnectLoginController@redirectToProvider');
    Route::get('/reapit/callback', 'JaeTooleDev\ReapitConnectSocialite\ReapitConnectLoginController@handleProviderCallback');
});
