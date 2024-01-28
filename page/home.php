<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .jumbotron {
            background-color: #79B4B7;
            color: #fff;
            text-align: center;
            padding: 50px;
            margin: 0;
            border-radius: 15px; /* Mengubah bentuk kotak */
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.3); /* Menambahkan bayangan */
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="jumbotron">
    <h1>Selamat Datang, <?= $user ?>!</h1>
    <p>Selamat datang di aplikasi inventaris kantor</p>
    <p>Aplikasi ini merupakan aplikasi uji level kelas X RPL 1</p>
</div>

</body>
</html>
