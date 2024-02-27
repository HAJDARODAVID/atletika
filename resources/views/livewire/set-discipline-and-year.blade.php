<div>
    <table>
        <thead>
            <tr>
                <td></td>
                @foreach ($years as $year)
                    <td>{{  $year->year }}</td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplines as $dspl)
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button> 
                        <b class="h5">{{ $dspl->name }}</b>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
