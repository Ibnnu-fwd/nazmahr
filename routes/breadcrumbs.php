<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Attendance Time Config
Breadcrumbs::for('admin.attendance-time-config', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Konfigurasi Jam Kerja', route('admin.attendance-time-config.index'));
});

// Attendance Time Config > Create
Breadcrumbs::for('admin.attendance-time-config.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attendance-time-config');
    $trail->push('Tambah', route('admin.attendance-time-config.create'));
});

// Attendance Time Config > Edit
Breadcrumbs::for('admin.attendance-time-config.edit', function (BreadcrumbTrail $trail, $attendanceTimeConfig) {
    $trail->parent('admin.attendance-time-config');
    $trail->push($attendanceTimeConfig->day);
    $trail->push('Ubah', route('admin.attendance-time-config.edit', $attendanceTimeConfig));
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

// Employee
Breadcrumbs::for('admin.employee', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Karyawan', route('admin.employee.index'));
});

// Employee > Create
Breadcrumbs::for('admin.employee.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.employee');
    $trail->push('Tambah', route('admin.employee.create'));
});

// Employee > Edit
Breadcrumbs::for('admin.employee.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('admin.employee');
    $trail->push($employee->name);
    $trail->push('Ubah', route('admin.employee.edit', $employee));
});

// Casbon
Breadcrumbs::for('admin.casbon', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Kasbon', route('admin.casbon.index'));
});

// Casbon > Create
Breadcrumbs::for('admin.casbon.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.casbon');
    $trail->push('Tambah', route('admin.casbon.create'));
});

// Casbon > Edit
Breadcrumbs::for('admin.casbon.edit', function (BreadcrumbTrail $trail, $casbon) {
    $trail->parent('admin.casbon');
    $trail->push($casbon->user->name);
    $trail->push('Ubah', route('admin.casbon.edit', $casbon));
});
