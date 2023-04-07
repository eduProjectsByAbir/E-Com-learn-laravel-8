<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

include(base_path('routes/commands.php'));
include(base_path('routes/frontend.php'));
include(base_path('routes/admin.php'));
include(base_path('routes/backend.php'));
include(base_path('routes/user.php'));
include(base_path('routes/payments.php'));

Route::any('/test', function () {
    dd(Auth::guard('web')->user());
});
