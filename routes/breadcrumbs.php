<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('خانه', route('admin.dashboard'));
});
Breadcrumbs::for('positions', function ($trail) {
    $trail->parent('home');
    $trail->push('سمت', route('positions.index'));
});

Breadcrumbs::for('create', function ($trail) {
    $trail->parent('positions');
    $trail->push('سمت جدید', route('positions.create'));
});
