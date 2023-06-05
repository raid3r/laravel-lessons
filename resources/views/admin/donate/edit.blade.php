<?php
/**
 * @var \App\Models\Poll $model
 */
?>

@extends('layouts.main')

@section('title', "Update donate")

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('admin.donate.update', [$model])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title
                            </label>
                            <input type="text" name="title" id="title" value="{{$model->title}}"
                                   class="form-control" placeholder="Donate title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Title
                            </label>
                            <textarea id="description" rows="5" name="description"
                                      class="form-control" placeholder="Description">{{$model->description}}</textarea>

                        </div>

                        <button type="submit" class="btn btn-outline-primary need-confirm">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('end-scripts')

@endsection
