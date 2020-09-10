<style>
    table,th,td{
        border:1px solid black;
        text-align: center;
        margin: 5px auto;
    }
    h2{
        text-align: center;
    }
    th{
        background-color: cyan;
    }
</style>
<h2>Data Pegawai</h2>
<hr>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th >Email</th>
            <th >No Telp</th>
            <th >Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->no_telp}}</td>
                <td>{{$user->alamat}}</td>
            </tr>
        @endforeach
    </tbody>
</table>