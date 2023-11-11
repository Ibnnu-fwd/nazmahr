<table class="rowTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Nama Lengkap</th>
            <th>Tipe Presensi</th>
            <th>Jadwal Masuk</th>
            <th>Jadwal Keluar</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Terlambat</th>
            <th>Overtime</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $res => $key)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $res }}</td>
                <td>{{ $key['user']['name'] ?? '-' }}</td>
                <td>{{ $key['attendanceType']['name'] ?? '-' }}</td>
                <td>{{ isset($key['attendanceTimeConfig']['start_time']) ? date('H:i', strtotime($key['attendanceTimeConfig']['start_time'])) : '-' }}
                </td>
                <td>{{ isset($key['attendanceTimeConfig']['end_time']) ? date('H:i', strtotime($key['attendanceTimeConfig']['end_time'])) : '-' }}
                </td>
                <td class="font-semibold">{{ isset($key['entry_at']) ? date('H:i', strtotime($key['entry_at'])) : '-' }}
                </td>
                <td class="font-semibold">{{ isset($key['exit_at']) ? date('H:i', strtotime($key['exit_at'])) : '-' }}
                </td>
                <td class="text-danger">{{ isset($key['late_time']) ? $key['late_time'] : '-' }}</td>
                <td>{{ isset($key['overtime']) ? $key['overtime'] : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
