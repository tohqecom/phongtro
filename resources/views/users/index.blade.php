@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @if(Auth::user()->admin == true)

                            <td><a href="{{ route('users-edit',['id' => $user->id]) }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('edit-form[{{$user->id}}]').submit();">
                                    <span class="glyphicon glyphicon-cog"></span> Edit</a>
                                </a>
                                <form id="edit-form[{{$user->id}}]" action="{{ route('users-edit',['id' => $user->id]) }}" method="get" style="display: none;">
                                    {{ csrf_field() }}
                                </form></td>
                            <td><a href="{{ route('users-delete',$user->id) }}"
                                   onclick="event.preventDefault();
                                           document.getElementById('delete-form[{{$user->id}}]').submit();">
                                    <span class="glyphicon glyphicon-remove"></span> Delete
                                </a>
                                <form id="delete-form[{{$user->id}}]" action="{{ route('users-delete',$user->id) }}" method="post" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
