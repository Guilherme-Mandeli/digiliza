<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <div class="dropdown">
                <a href="#" class="user-drop-select dropdown-toggle m-2 p-2 d-flex flex-column align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="row1col1-2">
                        <h5 class="text-start">Conectado como:</h5>
                    </div>
                    <div class="row2col1-2 d-flex align-items-center">
                        <i class="fas fa-user me-1"></i>
                        <span id="leftbar_username">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="row1-2col2 pt-1">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </a>
                
                <div class="dropdown-menu user-pro-dropdown">
                    <a href="/" class="dropdown-item notify-item">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    
                    <a href="#" class="dropdown-item notify-item">
                        <i class="fas fa-cog"></i>
                        <span>Configurações</span>
                    </a>

                    <hr class="my-2">
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item btn btn-link p-0">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Desconectar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title mt-2">Navegação</li>
                
                <?php
                    use App\Models\User;
                    use Carbon\Carbon;
                
                    $user = User::find( Auth::id() );
                    $schedules = $user->schedules;
                ?>
                
                <li id="menu_categoria">
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        @if( count( $schedules ) > 0 )
                            <span><strong>Seus agendamentos</strong></span>
                        @else
                            <span><strong>Nenhum agendamento</strong></span>
                        @endif
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            
                            <li id="submenu_agendamento_todos">
                                <a href="/dashboard"><i class="fas fa-calendar"></i> Ver todos</a>
                            </li>

                            @foreach($schedules as $schedule)
                                <li id="submenu_agendamento_{{ $schedule->id }}">
                                    <a href="/dashboard/{{ $schedule->id }}"><i class="fas fa-calendar"></i> {{ Carbon::createFromFormat('Y-m-d', $schedule->date)->format('d/m/Y') }} - {{ Carbon::createFromFormat('H:i:s', $schedule->hour)->format('H:i') }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                <li id="menu_ferramentas">
                    <a href="#">
                        <span><strong>Configurações</strong></span>
                    </a>
                </li>
                
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>