<!DOCTYPE html>
<html>

<head>
    <title>PDF Create</title>
    <style type="text/css">
        th,
        td {
            border: solid 1px #777;
            padding: 2px;
            margin: 2px;
        }

    </style>
</head>

<body>
    <table>
        <tr>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Rata - rata nilai</th>
        </tr>
        @foreach ($siswa as $item)
            <tr>
                <td>{{$item->nama_lengkap()}}</td>
                <td>{{$item->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan"}}</td>
                <td>{{$item->agama}}</td>
                <td>{{$item->rata_nilai()}}</td>
            </tr>
        @endforeach
    </table>

</body>

</html>
