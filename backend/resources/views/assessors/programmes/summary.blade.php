@extends('assessors/layouts/app')

@section('title', 'Assessor Summary')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container content text-center">
        <h3 class="text-center mb-3">Summary Page</h3>
        <hr>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Section</th>
                <th scope="col">Title</th>
                <th scope="col">Suggest Score</th>
                <th scope="col">Commendation</th>
                <th scope="col">Affirmation</th>
                <th scope="col">Recommendation</th>
              </tr>
            </thead>
            <tbody>
                @foreach($assessorProgramme->assessorProgrammeAreas as $area)
                    @foreach($area->assessorProgrammeSections as $section)
                    <tr>
                        <td>{{ $section->section }}</td>
                        <td>{{ $section->title }}</td>
                        <td>{{ $section->suggested_score }}</td>
                        <td>{{ $section->commendations }}</td>
                        <td>{{ $section->affirmations }}</td>
                        <td>{{ $section->recommendations }}</td>
                      </tr>
                    @endforeach
                @endforeach
            </tbody>
          </table>
    </div>
