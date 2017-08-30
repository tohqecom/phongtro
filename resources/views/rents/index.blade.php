@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="container">
            <h2>Your current rents</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-2">Car:</th>
                    <th class="col-md-2">Date start:</th>
                    <th class="col-md-2">Date end:</th>
                    <th class="col-md-1">Cost:</th>
                    <th class="col-md-2">Paid:</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rents as $rent)
                    @if(!$rent->old)
                        <tr>
                        <td>{{$rent->brand}} {{$rent->model}} {{$rent->productionYear}}</td>
                        <td>{{$rent->date_start}}</td>
                        <td>{{$rent->date_end}}</td>
                        <td>{{$rent->cost}}$</td>
                        @if($rent->paid)
                            <td>Payment received</td>
                        @else
                            <td>Waiting for payment</td>
                                <td>Pay</td>
                        @endif

                        <tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            <h2>Your old rents</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-2">Car:</th>
                    <th class="col-md-2">Date start:</th>
                    <th class="col-md-2">Date end:</th>
                    <th class="col-md-1">Cost:</th>
                    <th class="col-md-2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($rents as $rent)
                    @if($rent->old)
                        <tr>
                            <td>{{$rent->brand}} {{$rent->model}} {{$rent->productionYear}}</td>
                            <td>{{$rent->date_start}}</td>
                            <td>{{$rent->date_end}}</td>
                            <td>{{$rent->cost}}$</td>
                            <td></td>
                            <td></td>

                        <tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection


