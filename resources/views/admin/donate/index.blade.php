<?php

use App\Models\Donate;

/** @var Donate[] $models */

?>

@extends('layouts.main')

@section('title', "Donates")

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Donates</h1>
            <a href="{{route('admin.donate.create')}}" class="btn btn-info">Create</a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="width: 30%"></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $model)
                    <tr>
                        <td>{{$model->id}}</td>
                        <td>{{$model->title}}</td>
                        <td>{{$model->description}}</td>
                        <td>
                            <div style="display: flex; align-items: center">
                                @include('partials.progress', ['value' => $model->donePercent()])
                            </div>
                        </td>
                        <td>
                            <a href="{{route('donate.index', [$model])}}"
                               class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-heart"></i>
                            </a>
                            <a href="{{route('admin.donate.show', [$model])}}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('admin.donate.edit', [$model])}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form class="delete-button" method="POST"
                                  action="{{route('admin.donate.destroy', [$model])}}">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
