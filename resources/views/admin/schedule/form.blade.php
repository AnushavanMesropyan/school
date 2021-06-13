@extends('layouts.admin-layout-dashboard')
@section('content')
    <div id="layoutSidenav_content" class="">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif
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
                        <form action="{{route('schedule.update',$item['id'])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="className">Teacher</label>

                                <select id="teacher"
                                        name="teacher_id"
                                        class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example">
                                    <option >Open this select menu</option>
                                    @foreach($teachers as $teacher)
                                        @if($item['teacher_id']===$teacher['id'])
                                            <option value="{{$teacher['id']}}" selected>{{$teacher['name']}}</option>

                                        @else
                                            <option value="{{$teacher['id']}}">{{$teacher['name']}}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="className">Class</label>
                                <select id="classRoom"
                                        name="class_room_id"
                                        class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example">
                                    <option selected>Open this select menu</option>
                                    @foreach($classRooms as $classRoom)
                                        @if($item['class_room_id']===$classRoom['id'])
                                            <option value="{{$classRoom['id']}}" selected>{{$classRoom['title']}}</option>

                                        @else
                                            <option value="{{$classRoom['id']}}">{{$classRoom['title']}}</option>

                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Start</label>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepickerstart' data-value="{{$item['start']}}">
                                        <input
                                                value="{{$item['start']}}"
                                                type='text' name="start" class="form-control" />
                                        <span class="input-group-addon">
                                                     <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">End</label>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepickerend'>
                                        <input
                                                value="{{$item['end']}}"
                                                type='text' name="end" class="form-control" />
                                        <span class="input-group-addon">
                                                     <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <form action="{{route('schedule.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="teacher">Teachers</label>
                                <select id="teacher"
                                        name="teacher_id"
                                        class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example">
                                    <option selected>Open this select menu</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="classRoom">Class</label>
                                <select id="classRoom"
                                        name="class_room_id"
                                        class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example">
                                    <option selected>Open this select menu</option>
                                    @foreach($classRooms as $classRoom)
                                        <option value="{{$classRoom['id']}}">{{$classRoom['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Start</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepickerstart'>
                                                    <input type='text'
                                                           name="start" class="form-control" />
                                                    <span class="input-group-addon">
                                                     <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">End</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepickerend'>
                                                    <input type='text' name="end" class="form-control" />
                                                    <span class="input-group-addon">
                                                     <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                    </div>
                                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            console.log( $('#datetimepickerstart').data('value'))
            $('#datetimepickerstart').datetimepicker({
                defaultDate:$("#datetimepickerstart").find("input").val(),
                daysOfWeekDisabled: [0,6],
                format: 'YYYY-MM-DD HH:mm:ss'
            });


            $('#datetimepickerend').datetimepicker({
              // useCurrent: false //Important! See issue #1075
                defaultDate:$("#datetimepickerend").find("input").val(),
                daysOfWeekDisabled: [0,6],
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $("#datetimepickerstart").on("dp.change", function (e) {
                $('#datetimepickerend').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepickerend").on("dp.change", function (e) {
                $('#datetimepickerstart').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection