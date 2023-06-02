@extends('map::layouts.master')

@section('title', "Create map marker")

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('admin.map.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="popup_text" class="form-label">
                                Text
                            </label>
                            <textarea name="popup_text" id="popup_text"
                                      class="form-control" placeholder="Marker text"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lat" class="form-label">
                                Latitude
                            </label>
                            <input type="number" step="0.0000001" name="lat" id="lat"
                                   class="form-control" placeholder="Latitude">
                        </div>
                        <div class="mb-3">
                            <label for="long" class="form-label">
                                Longitude
                            </label>
                            <input type="number" step="0.0000001" name="long" id="long"
                                   class="form-control" placeholder="Longitude">
                        </div>


                        <button type="submit" class="btn btn-outline-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
