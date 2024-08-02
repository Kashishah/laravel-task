@extends('layout')

@section('title')
    Show Data Table
@endsection

@section('body')
    <div class="mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    @foreach (array_keys($allItems[array_key_first($allItems)]['items']) as $date)
                        <th>{{ $date }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($allItems as $userId => $data)
                    <tr>
                        <td>{{ $data['userName'] }}</td> 
                        @foreach (array_keys($allItems[array_key_first($allItems)]['items']) as $date)
                            <td>{{ $data['items'][$date] ?? 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
