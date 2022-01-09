<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('خانه', route('admin.dashboard'));
});
Breadcrumbs::for('positions', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست سمت ها', route('positions.index'));
});

Breadcrumbs::for('create', function ($trail) {
    $trail->parent('positions');
    $trail->push('سمت جدید', route('positions.create'));
});
Breadcrumbs::for('companies', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست شرکت ها', route('positions.index'));
});

Breadcrumbs::for('createCompany', function ($trail) {
    $trail->parent('companies');
    $trail->push('شرکت جدید', route('positions.create'));
});
Breadcrumbs::for('home_prices', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست اجاره بها ', route('positions.index'));
});

Breadcrumbs::for('createHome_prices', function ($trail) {
    $trail->parent('home_prices');
    $trail->push('اجاره بها جدید', route('positions.create'));
});
Breadcrumbs::for('home_kinds', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست انواع منازل', route('positions.index'));
});

Breadcrumbs::for('createHome_kinds', function ($trail) {
    $trail->parent('home_kinds');
    $trail->push('منزل جدید', route('positions.create'));
});
Breadcrumbs::for('homes', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست  منازل', route('positions.index'));
});

Breadcrumbs::for('createHomes', function ($trail) {
    $trail->parent('homes');
    $trail->push('منزل جدید', route('positions.create'));
});
Breadcrumbs::for('employees', function ($trail) {
    $trail->parent('home');
    $trail->push('لیست  پرسنل', route('positions.index'));
});

Breadcrumbs::for('createEmployees', function ($trail) {
    $trail->parent('homes');
    $trail->push('پرسنل جدید', route('positions.create'));
});
