<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<table style="width:50%;text-align: center">
    <thead>
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>createdDate</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($list as $key => $item)
        <tr>
            <td> {{ $item->id }} </td>
            <td> {{ $item->type }} </td>
            <td> {{ $item->created_at }} </td>
        </tr>
    </tbody>
    @endforeach
</table>
