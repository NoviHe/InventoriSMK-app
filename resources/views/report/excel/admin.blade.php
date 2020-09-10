<table>
    <thead>
        <tr>
            <th>No</th>
            <th width="20px">Nama </th>
            <th width="20px">Email</th>
            <th width="20px">Level</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->level}}</td>
            </tr>
        @endforeach
    </tbody>
</table>