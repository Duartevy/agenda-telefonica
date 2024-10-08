<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

        <title>Agenda telefônica</title>

        <!-- Estilo customizado para cor azul e fundo -->
        <style>
            body {
                background-image: url('/imagens/lista-telefonica.jpg'); /* Defina o caminho correto para a imagem */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                font-family: 'Lato', sans-serif;
                color: #FFFFFF;
                text-shadow: 1px 1px 2px #000000;
            }
            .navbar, .nav-link {
                color: #FFFFFF !important;
                text-shadow: 1px 1px 2px #000000;
            }
            .btn-primary, .btn-dark, .btn-logout, .nav-link {
                background-color: #03178C !important;
                border-color: #03178C !important;
                color: #FFFFFF !important; /* Fonte branca */
                font-weight: 700;
            }
            .btn-danger {
                color: #FFFFFF !important; /* Mantém a fonte branca */
                font-weight: 700;
            }
            table th, table td {
                color: #FFFFFF !important;
                font-size: 1.1em;
                text-shadow: 1px 1px 2px #000000;
                text-align: center; /* Centraliza os textos nas células da tabela */
            }
            .table-hover tbody tr:hover {
                background-color: rgba(3, 23, 140, 0.2); /* Efeito de hover transparente */
            }
            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>

    <body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Lista</a>
                </li>
            </ul>
            <div class="ml-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-logout text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </nav>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>            
        @endif

        <!-- Conteúdo HTML existente -->
        <div class="container">
            <div id="app" class="text-right">
                <!-- Botão para abrir o modal -->
                <button @click="openModal" class="btn btn-dark mt-2">Novo Contato</button>
                <create-contact-modal ref="createContactModal"></create-contact-modal>
            </div>
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agendas as $agenda)
                        <tr>
                            <td>{{ $agenda->nome }}</td>
                            <td>{{ $agenda->telefone }}</td>
                            <td>{{ $agenda->email }}</td>
                            <td><img src="imagens/{{ $agenda->imagem }}" class="rounded-circle" width="50" height="50"/></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <a href="{{ route('edit', $agenda->id) }}" class="btn btn-primary flex-grow-1 mr-1">Editar</a>
                                    </div>

                                    <div>
                                        <form method="POST" class="d-inline flex-grow-1" action="{{ route('destroy', $agenda->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">Deletar</button> 
                                        </form>    
                                    </div>                        
                                </div>                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Adicione o script Vue.js aqui -->
        <script src="{{ mix('js/app.js') }}"></script>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </body>
</html>
