@extends('layouts.main')

@section('title', "Create poll")

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('poll.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title
                            </label>
                            <input type="text" name="title" id="title"
                                   class="form-control" placeholder="Poll title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Title
                            </label>
                            <textarea rows="5" name="description"
                                      class="form-control" placeholder="Description"></textarea>

                        </div>

                        <button type="submit" class="btn btn-outline-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
