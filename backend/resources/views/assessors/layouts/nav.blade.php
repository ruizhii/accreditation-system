<div class="header">
    <div class="d-flex justify-content-between mx-3 my-3" style="background-color:white;">
        <div>
            <img src="{{ asset('images/um-logo.png') }}" alt="Logo" class="logo">
        </div>
        <div></div>
        <div class="text-right">
            <form action="{{ route('assessors.logout') }}" method="POST" style="display: none;" id="logout-form">
                @csrf
            </form>
            <i class="fa fa-user" aria-hidden="true"></i> {{ auth('assessors')->user()->name }}<br>
            <i class='fas fa-sign-out-alt'></i> <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
    </div>
</div>
