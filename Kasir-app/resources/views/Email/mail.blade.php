<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Laporan Pengeluaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Daftar Produk dengan Persediaan Stok Hampir Habis</h2>
        <hr>
        <table class="text-center" rules="all" border="1px" align="center" style="width: 95%;">
            <thead>
                <tr style="margin-left: 19px;">
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Merk</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach ($produk as $item)
                    @if ($item->stok < 5)
                        <tr>
                            <td>{{ $item->kode_produk }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->merk }}</td>
                            <td>{{ $item->stok }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
