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
<h2>Data Petugas</h2>
<hr>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th >Nama </th>
            <th >Email</th>
            <th >Level</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->level}}</td>
            </tr>
        @endforeach
    </tbody>
</table>