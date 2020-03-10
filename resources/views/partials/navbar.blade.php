<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/" style="color:#777"><span style="font-size:15pt">&#9820;</span> Videoclub</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if( Auth::check() )
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('catalog') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog')}}">
                            <i class="fas fa-book-open"></i>
                            Catálogo
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('category') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/category')}}">
                            <i class="fas fa-certificate"></i>
                            Categorías
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('ranking') && ! Request::is('catalog/create')? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/ranking')}}">
                          <i class="fas fa-medal"></i>
                            Ránking
                        </a>
                    </li>
                    <li class="nav-item {{  Request::is('catalog/create') ? 'active' : ''}}">
                        <a class="nav-link" href="{{url('/catalog/create')}}">
                            <span>&#10010</span> Nueva película
                        </a>
                    </li>
                    <li class="nav-item">
                      <form action="{{ action('CatalogController@searcher')}}" method="GET">
                        <div class="row">
                          <div class="col-8">
                            <input class="form-control" type="text" name="q" id="q" required/>
                          </div>
                          <div class="col-2">
                            <button type="submit" id="busc" class="btn btn-dark"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">

                  <li class="nav-item mr-3 mt-2">
                    <a href="{{ url('/favoritos') }}"><i class="fas fa-hand-holding-heart" style="color:gray; font-size:2rem"></i></a>
                  </li>
                    <li class="nav-item">
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                            {{ csrf_field() }}
                            <button type="submit" id="salir" class="btn btn-link nav-link" style="display:inline;cursor:pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
