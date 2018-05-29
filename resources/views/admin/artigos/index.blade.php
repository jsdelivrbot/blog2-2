@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        @if($errors-> all())
            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                @foreach($errors-> all() as $key => $value)
                <li><strong>{{ $value }}</strong></li>
                @endforeach
            </div>
        @endif
        <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
            {{-- #meuModalTeste está mais abaixo em <modal> --}}

            <tabela-lista
                v-bind:titulos="['#', 'Título', 'Descrição','data']"
                {{-- precisa ser em json abaixo; vem vindo de controller index--}}
                v-bind:itens="{{json_encode($listaArtigos)}}"
                ordem="desc" ordemcol="1"
                criar="#criar" detalhe="/admin/artigos/"  editar="/admin/artigos/" deletar="/admin/artigos/" token="{{csrf_token()}}"
                modal="sim"
            ></tabela-lista>
            <div align="center">
                {{$listaArtigos->links()}}
            </div>
        </painel>
    </pagina>
    <modal nome="adicionar" titulo="Adicionar">
        {{-- para apresentar melhor a form q ficaria bugada: usa <painel> --}}
        <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{csrf_token()}}">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="{{ old('titulo') }}">
                </div>
                <div class="form-group">
                    <label for="">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricão" value="{{ old('descricao') }}">
                </div>
                <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea class="form-control" name="conteudo" id="conteudo">{{ old('conteudo') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="datetime-local" class="form-control" id="data" name="data" value="{{ old('data') }}">
                </div>
            </formulario>
            {{-- vai em <slot name="botoes"></slot> de Modal.vue--}}
            <span slot="botoes">
                {{-- html5 reconhece o button abaixo como submit e form relacionado ao id da form--}}
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
            </span>

    </modal>
    <modal nome="editar" titulo="Editar">
        {{-- não pode usar mesmo metodo de adicionar com {{}} pq teria php com js! então vai com link manueal; v-bind: ou simplesmente : torna dinâmico e apto p js, faz string com '' e concatena com + td js--}}
        <formulario id="formEditar" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descricão">
                </div>
                <div class="form-group">
                    <label for="conteudo">Conteúdo</label>
                    <textarea class="form-control" name="conteudo" id="conteudo" v-model="$store.state.item.conteudo"></textarea>
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="datetime-local" class="form-control" id="data" name="data"  v-model="$store.state.item.data">
                </div>
                {{-- html5 reconhece o button abaixo como submit --}}
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-info">Atualizar</button>
        </span>
    </modal>
    <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
       {{-- colocou @ p avisar q é javascript; não confundir com vue --}}
            <p>@{{$store.state.item.descricao}}</p>
            <p>@{{$store.state.item.conteudo}}</p>
    </modal>
@endsection
