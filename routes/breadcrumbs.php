<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', '/');
});

// Home > blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', '/blog');
});
