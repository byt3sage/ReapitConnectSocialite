<?php
Route::group(['middleware' => ['web']], function() {
    Route::get('/rc-login', 'JaeTooleDev\ReapitConnectSocialite\ReapitConnectLoginController@redirectToProvider');
    Route::get('/callback', 'JaeTooleDev\ReapitConnectSocialite\ReapitConnectLoginController@handleProviderCallback');
});
