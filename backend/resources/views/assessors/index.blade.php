@extends('assessors/layouts/app')

@section('title', 'Assessor Programmes')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container content">
        {{-- {!! nl2br("2) Processes on Curriculum review (Can refer UM-PT01-PK03 Perkembangan Kurikulum Ijazah Dasar)\n3) Evidences that CR reach the highest academic authority (Minutes of Faculty approval on CR; Senate approval letter for the current curriculum)") !!} --}}
        @if ($assessorProgrammes->count() > 0)
            <table class="table mx-3" style="border-collapse: separate; border-spacing: 1em;">
                <thead>
                    <tr class="text-center border-0">
                        <th scope="col" style="border:none">Programme</th>
                        <th scope="col" style="border:none">Status</th>
                        <th scope="col" style="border:none">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assessorProgrammes as $assessorProgramme)
                        <tr class="text-center">
                            <td style="border:none;background-color:white">{{ $assessorProgramme->academicProgramme->name }}
                            </td>
                            <td style="border:none;">
                                @if ($assessorProgramme->is_completed)
                                    <p style="color:green;"><b>COMPLETED</b></p>
                                @else
                                    <p style="color:blue;"><b>ASSESSING</b></p>
                                @endif
                            </td>
                            <td style="border:none;">
                                <a href="{{ route('assessors.programme.show', ['id' => $assessorProgramme->id]) }}">
                                    <button type="button" class="btn btn-success"
                                        style="border-radius:20px;shadow;box-shadow: 2px 2px lightgreen;">Assess
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                        </i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No programme has been assigned to you yet.</h3>
        @endif

    </div>
