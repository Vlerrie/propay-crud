@extends('layouts.authLayout')

@section('content')
    <div class="row justify-content-center mt-2">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="h2">My People</h2>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Id Number</th>
                            <th>Language</th>
                            <th>Interests</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($people as $person)
                            <tr>
                                <td>
                                    {{$person->name}} {{$person->surname}}
                                </td>
                                <td>
                                    {{$person->email}}
                                </td>
                                <td>
                                    {{$person->mobile}}
                                </td>
                                <td>
                                    {{$person->sa_id}}
                                </td>
                                <td>
                                    {{$person->language->name}}
                                </td>
                                <td>
                                    {{$person->implodedInterests()}}
                                </td>
                                <td>
                                    <form id="delete_{{$person->id}}" method="post" action="{{route('persons.destroy', $person)}}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <form id="edit_{{$person->id}}" method="post" action="{{route('persons.edit', $person)}}">
                                        @csrf
                                        @method('get')
                                    </form>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-sm btn-danger" onclick="$('#delete_{{$person->id}}').submit()">Delete</button>
                                        <button class="btn btn-sm btn-info" onclick="$('#edit_{{$person->id}}').submit()">Edit</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h2 class="h2">New Person</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('persons.store')}}">
                        @csrf
                        <label for="name">Name</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="name" id="name"
                               value="{{old('name')}}">
                        <label for="surname">Surname</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="surname" id="surname"
                               value="{{old('surname')}}">
                        <label for="sa_id">South African Id Number</label>
                        <input class="form-control mb-2" type="text" maxlength="13" name="sa_id" id="sa_id"
                               value="{{old('sa_id')}}">
                        <label for="email">Email</label>
                        <input class="form-control mb-2" type="email" maxlength="128" name="email" id="email"
                               value="{{old('email')}}">
                        <label for="mobile">Mobile Number</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+27</span>
                            </div>
                            <input class="form-control mb-2" type="tel" minlength="9" maxlength="12" name="mobile"
                                   id="mobile" value="{{old('mobile')}}">
                        </div>
                        <label for="name">Birth Date</label>
                        <input class="form-control mb-2" type="date" name="dob" id="dob" value="{{old('dob')}}">
                        <label for="language_id">Language</label>
                        <select class="form-control mb-2" name="language_id" id="language_id">
                            <option disabled selected></option>
                            @foreach($languages as $lang)
                                <option @if(old('language_id') == $lang->id) selected
                                        @endif value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        <label for="interests">Interests</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="interests" id="interests"
                               value="{{old('interests')}}">

                        <button class="btn btn-outline-success w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@stop
