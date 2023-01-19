<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Member </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    {{-- bikin layout untuk kode member serapih mungkin --}}
    <section style="border: 1px solid #fff">
        <table>
            @foreach ($datamember as $key => $data)
                <tr>
                    @foreach ($data as $item)
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ public_path('img/Logo.png') }}" class="img-fluid rounded-start"
                                        alt="Logo">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title">HadirMart</h4>
                                        <h5 class="card-title">{{ $item->nama }}</h5>
                                        <p class="card-text">No {{ $item->telpon }} Alamat {{ $item->alamat }}</p>
                                        <p class="card-text" style="font-family: 'Courier New', Courier, monospace;">
                                            Member Setia</p>
                                        <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE') }}"
                                            alt="qrcode" height="45" widht="45">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        @if (count($datamember) == 1)
                            <td class="text-center"></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
