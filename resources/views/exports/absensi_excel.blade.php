<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Ruang</th>
            <th>Mapel</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Tanggal</th>
            <th>Waktu Scan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absensis as $i => $absen)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $absen->user->nama_lengkap ?? '-' }}</td>
            <td>{{ $absen->jadwal->kelas ?? '-' }}</td>
            <td>{{ $absen->jadwal->ruangan ?? '-' }}</td>
            <td>{{ $absen->jadwal->mata_pelajaran ?? '-' }}</td>
            <td>{{ $absen->jadwal->hari ?? '-' }}</td>
            <td>{{ $absen->jam_mulai ?? '-' }}</td>
            <td>{{ $absen->tanggal ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($absen->waktu_scan)->format('H:i:s') ?? '-' }}</td>
            <td>{{ ucfirst($absen->status_kehadiran ?? '-') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
