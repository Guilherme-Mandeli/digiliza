@extends('admin.index')
@section('page_title', 'Novo agendamento')
@section('menucfg')
    <input type="hidden" class="menu-config" value="menu_categoria">
    <input type="hidden" class="menu-config" value="Novo agendamento">
@endsection
@section('content')

    <!-- CONTEUDO -->
    <div class="col-sm-12">

        <div class="row">
            <div class="col-lg-12">
                <a href="/dashboard" class="btn btn-return mb-3"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
        </div>

        <div class="card p-3 bg-white" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
            <div class="card-header pt-0 bg-white">
                <h2 class="text-center">Novo Agendamento</h2>
            </div>
            <div class="card-body custom-form bg-white overflow-hidden">
                <span id="error-msg"></span>
                <form method="post" name="schedule-form" onsubmit="return validateForm()">
                    @csrf
                
                    @if( Auth::check() )
                        <input id="name" type="hidden" name="guest_name" value="{{ Auth::user()->name }}" >
                        <input id="user-id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                    @endif
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="data" class="form-label">Data desejada</label>
                                <input type="text" id="basic-datepicker2" class="form-control" name="date" placeholder="Selecione a data" readonly="readonly" required>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="guest-amout" class="form-label">Quantidade de pessoas</label>
                                <input class="form-control" id="guest-amout" type="number" name="guest_amount" placeholder="Nº" required>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="hour" class="form-label h4">Horário</label>
                                <span class="opacity-50" id="schedule-hour-alert"> | Preencha a data para ver os horários.</span>
                                <select name="hour" class="form-control select2" data-plugin="select2" data-toggle="select2" disabled="disabled" required>
                                    <option value="">Selecione um horário</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    
                    <div class="row">
                        <div class="col-lg-12 text-end">
                            <input type="submit" id="schedule-submit" name="send" class="submitBnt btn btn-primary" value="Agendar" disabled="disabled"/>
                        </div>
                    </div>
                    <!-- end row -->
                </form>
                <!-- end custom-form -->
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#basic-datepicker").datepicker();
        });
    </script>
    <script>
        $(function() {
            $("#basic-datepicker").datepicker({
                dateFormat: "dd/mm/yy",
                minDate: 0,
                maxDate: "+1m",
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "1900:2030"
            });
        });
    </script>
@endsection
