<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan E-Layak</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .stempel { float: right; margin-top: 50px; text-align: center; }
    </style>
</head>
<body>
    <div class="kop">
        <h2>UNIVERSITAS E-LAYAK INDONESIA</h2>
        <p>Jl. Kampus Merdeka No. 123, Bandung | Telp: (022) 123456</p>
    </div>

    <center><h3><u>SURAT KETERANGAN</u></h3></center>

    <p>Yang bertanda tangan di bawah ini, Admin E-Layak menerangkan bahwa:</p>
    <table>
        <tr><td>Nama</td><td>: {{ $data->user->name }}</td></tr>
        <tr><td>NIM</td><td>: {{ $data->user->nim }}</td></tr>
        <tr><td>Jenis Layanan</td><td>: {{ $data->jenis_layanan }}</td></tr>
    </table>

    <p>Telah dinyatakan <b>DITERIMA/DISETUJUI</b> pada tanggal {{ $data->updated_at->format('d F Y') }}.</p>

    <div class="stempel">
        Bandung, {{ date('d F Y') }}<br>
        Admin E-Layak<br><br><br><br>
        <b>(..........................)</b>
    </div>
</body>
</html>
