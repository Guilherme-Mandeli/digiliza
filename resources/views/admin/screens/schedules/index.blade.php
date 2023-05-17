@extends('dashboard')
@section('page_title', 'Seus Agendamentos')
@section('menucfg')
    <input type="hidden" class="menu-config" value="menu_categoria">
@endsection
@section('content')
    <!-- CONTEUDO -->
    {{-- <x-post-alert
        icon="fas fa-bell"
        text="<strong>Atualização na documentação:</strong> Novas informações adicionadas. Por favor, revise a documentação mais recente para manter-se informado."
        border-color="steelblue"
        icon-color="#0C6291"
    /> --}}

    <div class="col-sm-12">
        
        <div class="row">
            <div class="col-lg-12">
                <a href="/dashboard/novo" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Novo agendamento</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if( session( 'success' ) )
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if( session( 'error' ) )
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex flex-wrap">
                
                <?php
                    use App\Models\User;
                    use Carbon\Carbon;
                
                    $user = User::find( Auth::id() );
                    $schedules = $user->schedules;
                ?>

                @if( count( $schedules ) > 0 )
                    @foreach( $schedules as $schedule )
                        <div class="card p-2 bg-white m-2 schedule-item" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; border: 2px dashed #ccc">
                            
                            <div class="card-header pt-0 bg-white">
                                <h2 class="text-center">Agendamento {{ Carbon::createFromFormat('Y-m-d', $schedule->date)->format('d/m/Y') }}</h2>
                            </div>

                            <div class="card-body pb-2 custom-form bg-white overflow-hidden">
                                <div class="row">
                                    <p>
                                        <strong class="h4">Nome: </strong>
                                        <span>{{ $schedule->guest_name }}</span>
                                    </p>
                                    <p>
                                        <strong class="h4">Data agendada: </strong>
                                        <span>{{ Carbon::createFromFormat('Y-m-d', $schedule->date)->format('d/m/Y') }}</span>
                                    </p>
                                    <p>
                                        <strong class="h4">Quantidade de pessoas: </strong>
                                        <span>{{ $schedule->guest_amount }}</span>
                                    </p>
                                    <p>
                                        <strong class="h4">Horário: </strong>
                                        <span>{{ Carbon::createFromFormat('H:i:s', $schedule->hour)->format('H:i') }}</span>
                                    </p>
                                </div>
                            </div>

                            <hr class="m-0">

                            <div class="card-footer pt-1 pb-0 bg-white opacity-75 text-end">

                                <form action="/dashboard/{{ $schedule->id }}/cancel" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cancel-schedule-btn btn waves-effect">
                                        <i class="fas fa-user-times"></i>
                                    </button>
                                </form>
                                <a href="/dashboard/{{ $schedule->id }}" class="view-schedule-btn"><i class="fas fa-eye btn waves-effect"></i></a>
                            </div>

                        </div>
                    @endforeach
                @else
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Nenhum agendamento realizado.</h3>

                        <p>Deseja agendar no Gourmet Night?</p>
                        <a href="/dashboard/novo" class="btn btn-link m-0"><i class="fas fa-plus"></i> Novo agendamento</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>

@endsection
