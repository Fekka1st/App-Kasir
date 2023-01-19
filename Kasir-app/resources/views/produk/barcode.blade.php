<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
</head>

<body>
    <h1 style="text-align: center;">CETAK BARCODE</h1>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $no => $data)
                <td class="text-center" style="border: 1px solid #333; text-align: center;">
                    <p>{{ $data->nama_produk }} - Rp. {{ format_uang($data->harga_jual) }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($data->kode_produk, 'C39') }}"
                        alt="{{ $data->kode_produk }}" width="180" height="60">
                    <br>
                    {{ $data->kode_produk }}
                </td>
                @if ($no % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>
