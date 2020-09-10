<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20px">Nama </th>
            <th width="20px">Email</th>
            <th width="20px">No Telp</th>
            <th width="20px">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
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