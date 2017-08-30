@extends('layouts.app')


@section('content')
<div class="container">

                <div class="container">
                    <h2>Cars available</h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="col-md-1">Brand</th>
                            <th class="col-md-1">Model</th>
                            <th class="col-md-2">Production Year</th>
                            <th class="col-md-2">Cost (per day)</th>
                            <th class="col-md-2"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{$car->brand}}</td>
                                <td>{{$car->model}}</td>
                                <td class=".production-year">
                                    {{$car->productionYear}}
                                </td>

                                <td>{{$car->cost}}$</td>
                                <td><a href="{{ route('cars/rent',['id' => $car->id]) }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('rent-form[{{$car->id}}]').submit();">
                                        <span class="glyphicon glyphicon-time"></span> Rent</a>
                                    </a>
                                    <form id="rent-form[{{$car->id}}]" action="{{ route('cars/rent',['id' => $car->id]) }}" method="get" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                                @if(Auth::user()->admin == true)

                                    <td><a href="{{ route('cars-edit',['id' => $car->id]) }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('edit-form[{{$car->id}}]').submit();">
                                            <span class="glyphicon glyphicon-cog"></span> Edit</a>
                                        </a>
                                        <form id="edit-form[{{$car->id}}]" action="{{ route('cars-edit',['id' => $car->id]) }}" method="get" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                    <td><a href="{{ route('cars-delete',$car->id) }}"
                                           onclick="event.preventDefault();
                                                    var confirmation = confirm('Are you sure?');
                                                    if(confirmation == true){
                                                        document.getElementById('delete-form[{{$car->id}}]').submit();
                                                    }">
                                            <span class="glyphicon glyphicon-remove"></span> Delete
                                        </a>
                                        <form id="delete-form[{{$car->id}}]" action="{{ route('cars-delete',$car->id) }}" method="post" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

    <div class="container">
        <h2>Cars currently not available</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-md-1">Brand</th>
                <th class="col-md-1">Model</th>
                <th class="col-md-2">Production Year</th>
                <th class="col-md-2">Cost (per day)</th>
                <th class="col-md-2">Info:</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rented_cars as $car)
                <tr>
                    <td>{{$car->brand}}</td>
                    <td>{{$car->model}}</td>
                    <td class=".production-year">
                        {{$car->productionYear}}
                    </td>
                    <td>{{$car->cost}}$</td>
                    <td>Rented to: {{$car->date_end}}</td>
                    @if(Auth::user()->admin == true)

                        <td><a href="{{ route('cars-edit',['id' => $car->id]) }}"
                               onclick="event.preventDefault();
                                       document.getElementById('edit-form[{{$car->id}}]').submit();">
                                <span class="glyphicon glyphicon-cog"></span> Edit</a>
                            </a>
                            <form id="edit-form[{{$car->id}}]" action="{{ route('cars-edit',['id' => $car->id]) }}" method="get" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </td>
                        <td><a href="{{ route('cars-delete',$car->id) }}"
                               onclick="event.preventDefault();
                                       var confirmation = confirm('Are you sure?');
                                       if(confirmation == true){
                                       document.getElementById('delete-form[{{$car->id}}]').submit();
                                       }">
                                <span class="glyphicon glyphicon-remove"></span> Delete
                            </a>
                            <form id="delete-form[{{$car->id}}]" action="{{ route('cars-delete',$car->id) }}" method="post" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                </tr>
                @endif
            @endforeach
            @foreach($unavailable_cars as $car)
                <tr>
                    <td>{{$car->brand}}</td>
                    <td>{{$car->model}}</td>
                    <td class=".production-year">
                        {{$car->productionYear}}
                    </td>

                    <td>{{$car->cost}}$</td>
                    <td>Maintanance</td>
                    @if(Auth::user()->admin == true)

                        <td><a href="{{ route('cars-edit',['id' => $car->id]) }}"
                               onclick="event.preventDefault();
                                       document.getElementById('edit-form[{{$car->id}}]').submit();">
                                <span class="glyphicon glyphicon-cog"></span> Edit</a>
                            </a>
                            <form id="edit-form[{{$car->id}}]" action="{{ route('cars-edit',['id' => $car->id]) }}" method="get" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </td>
                        <td><a href="{{ route('cars-delete',$car->id) }}"
                               onclick="event.preventDefault();
                                       var confirmation = confirm('Are you sure?');
                                       if(confirmation == true){
                                       document.getElementById('delete-form[{{$car->id}}]').submit();
                                       }">
                                <span class="glyphicon glyphicon-remove"></span> Delete
                            </a>
                            <form id="delete-form[{{$car->id}}]" action="{{ route('cars-delete',$car->id) }}" method="post" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
