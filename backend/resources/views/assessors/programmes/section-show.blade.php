@extends('assessors/layouts/app')

@section('title', 'Assessor Area ' . $assessorProgrammeSection->assessorProgrammeArea->area)

@section('content')
    @include('assessors/layouts/nav')

    @php
        $activeSectionId = request()->route('id');
    @endphp

    <div class="container text-white">
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <p class="mt-3">Assessment page for <b>BACHELOR OF
                ({{ strtoupper($assessorProgrammeSection->assessorProgrammeArea->assessorProgramme->academicProgramme->name) }})</b>
        </p>

        <div class="row">
            @foreach ($assessorProgrammeSection->assessorProgrammeArea->assessorProgrammeSections as $section)
                <div class="col-auto mb-3">
                    <a
                        href="{{ route('assessors.programme.section.show', ['programme_id' => $assessorProgrammeSection->assessorProgrammeArea->assessorProgramme->id, 'id' => $section->id]) }}">
                        <button
                            class="btn {{ $activeSectionId == $section->id ? 'background-section-active' : 'background-grey' }}"
                            style="color: black; border-radius: 20px;">
                            <b>Section {{ $section->section }}</b>
                        </button>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row mb-3 ">
            <div class="col-12">
                Section {{ $assessorProgrammeSection->section }}: {{ $assessorProgrammeSection->title }}
            </div>
        </div>

        <div class="row">
            <form method="POST"
                action="{{ route('assessors.programme.section.store', ['programme_id' => $assessorProgrammeSection->assessorProgrammeArea->assessorProgramme->id, 'id' => $assessorProgrammeSection->id]) }}">
                @csrf
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Sub</th>
                            <th scope="col">Standard COPPA</th>
                            <th scope="col">Keys Element/Relevant Information</th>
                            <th scope="col">Evidence</th>
                            <th scope="col">Address COPPA requirements (Key element)</th>
                            <th scope="col">Evidence Status</th>
                            <th scope="col">Other Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessorProgrammeSection->assessorProgrammeSubs as $sub)
                            <tr>
                                <th scope="row">{{ $sub->sub }}</th>
                                <td>{!! nl2br(str_replace('\n', '<br>', $sub->standard_coppa)) !!}</td>
                                <td>{!! nl2br(str_replace('\n', '<br>', $sub->keys_element)) !!}</td>
                                <td>{!! nl2br(str_replace('\n', '<br>', $sub->evidence)) !!}</td>
                                <td>
                                    <select class="form-select" name="coppa_requirements[{{ $sub->id }}]">
                                        <option selected disabled>Select an option</option>
                                        <option value="yes" {{ $sub->coppa_requirement == 'yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="no" {{ $sub->coppa_requirement == 'no' ? 'selected' : '' }}>No
                                        </option>
                                        <option value="not_applicable"
                                            {{ $sub->coppa_requirement == 'not_applicable' ? 'selected' : '' }}>Not
                                            Applicable</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="evidence_statuses[{{ $sub->id }}]">
                                        <option selected disabled>Select an option</option>
                                        <option value="acceptable"
                                            {{ $sub->evidence_status == 'acceptable' ? 'selected' : '' }}>Acceptable
                                        </option>
                                        <option value="excused" {{ $sub->evidence_status == 'excused' ? 'selected' : '' }}>
                                            Excused</option>
                                        <option value="unavailable"
                                            {{ $sub->evidence_status == 'unavailable' ? 'selected' : '' }}>Unavailable
                                        </option>
                                        <option value="irrelevant"
                                            {{ $sub->evidence_status == 'irrelevant' ? 'selected' : '' }}>Irrelevant
                                        </option>
                                        <option value="format_error"
                                            {{ $sub->evidence_status == 'format_error' ? 'selected' : '' }}>Format Error
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn-block m-0 open-modal"
                                        data-title="Notes For {{ $sub->sub }}" data-value="{{ $sub->notes }}"
                                        data-input-class="notes-{{ $sub->id }}">Notes</button>
                                    <input type="hidden" class="notes-{{ $sub->id }}"
                                        name="notes[{{ $sub->id }}]" value="{{ $sub->notes }}">
                                    <button type="button" class="btn-block m-0 open-modal"
                                        data-title="Information Request For {{ $sub->sub }}"
                                        data-value="{{ $sub->information_request }}"
                                        data-input-class="information-request-{{ $sub->id }}">Information
                                        request</button>
                                    <input type="hidden" class="information-request-{{ $sub->id }}"
                                        name="information-requests[{{ $sub->id }}]"
                                        value="{{ $sub->information_request }}">
                                    <button type="button" class="btn-block m-0 open-modal"
                                        data-title="Question For {{ $sub->sub }}" data-value="{{ $sub->question }}"
                                        data-input-class="question-{{ $sub->id }}">Question</button>
                                    <input type="hidden" class="question-{{ $sub->id }}"
                                        name="questions[{{ $sub->id }}]" value="{{ $sub->question }}">
                                    <button type="button" class="btn-block m-0 open-modal"
                                        data-title="Observation For {{ $sub->sub }}"
                                        data-value="{{ $sub->observation }}"
                                        data-input-class="observation-{{ $sub->id }}">Observation</button>
                                    <input type="hidden" class="observation-{{ $sub->id }}"
                                        name="observations[{{ $sub->id }}]" value="{{ $sub->observation }}">
                                    <input type="hidden" name="input-name">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="ml-5">Suggested Score: {{ $assessorProgrammeSection->suggested_score }}</h5>
                <h5 class="ml-5 mb-3">Panel Score: <input type="number" name="panel_score"
                        value="{{ $assessorProgrammeSection->panel_score }}"></h5>

                <div class="row mb-3">
                    <div class="col">
                        <div class="border border-light px-3 pt-2">
                            <p>Commendations:</p>
                            <textarea name="commendations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                                cols="50">{{ $assessorProgrammeSection->commendations }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border border-light px-3 pt-2">
                            <p>Affirmations:</p>
                            <textarea name="affirmations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                                cols="50">{{ $assessorProgrammeSection->affirmations }}</textarea>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border border-light px-3 pt-2">
                            <p>Recommendations:</p>
                            <textarea name="recommendations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                                cols="50">{{ $assessorProgrammeSection->recommendations }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="container text-center">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="contentToPrint" class="d-none">
        <h2>Area {{ $assessorProgrammeSection->assessorProgrammeArea->area }}</h2>
        <div class="page-break"></div>
        @foreach ($assessorProgrammeSection->assessorProgrammeArea->assessorProgrammeSections as $section)
            <h3>Section {{ $section->section }}: {{ $section->title }}</h3>
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">Sub</th>
                        <th scope="col">Standard COPPA</th>
                        <th scope="col">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->assessorProgrammeSubs as $sub)
                        <tr>
                            <th scope="row">{{ $sub->sub }}</th>
                            <td>{!! nl2br(str_replace('\n', '<br>', $sub->standard_coppa)) !!}</td>
                            <td>{!! nl2br(str_replace('\n', '<br>', $sub->notes)) !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="ml-5 mb-3">Panel Score: <input type="number" name="panel_score"
                    value="{{ $sub->assessorProgrammeSection->panel_score }}"></h5>

            <div class="row mb-3">
                <div class="col">
                    <div class="border border-light px-3 pt-2">
                        <p>Commendations:</p>
                        <textarea name="commendations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                            cols="50">{{ $assessorProgrammeSection->commendations }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="border border-light px-3 pt-2">
                        <p>Affirmations:</p>
                        <textarea name="affirmations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                            cols="50">{{ $assessorProgrammeSection->affirmations }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="border border-light px-3 pt-2">
                        <p>Recommendations:</p>
                        <textarea name="recommendations[{{ $assessorProgrammeSection->id }}]" class="form-control mb-3" rows="7"
                            cols="50">{{ $assessorProgrammeSection->recommendations }}</textarea>
                    </div>
                </div>
            </div>
            <div class="page-break" style="break-after:page"></div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <input type="text" class="form-control" id="inputValue"> --}}
                    <textarea id="inputValue" class="form-control" rows="6" cols="50">
                        </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script>
        $(document).ready(function() {
            // Open modal on button click
            $(".open-modal").click(function() {
                title = $(this).data("title");
                inputClass = $(this).data("input-class");
                value = $('.' + inputClass).val();

                $('.modal-title').text(title);
                $('#inputValue').val(value);
                $('.' + inputClass).val(value);

                $("#modal").modal();
            });

            $('#inputValue').on('change', function() {
                $('.' + inputClass).val($(this).val())
            });
        });

        function printPage() {
            var content = document.getElementById('contentToPrint');
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = '<html><head><title>Print</title></head><body>' + content.innerHTML +
                '</body></html>';

            window.print();

            document.body.innerHTML = originalContent;
        }
    </script>
