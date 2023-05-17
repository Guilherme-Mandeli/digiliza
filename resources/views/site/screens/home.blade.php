@extends('site.index')
@section('page_title', 'Gourmet Night')
@section('site-content')
    <!-- home start -->
    <section class="bg-home" id="home">
        <div class="home-center">
            <div class="home-desc-center">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6">
                            <div class="home-title">
                                <h5 class="mb-3 text-white text-opacity-75">Seu restaurante de confiança</h5>
                                <h1 class="mb-4 text-white">Festeje seus sentidos no melhor restaurante da cidade.</h1>
                                <p class="text-white home-desc font-16 mb-4">Reserve agora e desfrute de experiências gastronômicas únicas.</p>
                                <a href="#schedule" class="btn btn-primary">Agende agora!</a>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1 col-sm-6 mt-4 mt-md-0">
                            <div class="card hero-login">
                                <div class="card-body p-4">

                                    <div class="text-center mb-4">
                                        <h4 class="text-uppercase mt-0 text-white text-opacity">Consultar seus agendamentos</h4>
                                    </div>
                                    @if( !Auth::check())
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                
                                            @error('email')
                                                <div class="alert alert-danger px-2 py-1 opacity-75" role="alert">
                                                    <span>As credenciais informadas estão incorretas.</span>
                                                </div>
                                            @enderror
                                            <div class="text-white">
                                                <x-label for="email" value="{{ __('E-mail') }}" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                            </div>
                                
                                            <div class="mt-4 text-white">
                                                <x-label for="password" value="{{ __('Senha') }}" />
                                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                            </div>
                                
                                            <div class="block mt-4 text-white">
                                                <label for="remember_me" class="flex items-center">
                                                    <x-checkbox id="remember_me" name="remember" />
                                                    <span class="ml-2 text-sm text-gray-600">{{ __('Permanecer conectado') }}</span>
                                                </label>
                                            </div>
                                
                                            <div class="flex items-center justify-end mt-4">
                                                {{-- @if (Route::has('password.request'))
                                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                        {{ __('Esqueceu sua senha?') }}
                                                    </a>
                                                @endif --}}
                                                <div class="mb-3 mt-4 d-grid text-center">
                                                    <x-button class="ml-4">
                                                        {{ __('Acessar painel') }}
                                                    </x-button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-white">
                                            Olá, {{ Auth::user()->name }}
                                        </p>
                                        <div class="mt-4 d-grid text-center">
                                            <a href="/dashboard" class="btn btn-primary">Acessar painel</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div>
                                @error('password')
                                    <div class="alert alert-danger px-2 py-1 opacity-75" role="alert">
                                        <span>Falha no cadastro. As senhas precisam coincidir.</span>
                                    </div>
                                @enderror
                                <p class="text-end pe-2">
                                    @if( !Auth::check())
                                        <span class="text-white">Não está registrado?</span>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#signup-modal" class="text-white"><u> Criar uma conta nova</u></a>
                                    @else
                                        <div class="row text-end pe-2" style="margin-top: -12px;">
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-white btn btn-link p-0"><u>Desconectar</u></button>
                                            </form>
                                        </div>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                </div>
                <!-- end container-fluid -->
            </div>
        </div>
    </section>
    <!-- home end -->

    <!-- schedule start -->
    <section class="section" id="schedule">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-2">
                    <div class="title text-center mb-5">
                        <h6 class="text-primary small-title">Experimente seu melhor jantar</h6>
                        <h2>Agendar</h2>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row d-flex justify-content-around">
                <div class="col-lg-5">
                    
                    <div class="card pb-3" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; margin-top: -24px;">
                        <div class="card-header bg-white">
                            <h5 class="text-center">Para qual dia e horário?</h5>
                        </div>
                        <div class="card-body custom-form bg-white">
                            <span id="error-msg"></span>
                            <form method="post" name="schedule-form" onsubmit="return validateForm()">
                                @csrf

                                @if( Auth::check() )
                                    <input type="hidden" name="guest_name" value="{{ Auth::user()->name }}" >
                                    <input id="user-id" type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                @endif

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="data" class="form-label">Data desejada</label>
                                            <input type="text" id="basic-datepicker2" class="form-control flatpickr-input active" name="date" placeholder="Selecione a data" readonly="readonly" required>
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
                                            <label for="hour" class="form-label">Horário</label>
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

                                        @if ( Auth::check() )
                                            <input type="submit" id="schedule-submit" name="send" class="submitBnt btn btn-primary" value="Agendar" disabled="disabled" />
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"data-bs-target="#signup-modal">Agendar</button>
                                        @endif
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                            <!-- end custom-form -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="get-in-touch">
                        <h5>Nos chame</h5>
                        <p class="text-muted mb-3">Te respondemos em até 24h</p>

                        <div class="mb-1">
                            <div class="get-touch-icon float-start me-3">
                                <h2><i class="pe-7s-mail text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">E-mail</h5>
                                <p class="text-muted">guil.mandeli@gmail.com</p>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="get-touch-icon float-start me-3">
                                <h2><i class="pe-7s-phone text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">WhatsApp</h5>
                                <p class="text-muted">+55 (11) 99819-8765</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="get-touch-icon float-start me-3">
                                <h2> <i class="pe-7s-map-marker text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">Endereço</h5>
                                <p class="text-muted">São Paulo, SP - São Bernardo do Campo <br>09895-550</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </section>
    <!-- schedule end -->

    <!-- services start -->
    <section class="section bg-menu" id="menu">
        <div class="container-fluid">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6">
                    <div class="title text-center">
                        <h6 class="small-title text-white opacity-75">Para os melhores paladares</h6>
                        <h2 class="text-white">Jantar</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div id="menu-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#menu-carousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#menu-carousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/risoto-de-cogumelos-com-parmesao.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do primeiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Principal</small>
                                            <h5 class="card-title mt-2">Risoto de cogumelos com parmesão</h5>
                                            <p class="card-text">Arroz carnaroli com cogumelos frescos, finalizado com
                                                queijo parmesão.</p>
                                            <p class="card-text">R$ 45,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/file-de-salmao-grelhado-com-legumes.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do segundo item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Principal</small>
                                            <h5 class="card-title mt-2">Filé de salmão grelhado com legumes</h5>
                                            <p class="card-text"> Salmão grelhado com legumes no vapor e molho de
                                                manteiga e limão..</p>
                                            <p class="card-text">R$ 55,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/espaguete-a-carbonara-com-pancetta-e-ovo.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do terceiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Principal</small>
                                            <h5 class="card-title mt-2">Espaguete à carbonara com pancetta e ovo</h5>
                                            <p class="card-text">Massa fresca, pancetta crocante e ovo cremoso, tudo
                                                misturado em um molho delicioso.</p>
                                            <p class="card-text">R$ 40,00</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                            
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/batatas-rusticas-assadas-com-alecrim-e-alho.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do primeiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Acompanhamento</small>
                                            <h5 class="card-title mt-2">Batatas rústicas assadas com alecrim e alho
                                            </h5>
                                            <p class="card-text">Batatas cortadas em cubos, temperadas com alecrim e
                                                alho, assadas até ficarem crocantes.</p>
                                            <p class="card-text">R$ 18,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/arroz-branco-com-acafrao.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do segundo item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Acompanhamento</small>
                                            <h5 class="card-title mt-2">Arroz branco com açafrão</h5>
                                            <p class="card-text">Arroz branco cozido com caldo de legumes e açafrão,
                                                ficando soltinho e aromático.</p>
                                            <p class="card-text">R$ 10,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/salada-verde-com-vinagrete-de-mostarda.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do terceiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Acompanhamento</small>
                                            <h5 class="card-title mt-2">Salada verde com vinagrete de mostarda</h5>
                                            <p class="card-text">Folhas verdes frescas com cenoura, tomate e vinagrete
                                                de mostarda.</p>
                                            <p class="card-text">R$ 12,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#menu-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#menu-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


            </div>
            <!-- end row -->

            <div class="row justify-content-center mt-5 mb-3">
                <div class="col-lg-6">
                    <div class="title text-center">
                        <h2 class="text-white">Bebidas e Sobrimesas</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div id="menu-carousel2" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#menu-carousel2" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#menu-carousel2" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/caipirinha-de-limao.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do quarto item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Bebida</small>
                                            <h5 class="card-title mt-2">Caipirinha de limão</h5>
                                            <p class="card-text">Cachaça, limão, açúcar e gelo, servida em um copo bem
                                                gelado.</p>
                                            <p class="card-text">R$ 16,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/vinho-tinto-malbec.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do quinto item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Bebida</small>
                                            <h5 class="card-title mt-2">Vinho tinto Malbec</h5>
                                            <p class="card-text">Vinho de uvas Malbec, originário da Argentina, com
                                                notas de frutas escuras e especiarias.</p>
                                            <p class="card-text">R$ 70,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/cerveja-artesanal-IPA.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do sexto item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Bebida</small>
                                            <h5 class="card-title mt-2">Cerveja artesanal IPA</h5>
                                            <p class="card-text">Cerveja com amargor acentuado e aroma de lúpulo,
                                                harmonizando bem com comidas condimentadas.</p>
                                            <p class="card-text">R$ 15,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/pudim-de-leite-com-calda-de-caramelo.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do primeiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Sobremesa</small>
                                            <h5 class="card-title mt-2">Pudim de leite com calda de caramelo</h5>
                                            <p class="card-text">Sobremesa tradicional brasileira, com textura cremosa
                                                e calda de caramelo.</p>
                                            <p class="card-text">R$ 12,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/sorvete-de-baunilha-com-calda-de-frutas-vermelhas.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do segundo item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Sobremesa</small>
                                            <h5 class="card-title mt-2">Sorvete de baunilha com calda de frutas
                                                vermelhas</h5>
                                            <p class="card-text">Sorvete cremoso de baunilha, com calda de frutas
                                                vermelhas frescas.</p>
                                            <p class="card-text">R$ 18,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="{{ asset('landing/images/menu/Tiramisu-classico-italiano.jpg') }}"
                                            class="card-img-top d-block" alt="Imagem do terceiro item do cardápio">
                                        <div class="card-body" style="min-height: 232px;">
                                            <small>Sobremesa</small>
                                            <h5 class="card-title mt-2">Tiramisu clássico italiano</h5>
                                            <p class="card-text">Sobremesa italiana feita com camadas de biscoitos,
                                                queijo mascarpone e café, finalizada com cacau em pó.</p>
                                            <p class="card-text">R$ 20,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#menu-carousel2"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#menu-carousel2"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </section>
    <!-- services end -->

    <!-- depoiments start -->
    <section class="section bg-light" id="depoiments">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title text-center mb-4">
                        <h6 class="text-primary small-title">Depoimentos</h6>
                        <h4>Veja o que degustadores profissionais falam</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="testi-box p-4 bg-white mt-4 text-center">
                        <p class="text-muted mb-4">" Eu fiquei impressionado com a qualidade da comida neste restaurante!
                            Cada prato que experimentei foi uma verdadeira explosão de sabores deliciosos. O serviço também
                            foi excelente - todos os funcionários foram extremamente simpáticos e prestativos. Com certeza
                            vou voltar para experimentar mais pratos deliciosos! "</p>
                        <div class="testi-img mb-4">
                            <img src="{{ asset('landing/images/testi/img-1.png') }}" alt=""
                                class="rounded-circle img-thumbnail">
                        </div>
                        <p class="text-muted mb-1">Degustador profissional</p>
                        <h5 class="font-18">Marcos</h5>

                        <div class="testi-icon">
                            <i class="mdi mdi-format-quote-open display-2"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testi-box p-4 bg-white mt-4 text-center">
                        <p class="text-muted mb-4">" Eu adoro experimentar novos restaurantes e este lugar não me
                            decepcionou. A decoração é moderna e aconchegante, e a comida é simplesmente incrível! Eu pedi o
                            prato especial do chef e foi uma verdadeira obra-prima culinária. Os ingredientes eram frescos e
                            a apresentação era linda. Com certeza vou recomendar este restaurante para todos os meus amigos!
                            "</p>
                        <div class="testi-img mb-4">
                            <img src="{{ asset('landing/images/testi/img-2.png') }}" alt=""
                                class="rounded-circle img-thumbnail">
                        </div>
                        <p class="text-muted mb-1">Degustador profissional</p>
                        <h5 class="font-18">Gustavo</h5>

                        <div class="testi-icon">
                            <i class="mdi mdi-format-quote-open display-2"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testi-box p-4 bg-white mt-4 text-center">
                        <p class="text-muted mb-4">" Eu sou um verdadeiro conhecedor de vinhos e fiquei muito impressionado
                            com a seleção de vinhos deste restaurante. O sommelier foi extremamente experiente e me ajudou a
                            escolher um vinho que combinou perfeitamente com a minha refeição. Além disso, a comida era
                            deliciosa - eu experimentei o prato de frutos do mar e foi uma das melhores refeições que já
                            tive. Mal posso esperar para voltar e experimentar mais pratos acompanhados de uma boa taça de
                            vinho! "</p>
                        <div class="testi-img mb-4">
                            <img src="{{ asset('landing/images/testi/img-3.png') }}" alt=""
                                class="rounded-circle img-thumbnail">
                        </div>
                        <p class="text-muted mb-1">Degustador profissional</p>
                        <h5 class="font-18">Felipe</h5>

                        <div class="testi-icon">
                            <i class="mdi mdi-format-quote-open display-2"></i>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </section>
    <!-- depoiments end -->

    <!-- contact start -->
    <section class="section" id="contact">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title text-center mb-5">
                        <h6 class="text-primary small-title">Contato</h6>
                        <h4>Ficou com alguma dúvida ?</h4>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row d-flex justify-content-around">
                <div class="col-lg-4">
                    <div class="get-in-touch">
                        <h5>Entre em contato</h5>
                        <p class="text-muted mb-3">Te respondemos em até 24h</p>

                        <div class="mb-1">
                            <div class="get-touch-icon float-start me-3">
                                <h2><i class="pe-7s-mail text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">E-mail</h5>
                                <p class="text-muted">guil.mandeli@gmail.com</p>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="get-touch-icon float-start me-3">
                                <h2><i class="pe-7s-phone text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">WhatsApp</h5>
                                <p class="text-muted">+55 (11) 99819-8765</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="get-touch-icon float-start me-3">
                                <h2> <i class="pe-7s-map-marker text-primary"></i></h2>
                            </div>
                            <div class="overflow-hidden">
                                <h5 class="font-16 mb-0">Endereço</h5>
                                <p class="text-muted">São Paulo, SP - São Bernardo do Campo <br>09895-550</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; margin-top: -24px;">
                        <div class="card-header bg-white">
                            <h5>Nos escreva</h5>
                            @if(session('success'))
                                <div class="alert alert-success mt-2 mb-0">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form action="/send-email" method="post" class="contact-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" class="form-control" id="your-name" name="name" placeholder="Seu nome (obrigatório)" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="your-email" name="email" placeholder="Seu e-mail (obrigatório)" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="subject">Assunto:</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto (obrigatório)" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="message">Mensagem:</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Sua mensagem (obrigatório)" required></textarea>
                                </div>
                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </section>
    <!-- contact end -->

    <!-- Signup modal content -->
    <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <div class="auth-logo">
                            <div class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="../landing/images/logo-dark.png" alt="" height="34">
                                </span>
                            </div>
                        </div>
                    </div>

                    <h3 class="mb-3 text-center">Criar uma nova conta</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <jet-form-wrapper>
                            <jet-form-section submit="createUser">
                                <div>
                                    <x-label for="name" value="{{ __('Nome') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                            </jet-form-section>
                            <jet-form-section submit="createUser">
                                <div class="mt-2">
                                    <x-label for="email" value="{{ __('E-mail') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                </div>
                            </jet-form-section>
                            <jet-form-section submit="createUser">
                                <div class="mt-2">
                                    <x-label for="password" value="{{ __('Senha') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                            </jet-form-section>
                            <jet-form-section submit="createUser">
                                <div class="mt-2">
                                    <x-label for="password_confirmation" value="{{ __('Confirme a senha') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                            </jet-form-section>
                        </jet-form-wrapper>
            
                        <div class="flex items-center justify-end mt-4">
                            
                            <div class="mb-3 mt-4 d-grid text-center">
                                <x-button class="ml-4">
                                    {{ __('Criar conta') }}
                                </x-button>
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
