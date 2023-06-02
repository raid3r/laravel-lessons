<?php

use App\Models\Product;

/** @var Product[] $products */

?>

@extends('layouts.main')

@section('title', "Products")

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
                <a href="{{route('product.create')}}" class="btn btn-info">Create</a>
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
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>
                            @if (!empty($product->getImageUrl()))
                                <img style="width: 100px;" src="{{$product->getImageUrl()}}"
                                     title="{{$product->title}}" alt="{{$product->title}}">
                            @endif
                        </td>
                        <th>{{$product->price}}</th>
                        <th>{{$product->quantity}}</th>
                        <td>
                            <a href="{{route('product.show', [$product])}}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{route('product.edit', [$product])}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form class="delete-button" method="POST"
                                  action="{{route('product.destroy', [$product])}}">
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
