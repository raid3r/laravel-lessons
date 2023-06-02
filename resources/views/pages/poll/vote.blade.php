<?php
/**
 * @var \App\Models\Poll $model
 */

?>

@extends('layouts.main')

@section('title', $model->title)

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>{{$model->title}}</h1>

                </div>
                <form method="POST" action="{{route('poll-vote-store', [$model])}}">
                    @csrf
                    <div class="card-body">
                        <h6>{{$model->description}}</h6>
                        <div class="mt-6">
                            @foreach($model->getVariants()->get() as $i => $variant)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="variant_id"
                                           value="{{$variant->id}}"
                                           id="flexRadioDefault-{{$i}}">
                                    <label class="form-check-label" for="flexRadioDefault={{$i}}">
                                        {{$variant->text}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-info need-confirm" type="submit">Vote</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('end-scripts')

@endsection
