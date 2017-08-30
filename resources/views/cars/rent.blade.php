@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/rent.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default border">
                <div class="panel-heading border">
                </div>
                <div class="panel-body">
                    <h2>{{$car->brand}} {{$car->model}} {{$car->productionYear}}</h2>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            <p hidden id="cost">{{$car->cost}}</p>


                            <h3>Details:</h3>
                            <h4>Gearbox: {{$car->gearbox}}</h4>
                            <h4>Engine capacity: {{$car->engine_capacity}} cm<sup>3</sup></h4>
                            <h4>Engine power: {{$car->engine_power}} hp</h4>
                            <h4>Average fuel consumption: {{number_format($car->fuel_consumption, 1)}} l/100km</h4>
                            <h4>Fuel: {{$car->fuel}}</h4>
                            <h4>Seats: {{$car->seats}}</h4>

                        </div>
                        <div class="col-md-6">
                            <form class="form-horizontal" method="POST" action="{{ route('cars/rent',['car_id' => $car->id,'user_id' => Auth::user()->id]) }}">
                                {{ csrf_field() }}
                                <h4>Rent from: </h4>
                                <div class="form-group{{ $errors->has('date-start') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <input id="date-start" type="date" class="form-control grey-glow" name="date-start" required autofocus>

                                        @if ($errors->has('date-start'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date-start') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <h4>Rent to:</h4>
                                <div class="form-group{{ $errors->has('date-end') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        <input id="date-end" type="date" class="form-control grey-glow" name="date-end" required autofocus>

                                        @if ($errors->has('date-end'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('date-end') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <h4 id="total-days">Total days: 0 at rate {{$car->cost}}$ per day</h4>
                                <h4 id="total-cost">Total cost: 0$</h4>
                                <h4 id="totalcost"></h4>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary grey-button">
                                            Confirm
                                        </button>
                                        <a class="btn btn-primary grey-button" href="{{ url('/cars') }}">
                                                Cancel
                                        </a>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/rent.js') }}"></script>
@endsection