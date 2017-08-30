@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default border">
                    <div class="panel-heading border">
                        <h1>Add a new car</h1>
                        <hr/>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="/cars">
                            {{ csrf_field() }}
                            <h2>Main info:</h2>
                            <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Brand</label>

                                <div class="col-md-6">
                                    <input id="brand" type="text" class="form-control grey-glow" name="brand" value="{{ old('brand') }}" autofocus/>


                                    @if ($errors->has('brand'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                                <label for="model" class="col-md-4 control-label ">Model</label>

                                <div class="col-md-6">
                                    <input id="model" type="text" class="form-control grey-glow" name="model" value="{{ old('model') }}" />

                                    @if ($errors->has('model'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('production-year') ? ' has-error' : '' }}">
                                <label for="production-year" class="col-md-4 control-label">Production year</label>

                                <div class="col-md-6">
                                    <input id="production-year" type="integer" class="form-control grey-glow" name="production-year" value="{{ old('production-year') }}"/>

                                    @if ($errors->has('production-year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('production-year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                <label for="cost" class="col-md-4 control-label">Cost ($)</label>

                                <div class="col-md-6">
                                    <input id="cost" type="number" class="form-control grey-glow" name="cost" value="{{ old('cost') }}" />

                                    @if ($errors->has('cost'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <h2>Details:</h2>
                            <div class="form-group{{ $errors->has('gearbox') ? ' has-error' : '' }}">
                                <label for="gearbox" class="col-md-4 control-label">Gearbox</label>

                                <div class="col-md-6">
                                    <select class="form-control grey-glow" id="gearbox" name="gearbox" >
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>
                                    @if ($errors->has('gearbox'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gearbox') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fuel-consumption') ? ' has-error' : '' }}">
                                <label for="fuel-consumption" class="col-md-4 control-label">Fuel consumption (l/100km):</label>

                                <div class="col-md-6">
                                    <input id="fuel-consumption" type="text" class="form-control grey-glow" name="fuel-consumption" value="{{ old('fuel-consumption') }}"/>

                                    @if ($errors->has('fuel-consumption'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fuel-consumption') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('engine-capacity') ? ' has-error' : '' }}">
                                <label for="engine-capacity" class="col-md-4 control-label">Engine capacity (cm<sup>3</sup>):</label>

                                <div class="col-md-6">
                                    <input id="engine-capacity" type="number" class="form-control grey-glow" name="engine-capacity" value="{{ old('engine-capacity') }}"/>

                                    @if ($errors->has('engine-capacity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('engine-capacity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('engine-power') ? ' has-error' : '' }}">
                                <label for="engine" class="col-md-4 control-label">Engine power (hp):</label>

                                <div class="col-md-6">
                                    <input id="engine-power" type="number" class="form-control grey-glow" name="engine-power" value="{{ old('engine-power') }}" />

                                    @if ($errors->has('engine-power'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('engine-power') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fuel') ? ' has-error' : '' }}">
                                <label for="fuel" class="col-md-4 control-label">Fuel:</label>

                                <div class="col-md-6">

                                        <select class="form-control grey-glow" id="fuel" name="fuel" required>
                                            <option value="Petrol">Petrol</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="LPG">LPG</option>
                                        </select>
                                    @if ($errors->has('fuel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fuel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
                                <label for="seats" class="col-md-4 control-label">Seats:</label>

                                <div class="col-md-6">
                                    <input id="seats" type="number" class="form-control grey-glow" name="seats" value="{{ old('seats') }}"/>

                                    @if ($errors->has('seats'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('seats') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary grey-button">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
