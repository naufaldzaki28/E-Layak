<!DOCTYPE html>
<html>

<head>
    <title>Pesan Bantuan Baru</title>
</head>

<body>
    <h2>Halo Admin, ada pesan baru!</h2>

    <p>Berikut detailnya:</p>
    <ul>
        <li><strong>Nama:</strong> {{ $data['nama_depan'] }} {{ $data['nama_belakang'] }}</li>
        <li><strong>Email Pengirim:</strong> {{ $data['email'] }}</li>
        <li><strong>Waktu:</strong> {{ now()->format('d M Y H:i') }}</li>
    </ul>

    <p><strong>Isi Pesan:</strong></p>
    <div style="background: #f3f4f6; padding: 15px; border-radius: 5px;">
        {{ $data['pesan'] }}
    </div>

    <p>Segera balas pesan ini melalui dashboard atau email.</p>
</body>

</html>
