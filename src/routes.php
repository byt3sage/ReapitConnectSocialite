<?php

Route::get('/rc-login', 'JaeTooleDev\ReapitConnectSocialite@redirectToProvider');
Route::get('/callback', 'JaeTooleDev\ReapitConnectSocialite@handleProviderCallback');