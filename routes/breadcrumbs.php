<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Position
Breadcrumbs::for('admin.position', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Jabatan', route('admin.position.index'));
});

// Position > Create
Breadcrumbs::for('admin.position.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.position');
    $trail->push('Tambah', route('admin.position.create'));
});

// Position > Edit
Breadcrumbs::for('admin.position.edit', function (BreadcrumbTrail $trail, $position) {
    $trail->parent('admin.position');
    $trail->push($position->name);
    $trail->push('Ubah', route('admin.position.edit', $position));
});
