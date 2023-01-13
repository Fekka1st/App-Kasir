<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Member</title>
</head>
<body>
        <section style="border: 1px solid #fff">
            <table width="100px">
                @foreach ($datamember as $key => data)
                    <tr>
                        @foreach ($data as $item)
                            <td class="text-center" with="50%">
                                <div class="box">
                                    <img src="{{ assets('/public/images/member.png') }}" alt="card">
                                    <div class="logo">
                                        <p>{{ config('app.name') }}</p>
                                            <img src="{{ assets('/public/images/logo.png') }}" alt="logo">
                                </div>
                                <div class="namaa"> {{ $item->nama }} </div>
                                <div class="telepon"> {{ $item->telepon }} </div>
                                <div class="barcode text-left">
                                    <img src="data: image/png;base64,  {{ DNS20::getBarcodePNG("$item->kode_member",
                                        'QRCODE') }}"alt="qrcode"
                                            height="45"
                                            widt="45">
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
            </table>
        </section>


    
</body>
</html>