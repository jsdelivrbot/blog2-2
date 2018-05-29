@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
            {{-- #meuModalTeste está mais abaixo em <modal> --}}

            <tabela-lista
                v-bind:titulos="['#', 'Título', 'Descrição']"
                v-bind:itens="{{$listaArtigos}}"
                ordem="desc" ordemcol="1"
                criar="#criar" detalhe="#detalhe"  editar="#editar" deletar="#deletar" token="4567888412"
                modal="sim"
            ></tabela-lista>
        </painel>
    </pagina>
    <modal nome="adicionar" titulo="Adicionar">
        {{-- para apresentar melhor a form q ficaria bugada: usa <painel> --}}
        <formulario id="formAdicionar" css="" action="#" method="put" enctype="multipart/form-data" token="123456">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricão">
                </div>
            </formulario>
            {{-- vai em <slot name="botoes"></slot> de Modal.vue--}}
            <span slot="botoes">
                {{-- html5 reconhece o button abaixo como submit e form relacionado ao id da form--}}
            <button form="formAdicionar" class="btn btn-info">Adicionar</button>
            </span>

    </modal>
    <modal nome="editar" titulo="Editar">
        <formulario id="formEditar" css="" action="#" method="put" enctype="multipart/form-data" token="123456">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descricão">
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
    </modal>
@endsection
