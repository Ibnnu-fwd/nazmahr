<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Str;

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

// Overtime
Breadcrumbs::for('admin.overtime', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Lembur', route('admin.overtime.index'));
});

// Overtime > Create
Breadcrumbs::for('admin.overtime.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.overtime');
    $trail->push('Tambah', route('admin.overtime.create'));
});

// Overtime > Edit
Breadcrumbs::for('admin.overtime.edit', function (BreadcrumbTrail $trail, $overtime) {
    $trail->parent('admin.overtime');
    $trail->push($overtime->user->name);
    $trail->push('Ubah', route('admin.overtime.edit', $overtime));
});

// Permit Leave
Breadcrumbs::for('admin.permit-leave', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Izin / Cuti', route('admin.permit-leave.index'));
});

// Permit Leave > Create
Breadcrumbs::for('admin.permit-leave.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.permit-leave');
    $trail->push('Tambah', route('admin.permit-leave.create'));
});

// Permit Leave > Edit
Breadcrumbs::for('admin.permit-leave.edit', function (BreadcrumbTrail $trail, $permitLeave) {
    $trail->parent('admin.permit-leave');
    $trail->push(Str::limit($permitLeave->id, 10));
    $trail->push('Ubah', route('admin.permit-leave.edit', $permitLeave));
});

// Task Type
Breadcrumbs::for('admin.task-type', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Tipe Tugas', route('admin.task-type.index'));
});

// Task Type > Create
Breadcrumbs::for('admin.task-type.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.task-type');
    $trail->push('Tambah', route('admin.task-type.create'));
});

// Task Type > Edit
Breadcrumbs::for('admin.task-type.edit', function (BreadcrumbTrail $trail, $taskType) {
    $trail->parent('admin.task-type');
    $trail->push($taskType->name);
    $trail->push('Ubah', route('admin.task-type.edit', $taskType));
});

// Task
Breadcrumbs::for('admin.task', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Tugas', route('admin.task.index'));
});

// Task > Create
Breadcrumbs::for('admin.task.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.task');
    $trail->push('Tambah', route('admin.task.create'));
});

// Task > Edit
Breadcrumbs::for('admin.task.edit', function (BreadcrumbTrail $trail, $task) {
    $trail->parent('admin.task');
    $trail->push(Str::limit($task->id, 10));
    $trail->push('Ubah', route('admin.task.edit', $task));
});

// Announcement
Breadcrumbs::for('admin.announcement', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pengumuman', route('admin.announcement.index'));
});

// Announcement > Create
Breadcrumbs::for('admin.announcement.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.announcement');
    $trail->push('Tambah', route('admin.announcement.create'));
});

// Announcement > Edit
Breadcrumbs::for('admin.announcement.edit', function (BreadcrumbTrail $trail, $announcement) {
    $trail->parent('admin.announcement');
    $trail->push($announcement->code);
    $trail->push('Ubah', route('admin.announcement.edit', $announcement));
});

// Attendance Type
Breadcrumbs::for('admin.attendance-type', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Jenis Kehadiran', route('admin.attendance-type.index'));
});

// Attendance Type > Create
Breadcrumbs::for('admin.attendance-type.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attendance-type');
    $trail->push('Tambah', route('admin.attendance-type.create'));
});

// Attendance Type > Edit
Breadcrumbs::for('admin.attendance-type.edit', function (BreadcrumbTrail $trail, $attendanceType) {
    $trail->parent('admin.attendance-type');
    $trail->push($attendanceType->name);
    $trail->push('Ubah', route('admin.attendance-type.edit', $attendanceType));
});

// Request Attendance
Breadcrumbs::for('admin.request-attendance', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Request Kehadiran', route('admin.request-attendance.index'));
});

// Request Attendance > Create
Breadcrumbs::for('admin.request-attendance.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.request-attendance');
    $trail->push('Tambah', route('admin.request-attendance.create'));
});

// Request Attendance > Edit    
Breadcrumbs::for('admin.request-attendance.edit', function (BreadcrumbTrail $trail, $requestAttendance) {
    $trail->parent('admin.request-attendance');
    $trail->push($requestAttendance->user->name);
    $trail->push('Ubah', route('admin.request-attendance.edit', $requestAttendance));
});

// Reprimand
Breadcrumbs::for('admin.reprimand', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Surat Peringatan', route('admin.reprimand.index'));
});

// Reprimand > Create
Breadcrumbs::for('admin.reprimand.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.reprimand');
    $trail->push('Tambah', route('admin.reprimand.create'));
});

// Reprimand > Edit
Breadcrumbs::for('admin.reprimand.edit', function (BreadcrumbTrail $trail, $reprimand) {
    $trail->parent('admin.reprimand');
    $trail->push($reprimand->user->name);
    $trail->push('Ubah', route('admin.reprimand.edit', $reprimand));
});

// Attendance
Breadcrumbs::for('admin.attendance', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Presensi', route('admin.attendance.index'));
});

// Time Tracker
Breadcrumbs::for('admin.time-tracker', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Time Tracker', route('admin.time-tracker.index'));
});

// Time Tracker > Create
Breadcrumbs::for('admin.time-tracker.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.time-tracker');
    $trail->push('Tambah', route('admin.time-tracker.create'));
});

// Time Tracker > Edit
Breadcrumbs::for('admin.time-tracker.edit', function (BreadcrumbTrail $trail, $timeTracker) {
    $trail->parent('admin.time-tracker');
    $trail->push($timeTracker->user->name);
    $trail->push('Ubah', route('admin.time-tracker.edit', $timeTracker));
});
