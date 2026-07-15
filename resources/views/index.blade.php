<div>
    <h1>List Data Pendonor</h1>
</div>

<div>
    <table border="1">
        <tr>
            <th>Nama Lengkap</th>
            <th>Golongan Darah</th>
            <th>Jenis Kelamin</th>
        </tr>
        @foreach ($data_pendonor as $r)
            <tr>
                <td>({ $r->nama_lengkap})</td>
                <td>({ $r->golongan_darah})</td>
                <td>({ $r->jenis_kelamin})</td>
            </tr>
        @endforeach
    </table>
</div>