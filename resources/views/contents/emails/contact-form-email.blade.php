<!DOCTYPE html>
<html>
<head>
    <title>SIPMO - Kontak Form</title>
</head>
<body>
    <h1>Pesan Baru</h1>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Pesan:</strong> {{ $data['message'] }}</p>
</body>
</html>