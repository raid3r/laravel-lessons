<?php

use App\Models\Donate;

/**
 * @var $model Donate
 */
?>

@extends('layouts.main')

@section('title', $model->title)

@section('content')
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$model->title}}</h5>
                        <p class="card-text">
                            {{$model->description}}
                        </p>
                        <div style="display: flex; align-items: center" class="my-5">
                            @include('partials.progress', ['value' => $model->donePercent()])
                        </div>

                        <div class="mt-5">
                            <a class="btn btn-primary" href="{{route('donate.form', [$model, 100])}}">100 UAH</a>
                            <a class="btn btn-primary" href="{{route('donate.form', [$model, 200])}}">200 UAH</a>
                            <a class="btn btn-primary" href="{{route('donate.form', [$model, 500])}}">500 UAH</a>
                            <a class="btn btn-primary" href="{{route('donate.form', [$model, 1000])}}">1000 UAH</a>
                        </div>

                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('end-scripts')

@endsection
