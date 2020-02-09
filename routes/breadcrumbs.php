<?php

use App\Facades\Helper as H;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', H::client_route('/'));
});

// Home > blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', H::client_route('/blog'));
});
