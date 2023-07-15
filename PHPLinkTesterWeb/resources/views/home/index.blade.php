@extends('layout.layout')

@section('content')
    <div class="center-align">
        <div class="container">
            <div class="row">
                <div class="col s12">&nbsp;</div>
                <div class="input-field col s12">
                    <select>
                        <option value="1" selected>Simple</option>
                        <option value="2">Multiple #1</option>
                        <option value="3">Multiple #2</option>
                    </select>
                    <label>Test type</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="autocomplete-input" class="autocomplete">
                    <label for="autocomplete-input">Search</label>
                </div>
            </div>
        </div>
    </div>
@endsection
