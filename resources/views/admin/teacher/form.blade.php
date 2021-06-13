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
                        <form action="{{route('teacher.update',$item['id'])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="className">Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="className"
                                       value="{{$item?$item['name']:''}}"
                                       placeholder="Class name">
                            </div>
                            <div class="form-group">
                                <label for="className">Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="email"
                                       id="className"
                                       value="{{$item?$item['email']:''}}"
                                       placeholder="Class name">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       id="password"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       placeholder="Confirm password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <form action="{{route('teacher.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       placeholder="Name ">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       id="email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       id="password"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       id="password_confirmation"
                                       placeholder="Confirm password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection