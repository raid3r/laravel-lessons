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

                <div class="card-body" data-id="{{$model->id}}">
                    <h6>{{$model->description}}</h6>
                    <div class="mt-6">
                        <table class="table table-hover">

                            <thead></thead>
                            <tbody>
                            <?php /** @var $variant \App\Models\PollVariant */ ?>
                            @foreach($model->getVariants()->get() as $variant)
                                <tr>
                                    <td>{{$variant->text}}</td>
                                    <td>{{$variant->getAnswers()->count() }}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <canvas id="chart" style="width:100%;max-width:700px"></canvas>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('end-scripts')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script>

        let pollId = $('.card-body').data('id');
        fetch(`/poll/${pollId}/data`)
        //fetch('{{route('poll-votes-data', [$model])}}')
            .then(r => r.json())
            .then(response => {

                const data = {
                    labels: response.labels,
                    datasets: [
                        {
                            label: response.label,
                            data: response.data,
                            backgroundColor: ["red", 'green', 'yellow', 'black'],
                        },
                    ]
                };

                const config = {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };
                const myChart = new Chart(document.getElementById('chart'), config);
            })





    </script>

@endsection
