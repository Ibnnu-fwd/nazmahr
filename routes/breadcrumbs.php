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

// Permit Leave > Show
Breadcrumbs::for('admin.permit-leave.show', function (BreadcrumbTrail $trail, $permitLeave) {
    $trail->parent('admin.permit-leave');
    $trail->push(Str::limit($permitLeave->id, 10));
    $trail->push('Detail', route('admin.permit-leave.show', $permitLeave));
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

// Request Reimbursement
Breadcrumbs::for('admin.request-reimbursement', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Request Reimbursement', route('admin.request-reimbursement.index'));
});

// Request Reimbursement > Create
Breadcrumbs::for('admin.request-reimbursement.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.request-reimbursement');
    $trail->push('Tambah', route('admin.request-reimbursement.create'));
});

// Request Reimbursement > Edit    
Breadcrumbs::for('admin.request-reimbursement.edit', function (BreadcrumbTrail $trail, $requestreimbursement) {
    $trail->parent('admin.request-reimbursement');
    $trail->push($requestreimbursement->title);
    $trail->push('Ubah', route('admin.request-reimbursement.edit', $requestreimbursement));
});

// Request Reimbursement > Show
Breadcrumbs::for('admin.request-reimbursement.show', function (BreadcrumbTrail $trail, $requestreimbursement) {
    $trail->parent('admin.request-reimbursement');
    $trail->push($requestreimbursement->title);
    $trail->push('Detail', route('admin.request-reimbursement.show', $requestreimbursement));
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

// Attendance > Create
Breadcrumbs::for('admin.attendance.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attendance');
    $trail->push('Tambah Manual', route('admin.attendance.create'));
});

// Attendance > Edit
Breadcrumbs::for('admin.attendance.edit', function (BreadcrumbTrail $trail, $attendance) {
    $trail->parent('admin.attendance');
    $trail->push('Ubah', route('admin.attendance.edit', $attendance));
});

// Attendance > Show
Breadcrumbs::for('admin.attendance.show', function (BreadcrumbTrail $trail, $attendance) {
    $trail->parent('admin.attendance');
    $trail->push($attendance->user->name);
    $trail->push('Detail', route('admin.attendance.show', $attendance));
});

// Attendance > Live
Breadcrumbs::for('admin.attendance.live', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attendance');
    $trail->push('Absensi Langsung', route('admin.attendance.live'));
});

// Attendance > Recap
Breadcrumbs::for('admin.attendance.recap', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.attendance');
    $trail->push('Rekap', route('admin.attendance.recap'));
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

// User Dashboard 
Breadcrumbs::for('user.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('user.dashboard.index'));
});

// User Attendance
Breadcrumbs::for('user.attendance', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Presensi', route('user.attendance.index'));
});

// User Attendance > Create
Breadcrumbs::for('user.attendance.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.attendance');
    $trail->push('Tambah', route('user.attendance.create'));
});

// User Attendance > Edit
Breadcrumbs::for('user.attendance.edit', function (BreadcrumbTrail $trail, $attendance) {
    $trail->parent('user.attendance');
    $trail->push('Ubah', route('user.attendance.edit', $attendance));
});

// User Attendance > Live
Breadcrumbs::for('user.attendance.live', function (BreadcrumbTrail $trail) {
    $trail->parent('user.attendance');
    $trail->push('Absensi Langsung', route('user.attendance.live'));
});

// User overtime
Breadcrumbs::for('user.overtime', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Lembur', route('user.overtime.index'));
});

// User overtime > Create
Breadcrumbs::for('user.overtime.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.overtime');
    $trail->push('Tambah', route('user.overtime.create'));
});

// User overtime > Edit
Breadcrumbs::for('user.overtime.edit', function (BreadcrumbTrail $trail, $overtime) {
    $trail->parent('user.overtime');
    $trail->push('Ubah', route('user.overtime.edit', $overtime));
});

// User permit leave
Breadcrumbs::for('user.permit-leave', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Izin / Cuti', route('user.permit-leave.index'));
});

// User permit leave > Create
Breadcrumbs::for('user.permit-leave.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.permit-leave');
    $trail->push('Tambah', route('user.permit-leave.create'));
});

// User permit leave > Edit
Breadcrumbs::for('user.permit-leave.edit', function (BreadcrumbTrail $trail, $permitLeave) {
    $trail->parent('user.permit-leave');
    $trail->push('Ubah', route('user.permit-leave.edit', $permitLeave));
});

// User request attendance
Breadcrumbs::for('user.request-attendance', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Request Kehadiran', route('user.request-attendance.index'));
});

// User request attendance > Create
Breadcrumbs::for('user.request-attendance.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.request-attendance');
    $trail->push('Tambah', route('user.request-attendance.create'));
});

// User request attendance > Edit
Breadcrumbs::for('user.request-attendance.edit', function (BreadcrumbTrail $trail, $requestAttendance) {
    $trail->parent('user.request-attendance');
    $trail->push('Ubah', route('user.request-attendance.edit', $requestAttendance));
});

// User request reimbursement
Breadcrumbs::for('user.request-reimbursement', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Request Reimbursement', route('user.request-reimbursement.index'));
});

// User request reimbursement > Create
Breadcrumbs::for('user.request-reimbursement.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.request-reimbursement');
    $trail->push('Tambah', route('user.request-reimbursement.create'));
});

// User request reimbursement > Edit
Breadcrumbs::for('user.request-reimbursement.edit', function (BreadcrumbTrail $trail, $requestReimbursement) {
    $trail->parent('user.request-reimbursement');
    $trail->push('Ubah', route('user.request-reimbursement.edit', $requestReimbursement));
});

// User task
Breadcrumbs::for('user.task', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('Tugas', route('user.task.index'));
});

// User task > Create
Breadcrumbs::for('user.task.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.task');
    $trail->push('Tambah', route('user.task.create'));
});

// User task > Edit
Breadcrumbs::for('user.task.edit', function (BreadcrumbTrail $trail, $task) {
    $trail->parent('user.task');
    $trail->push('Ubah', route('user.task.edit', $task));
});

// Payroll
Breadcrumbs::for('admin.payroll', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Payroll', route('admin.payroll.index'));
});

// Payroll > Monthly Recap
Breadcrumbs::for('admin.payroll.monthly-recap', function (BreadcrumbTrail $trail, $data) {
    $trail->parent('admin.payroll');
    $trail->push($data[1]['name'] . ' - ' . $data[0]);
    $trail->push('Rekap Bulanan', route('admin.payroll.monthly-recap', [$data[1]['id'], $data[0]]));
});

// Company Configuration Setting
Breadcrumbs::for('admin.company-configuration-setting', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Pengaturan Perusahaan', route('admin.company-configuration-setting.index'));
});

// Profile
Breadcrumbs::for('admin.profile', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profil', route('admin.profile.index'));
});

// Profile > Edit
Breadcrumbs::for('admin.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.profile');
    $trail->push('Ubah');
});
