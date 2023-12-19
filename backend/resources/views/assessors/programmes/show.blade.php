@extends('assessors/layouts/app')

@section('title', 'Assessor Areas')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container content text-center">
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <p class="mb-5" style="font-size:20px;">
            Assessment Page for <b>BACHELOR OF ({{ strtoupper($assessorProgramme->academicProgramme->name) }})</b>
        </p>

        <div class="container">
            <div class="row">
                @foreach ($assessorProgramme->assessorProgrammeAreas as $area)
                    <div class="col-4 mb-5">
                        <a
                            href="{{ route('assessors.programme.section.show', ['programme_id' => $area->assessorProgramme->id,'id' => $area->assessorProgrammeSections()->orderBy('section', 'asc')->first()->id]) }}">
                            <button class="btn btn-secondary btn-lg btn-block">Area {{ $area->area }}</button>
                        </a>
                    </div>
                @endforeach
                <div class="col-4 mb-5">
                    <a href="{{ route('assessors.reference') }}">
                        <button class="btn btn-lg btn-block" style="background-color:grey;color: white;">Reference</button>
                    </a>
                </div>
                <div class="col-4 mb-5">
                    <a href="{{ route('assessors.programme.summary', ['id' => $assessorProgramme->id]) }}">
                        <button class="btn btn-lg btn-block" style="background-color:grey;color: white;">Summary</button>
                    </a>
                </div>
            </div>

            <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <form id="statusUpdateForm" method="POST"
                        action="{{ route('assessors.programme.updateStatus', ['id' => $assessorProgramme->id]) }}">
                        @csrf
                        @if ($assessorProgramme->is_completed)
                            <button type="button" class="btn btn-lg btn-primary" disabled>SUBMITTED</button>
                        @else
                            <button type="button" class="btn btn-lg btn-block btn-primary"
                                onclick="confirmSubmit()">Submit</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmSubmit() {
            if (confirm("Are you sure you want to submit?")) {
                // If the user clicks "OK" in the confirmation dialog, submit the form
                $('#statusUpdateForm').submit();
            } else {
                // If the user clicks "Cancel," do nothing or provide additional handling
            }
        }
    </script>
