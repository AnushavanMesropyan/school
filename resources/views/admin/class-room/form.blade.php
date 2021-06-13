@extends('layouts.admin-layout-dashboard')
@section('content')
    <div id="layoutSidenav_content" class="">
        <div class="container">
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(isset($item))
                        <form action="{{route('class-room.update',$item['id'])}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="className">Class name</label>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       id="className"
                                       value="{{$item?$item['title']:''}}"
                                       placeholder="Class name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <form action="{{route('class-room.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="className">Class name</label>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       id="className"
                                       placeholder="Class name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection