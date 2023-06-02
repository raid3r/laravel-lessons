<?php

use App\Models\Category;

/** @var Category[] $categories */

?>

@extends('layouts.main')

@section('title', "Create category")

@section('content')

    <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Title

                        <input type="text" name="title"
                               class="form-control" placeholder="Category title">
                    </label>
                </div>
                <div class="mb-3">
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
