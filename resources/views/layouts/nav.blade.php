<div class="row justify-content-center">
<div class="col-md-8">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (request()->segment(1) == 'home') || (request()->segment(1) == 'employee') ? 'active' : '' }}">
              <a class="nav-link" href="{{route('home')}}">All Employee</span></a>
            </li>
          </ul>
        </div>
      </nav>
      </div>
</div>