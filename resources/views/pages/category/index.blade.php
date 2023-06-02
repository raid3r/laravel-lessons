<?php

use App\Models\Category;

/** @var Category[] $categories */

?>

@extends('layouts.main')

@section('title', "Categories")

@section('content')
    <form method="GET">
        {{Form::open(['method' => 'get' ])}}
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" name="search" value="{{$search}}" class="form-control" id="search"
                           placeholder="Search...">
                </div>
                <button class="btn btn-primary">Search</button>
                <a href="{{route('category.create')}}" class="btn btn-info">Create</a>
            </div>
        </div>
        {{Form::close()}}
    </form>
    <div class="row mt-5">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>

                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->title}}</td>
                        <td>
                            @if (!empty($category->getImageUrl()))
                                <img style="width: 100px;" src="{{$category->getImageUrl()}}"
                                     title="{{$category->title}}" alt="{{$category->title}}">
                            @endif
                        </td>
                        <td>
                            <a href="{{route('category.show', [$category])}}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('category.edit', [$category])}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form class="delete-button" method="POST"
                                  action="{{route('category.destroy', [$category])}}">
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
