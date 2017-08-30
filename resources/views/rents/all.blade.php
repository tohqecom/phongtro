@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="container">
            <h2>Current rents</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Car:</th>
                    <th>Date start:</th>
                    <th>Date end:</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rents as $rent)
                    @if(!$rent->old)
                        <tr>
                            <td>{{$rent->brand}} {{$rent->model}} {{$rent->productionYear}}</td>
                            <td>{{$rent->date_start}}</td>
                            <td>{{$rent->date_end}}</td>
                            <td>{{$rent->name}}</td>
                            @if(Auth::user()->admin == true)
                                <!-- todo edit rent -->
                                <td><a>
                                        <span class="glyphicon glyphicon-cog"></span> Edit</a>
                                    </a>
                                </td>
                    @endif
                    @endif

                    <tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            <h2>Old rents</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Car:</th>
                    <th>Date start:</th>
                    <th>Date end:</th>
                    <th>User</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rents as $rent)
                    @if($rent->old)
                        <tr>
                            <td>{{$rent->brand}} {{$rent->model}} {{$rent->productionYear}}</td>
                            <td>{{$rent->date_start}}</td>
                            <td>{{$rent->date_end}}</td>
                            <td>{{$rent->name}}</td>
                            @if(Auth::user()->admin == true)

                                <!-- todo edit rent -->
                                    <td><a>
                                            <span class="glyphicon glyphicon-cog"></span> Edit</a>
                                        </a>
                                    </td>
                            @endif
                    @endif

                    <tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
