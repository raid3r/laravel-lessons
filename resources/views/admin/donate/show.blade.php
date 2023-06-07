<?php

use App\Models\Donate;

/** @var Donate $model */

?>

@extends('layouts.main')

@section('title', $model->title)

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total: {{$model->successPayments()->sum('amount')}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$model->title}}</h5>
                    <p class="card-text">
                        {{$model->description}}
                    </p>
                    <div style="display: flex; align-items: center">
                        @include('partials.progress', ['value' => $model->donePercent()])
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" href="{{route('admin.donate.index')}}">Return</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payments</h5>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <tbody>
                        @foreach($model->successPayments() as $payment )
                              <tr>
                                  <td>{{$payment->id}}</td>
                                  <td>{{$payment->status}}</td>
                                  <td>{{$payment->amount}}</td>
                              </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

