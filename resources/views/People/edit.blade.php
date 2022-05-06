@extends('layouts.authLayout')

@section('content')
    <div class="row justify-content-center mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="h2">Edit Person</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('persons.update', $person)}}">
                        @method('put')
                        @csrf
                        <label for="name">Name</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="name" id="name"
                               value="{{$person->name}}">
                        <label for="surname">Surname</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="surname" id="surname"
                               value="{{$person->surname}}">
                        <label for="sa_id">South African Id Number</label>
                        <input class="form-control mb-2" type="text" maxlength="13" name="sa_id" id="sa_id"
                               value="{{$person->sa_id}}">
                        <label for="email">Email</label>
                        <input class="form-control mb-2" type="email" maxlength="128" name="email" id="email"
                               value="{{$person->email}}">
                        <label for="mobile">Mobile Number</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+27</span>
                            </div>
                            <input class="form-control mb-2" type="tel" minlength="9" maxlength="12" name="mobile"
                                   id="mobile" value="{{$person->mobile}}">
                        </div>
                        <label for="name">Birth Date</label>
                        <input class="form-control mb-2" type="date" name="dob" id="dob" value="{{$person->dob}}">
                        <label for="language_id">Language</label>
                        <select class="form-control mb-2" name="language_id" id="language_id">
                            <option disabled></option>
                            @foreach($languages as $lang)
                                <option @if($person->language_id == $lang->id) selected
                                        @endif value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        <label for="interests">Interests</label>
                        <input class="form-control mb-2" type="text" maxlength="128" name="interests" id="interests"
                               value="{{$person->implodedInterests()}}">

                        <div class="w-100 btn-group">

                            <button class="btn btn-outline-success">Update</button>
                            <button type="button" class="btn btn-outline-danger" onclick="window.location.href = '{{route('persons.index')}}'">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@stop
