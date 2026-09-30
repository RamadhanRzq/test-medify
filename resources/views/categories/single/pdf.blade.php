<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Detail Kategori</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #eee;
        }

        .info {
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <h2>Detail Kategori</h2>

    <table class="info">
        <tr>
            <th width="150">Kode Kategori</th>
            <td>{{ $data->kode }}</td>
        </tr>

        <tr>
            <th>Nama Kategori</th>
            <td>{{ $data->nama }}</td>
        </tr>
    </table>

    <h3>Master Items</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Item</th>
                <th>Jenis</th>
                <th>Harga Beli</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data->masterItems as $index => $item)

                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" style="text-align: center;">
                        Belum ada item pada kategori ini.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada:
        {{ now()->format('d-m-Y H:i:s') }}
    </div>

</body>
</html>