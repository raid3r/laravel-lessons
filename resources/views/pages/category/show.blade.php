<?php

use App\Models\Category;

/** @var Category $category */

?>

@extends('layouts.main')

@section('title', "Create category")

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if (!empty($category->image))
                    <img
                        class="card-img-top"
                        src="{{$category->getImageUrl()}}" title="{{$category->title}}" alt="{{$category->title}}">
                @endif
                <div class="card-header">
                    <h1></h1>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$category->title}}</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('category.index')}}">Return</a>
                </div>
            </div>
        </div>
    </div>
@endsection

