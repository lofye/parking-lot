<?php

Route::post('/tickets', 'Controllers/Tickets@store');
Route::get('/tickets/{ticket}', 'Controllers/Tickets@show');

Route::post('/payments/{ticket}', 'Controllers/Payments@store');
