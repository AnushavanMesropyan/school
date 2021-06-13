@extends('layouts.admin-layout-dashboard')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <ol class="breadcrumb mb-4">
                    <a href="{{route('schedule.create')}}" class="btn btn-primary btn-lg " role="button" >Add </a>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Teachers
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Techer Name</th>
                                <th scope="col">Class  Room</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as  $item)
                                <tr>
                                    <th scope="row">{{$item['id']}}</th>
                                    <td>{{$item['teacher']['name']}}</td>
                                    <td>{{$item['classRoom']['title']}}</td>
                                    <td>{{$item['start']}}</td>
                                    <td>{{$item['end']}}</td>
                                    <td>

                                        <form action="{{route('schedule.destroy',$item['id'])}}" method="POST">

                                            <a href="{{route('schedule.show',$item['id'])}}" title="show">
                                                <i class="fas fa-eye text-success  fa-lg"></i>
                                            </a>

                                            <a href="{{route('schedule.edit',$item['id'])}}">
                                                <i class="fas fa-edit  fa-lg"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                                <i class="fas fa-trash fa-lg text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

@endsection
