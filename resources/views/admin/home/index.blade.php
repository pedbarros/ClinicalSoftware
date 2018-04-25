@extends('adminlte::page')

@section('title', 'Página Inicial')

@section('content_header')
    <h1>Página Inicial</h1>
@stop

@section('content')
    {{--{{auth()->user()->nivel_acesso()->first()->id}}

    <div class="row">
        <textarea>{{ session('token') }}</textarea>
    </div>

    @if(Auth::user()->nivel_acesso()->first()->id == 1)
        <p> É profissional da clinica! </p>
    @elseif(Auth::user()->nivel_acesso()->first()->id == 2)
        <p> É profissional da clinica! </p>
    @else
        <p> Não é profissional da clinica! </p>
    @endif--}}


    {{--   $qtdAtendimentos --}}
    <div class="row">
        <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">ESTATÍSTICAS DE ATENDIMENTO</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">

                        @foreach($qtdAtendimentos as $qtdAtendimento)
                            <div class="col-md-3">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                    <div class="info-box-content">
                                        @if($qtdAtendimento->sigla_status== "C")
                                            <span class="info-box-text">Atendidos</span>
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @elseif($qtdAtendimento->sigla_status== "E")
                                            <span class="info-box-text">Em espera</span>
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @elseif($qtdAtendimento->sigla_status== "F")
                                            <span class="info-box-text">Faltas</span>
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @elseif($qtdAtendimento->sigla_status== "X")
                                            <span class="info-box-text">Cancelados</span>
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @endif

                                        <div class="progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                        <span class="progress-description">Clique aqui...</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--
                        <div class="col-md-3">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Atendidos</span>
                                    @foreach($qtdAtendimentos as $qtdAtendimento)
                                        @if($qtdAtendimento->sigla_status== "C")
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                            @break
                                        @endif
                                    @endforeach
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                    <span class="progress-description">Clique aqui...</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box bg-blue">
                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Em espera</span>
                                    @foreach($qtdAtendimentos as $qtdAtendimento)
                                        @if($qtdAtendimento->sigla_status== "E")
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                            @break
                                        @endif
                                    @endforeach
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                    <span class="progress-description">Clique aqui...</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Pendentes</span>
                                    @foreach($qtdAtendimentos as $qtdAtendimento)
                                        @if($qtdAtendimento->sigla_status== "P")
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @endif
                                    @endforeach
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                    <span class="progress-description">Clique aqui...</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Faltas</span>
                                    @foreach($qtdAtendimentos as $qtdAtendimento)
                                        @if($qtdAtendimento->sigla_status== "F")
                                            <span class="info-box-number">{{  $qtdAtendimento->qtd }}</span>
                                        @endif
                                    @endforeach
                                    <div class="progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                    <span class="progress-description">Clique aqui...</span>
                                </div>
                            </div>
                        </div>
--}}
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">ACESSO RÁPIDO E FÁCIL</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i
                                                class="glyphicon glyphicon-calendar"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Agendar</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-chevron-right"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Procedimentos</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Pacientes</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i
                                                class="fa fa-money"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Financeiro</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-user"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Profissionais</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a class="users-list-name" href="#">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i
                                                class="glyphicon glyphicon-list-alt"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Horários</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop