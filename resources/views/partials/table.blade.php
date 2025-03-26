@php
    $data_list = [];
    if (isset($models)) {
        foreach ($models as $id => $data) {
            $data_list[] = $data->toArray();
        }
    }
    $has_bill = isset($has_bill)? $has_bill: false;
@endphp

<table class="table my-5 table-striped">

    <thead>
        <tr>
            @if (count($data_list))
                @foreach (current($data_list) as $key => $data)
                    @if (isset($translate))
                        <th>{{ $translate[$key] }}</th>
                    @else
                        <th>{{ $key }}</th>
                    @endif
                @endforeach
                <th> {{-- Edit button col --}} </th>
                <th> {{-- Delete button col --}} </th>
                @if ($has_bill) <th> {{-- Bill button col --}} </th> @endif
            @endif
        </tr>
    </thead>
    <tbody>
        @if (count($data_list))
            @foreach ($data_list as $data)
                <tr>
                    @foreach ($data as $col)
                        <td>{{ $col }}</td>
                    @endforeach
                    <td class="col-1">
                        <a href="{{ url('modifie/' . Request::segment(2) . '/' . $data[$PK]) }}">
                            <button type="submit" class="btn btn-outline-primary">Edit</button>
                        </a>
                    </td>
                    <td class="col-1">
                        <a href="{{ url('delete/' . Request::segment(2) . '/' . $data[$PK])}}">
                            <button class="btn btn-outline-danger">Delete</button>
                        </a>
                    </td>
                    @if ($has_bill)
                    <td class="col-1">
                        <a href="{{ url('bill/' . Request::segment(2) . '/' . $data[$PK])}}">
                            <button class="btn btn-outline-secondary">Bill</button>
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
