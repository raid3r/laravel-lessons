<?php

use App\Models\Category;

/** @var Category $category */

?>

@extends('layouts.main')

@section('title', "Create category")

@section('content')

    {{ $category->title }}

    <form method="POST" action="{{route('category.update',[$category])}}" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Title
                        <input type="text" name="title"
                               value="{{$category->title}}"
                               class="form-control" placeholder="Category title">
                    </label>
                </div>
                <div class="mb-3">
                    @if (!empty($category->image))
                        <img
                            style="max-width: 300px"
                            src="{{$category->getImageUrl()}}" title="{{$category->title}}" alt="{{$category->title}}">
                    @endif
                    <label for="search" class="form-label">Image
                        <input type="file" name="image" accept="image/*"
                               class="form-control">
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>

@endsection
