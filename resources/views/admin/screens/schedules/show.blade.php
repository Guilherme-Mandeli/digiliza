@extends('dashboard')
@section('page_title', 'Agendamento')
@section('menucfg')
    <input type="hidden" class="menu-config" value="menu_categoria">
    <input type="hidden" class="menu-config" value="submenu_primeiros_passos">
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
        
        <div class="card p-3 bg-white" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; border: 2px dashed #ccc">
            
            <div class="card-header pt-0 bg-white">
                <h2 class="text-center">Informações do agendamento</h2>
            </div>

            <div class="card-body custom-form bg-white overflow-hidden">
                <div class="row">
                    <?php use Carbon\Carbon; ?>

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

                <hr class="m-0">

                <div class="card-footer pt-1 pb-0 bg-white opacity-75 text-end">

                    <form action="/dashboard/{{ $schedule->id }}/cancel" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cancel-schedule-btn btn waves-effect">
                            <i class="fas fa-user-times" style="padding-top: 3px;"></i> <span class="ms-2">Cancelar agendamento</span>
                        </button>
                    </form>
                </div>

            </div>    
        </div>

    </div>

    @include('admin.components.post-navigation')

@endsection
