<!DOCTYPE html>
<html>
<head>
    <title>Report Surat Masuk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        /* Additional styling for the header section */
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
        }

        .header h5, .header p {
            margin: 0; /* Adjust the top and bottom margin as needed */
        }

        .header h6 {
            margin: 0;
            font-size: 10pt;
            color: #888;
        }

        .align-right {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h5>YAYASAN PESANTREN CINTAWANA</h5>
        <h5>SEKOLAH MENENGAH KEJURUAN (SMK YPC)</h5>
        <p style="font-size: 10px">Komplek Pesantren Cintawana Desa Cikunten Kecamatan Singaparna Kabupaten Tasikmalaya Jawa Barat Kode Pos 46414</p>
        <p style="font-size: 10px">Telp. 0265 546717 email: smkypctasikmalaya@gmail.com</p>
    </div>

    <center>
        <h5 style="font-size: 15px; margin: 0;">LAPORAN SURAT MASUK</h5>
        <p style="font-size: 10px">Periode : {{ $tgl_awal }} s/d {{ $tgl_akhir }}</p>
    </center>

    <table class='table table-bordered border-bold'>
        <thead>
            <tr>
                <th>No</th>
                <th>TANGGAL DAN JAM</th>
                <th>NO. SURAT</th>
                <th>TANGGAL SURAT</th>
                <th>SIFAT</th>
                <th>PENGIRIM</th>
                <th>PERIHAL</th>
                <th>UNIT/BAGIAN</th>
            </tr>
        </thead>
        <tbody>
            @if ($suratKeluar->isEmpty() || $suratKeluar == null)
                <tr>
                    <td colspan="7" class="align-right">Jumlah</td>
                    <td colspan="1" style="font-weight: bold;">{{ $jumlahsuratmasuk }}</td>
                </tr>
            @else
                
            @endif
            @php $i=1 @endphp
            @foreach($suratmasuk as $p)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$p->tanggal}}</td>
                <td>{{$p->nomor_surat}}</td>
                <td>{{$p->tanggal_surat}}</td>
                <td>{{$p->sifat_surat}}</td>
                <td>{{$p->pengirim}}</td>
                <td>{{$p->perihal}}</td>
                <td>{{$unitkerjaNama == null ? '-' : $unitkerjaNama}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>