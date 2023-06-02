<?php

use App\Models\Category;
/**
 * @var $categories Category[]
 */
?>

@extends('layouts.main')

@section('title', "Create product")

@section('content')

    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Title

                        <input type="text" name="title"
                               class="form-control" placeholder="Product title">
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price

                        <input type="number" min="0.01" step="0.01" name="price"
                               class="form-control" placeholder="Product price">
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        {{ __('Quantity') }}
                        <input type="number" min="0" step="1" name="quantity"
                               class="form-control" placeholder="Product price">
                    </label>
                </div>
                <div class="mb-3">
                        {{ __('Category') }}
                        <select class="form-control" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>


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
