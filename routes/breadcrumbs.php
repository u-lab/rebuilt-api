<?php

use App\Facades\Helper as H;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', H::client_route('/'));
});

// Home > [user]
Breadcrumbs::for('pages_user', function ($trail, array $data) {
    $trail->parent('home');
    $trail->push($data['user'], H::client_route('/pages' . '/' . $data['user']));
});

// Home > [user] > [storage_id]
Breadcrumbs::for('pages_storage_id', function ($trail, array $data) {
    $trail->parent('pages_user');
    $path = '/pages' . '/' . $data['user'] . '/storages' . '/' . $data['storage_id'];
    $trail->push($data['storage_id'], H::client_route($path));
});

// Home > login
Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Login', H::client_route('/login'));
});

// Home > register
Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push('Register', H::client_route('/register'));
});

// Home > sitemap
Breadcrumbs::for('sitemap', function ($trail) {
    $trail->parent('home');
    $trail->push('Sitemap', H::client_route('/sitemap'));
});
