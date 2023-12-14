@extends('assessors/layouts/app')

@section('title', 'Assessor Reference')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container content">
        <h3 class="text-center mb-3">Reference Page</h3>
        <hr>
        <p>
            Acceptable: The evidence is in order.<br>
            Excused: The evidence may be unavailable or not in format or other reasons. However, the panel finds it acceptable. The panel should point out why it is acceptable.<br>
            Unavailable: The evidence is not available.<br>
            Irrelevant: Although evidence is provided, it is not relevant to the context.<br>
            Format Error: The evidence provided does not follow the recommended format.<br><br>

            <b>Formats for the different type of evidences</b><br><br>

            Minutes of meeting: (can also give meeting notes if not formal meeting)<br>
            1)     The front page (showing the title)<br>
            2)     The attendance (showing all the members, who is present and absent)<br>
            3)     The snipping of the relevant information as required.<br>
            4)     Signature (not applicable for meeting notes)<br><br>

            Survey:<br>
            1)     The empty survey form. (highlight the question that is relevant question)<br>
            2)     The processed data (data that is compile into graphs or tables.)<br>
            3)     The analysis of the processed data.<br>
            4)     The minutes discussing the actions related to the survey results.<br><br>

            Letters:<br>
            1)     The letter (highlight the relevant required information)<br>
            2)     If it is “letter of appointment”, then should include the term of reference (TOR).<br><br>

            Processes, procedures and mechanisms, guidelines, policies, book<br>
            1)     If it is a single “arahan kerja” (or a single document on the guideline or policy) completely relevant with the required information, just attached the whole thing.<br>
            2)     If it is one part of a book, extract <br>
            a.      The front cover of the book<br>
            b.      Only the pages that contains the required information<br><br>

            Forms:<br>
            1)     The filled up forms (usually at least for 3 consecutive years if available)<br>
            2)     *Empty forms if that form has yet been filled because has yet to reached the stage to fill up the form. (typically for provisional accreditation).<br><br>

            Reports:<br>
            1)     Report of a certain study or visit <br><br>

            Pictures/ snap shot of website<br>
            1)     Paste it into a word document.<br>
            2)     Put in a relevant title and also a short description (Main thing is the reader understand what is seen).<br><br>

            Sample of… (to prove some processed has been carried out.)<br>
            1)     All the letters, forms and documents related to that process.<br><br>

            Evidence of…<br>
            1)     The Author can choose to give whatever evidence deemed fit to support that requirement.
        </p>
    </div>
