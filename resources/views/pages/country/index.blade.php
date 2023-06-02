@extends('layouts.main')

@section('title', "Countries")

@section('content')
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="search" class="form-label">Search</label>
                <input type="text" class="form-control" id="search" placeholder="Search...">
            </div>
        </div>
    </div>
    <div class="row mt-5" id="countries-list">
    </div>
@endsection

@section('end-scripts')
    <script>
        $(document).ready(function () {
            let listContainer = $("#countries-list")

            function update() {
                let searchInput = $("input#search")
                fetch("{{route('country-search', [null])}}/" + searchInput.val())
                    .then(response => response.json())
                    .then(data => {
                        listContainer.empty()
                        if (!Array.isArray(data)) {
                            data = Object.keys(data).map((key) => [data[key]])
                        }
                        data.forEach(name => {
                            let el = $(`<div class="col-md-3">${name}</div>`)
                            listContainer.append(el)
                        })
                    })
            }

            update()

            $(document).on("input", "input#search", update)
        })
    </script>
@endsection
