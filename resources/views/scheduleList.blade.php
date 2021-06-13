@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($list as $item)
                                <th scope="row">{{$item['id']}}</th>
                                <td>{{$item['classRoom']['title']}}</td>
                                <td>{{$item['start']}}</td>
                                <td>{{$item['end']}}</td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
