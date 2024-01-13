<div class="header">
    <div class="d-flex justify-content-between px-5 py-3" style="background-color:white;">
        <div>
            <p>
                <img src="{{ asset('images/um-logo.png') }}" alt="Logo" class="logo"
                    style ="width: 200px; height: 60px">
                <a href="{{ route('assessors.index') }}">
                    <button class="btn btn-secondary">Home</button>
                </a>
                <a href ="mailto: qmec@um.edu.my">
                    <button class="btn btn-secondary">Contact us: qmec@um.edu.my</button>
                </a>
            </p>
            
            @if (Route::currentRouteNamed('assessors.programme.section.show'))
                <a href="{{ route('assessors.programme.show', ['id' => $programme_id]) }}">
                    <button type="button" class="btn btn-secondary">Area</button>
                </a>

                <button type="button" onclick="printPage()" class="btn btn-secondary">Print Area
                    {{ $assessorProgrammeSection->assessorProgrammeArea->area }}</button>
            @endif
        </div>
        <div></div>
        <div class="text-right">
            <form action="{{ route('assessors.logout') }}" method="POST" style="display: none;" id="logout-form">
                @csrf
            </form>
            <p style="font-size:18px;">
                <b>QMEC Academic Accreditation portal for Assessors</b> <br>
                <a href="{{ route('assessors.profile') }}">
                    <i class="fa fa-user my-3" aria-hidden="true"></i> <span style="color:black">{{ auth('assessors')->user()->name }}</span><br>
                </a>
                <i class='fas fa-sign-out-alt'></i> <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span style="color:black">Logout</span></a>                    
            </p>
        </div>
    </div>
</div>
