<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #004d4d;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Laporan Transaksi Buku</h2>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Judul</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Petugas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->buku->kode_buku ?? '-' }}</td>
                    <td>{{ $item->buku->judul_buku ?? '-' }}</td>
                    <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d-m-Y') }}</td>
                    <td>{{ $item->petugas->nama_lengkap ?? '-' }}</td>
                    <td>{{ ucfirst(str_replace('_',' ',$item->status)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>