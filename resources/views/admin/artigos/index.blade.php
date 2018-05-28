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
    <modal nome="adicionar">
        {{-- para apresentar melhor a form q ficaria bugada: usa <painel> --}}
        <painel titulo="Adicionar">
            <formulario css="" action="#" method="put" enctype="multipart/form-data" token="123456">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descricão">
                </div>
                {{-- html5 reconhece o button abaixo como submit --}}
                <button class="btn btn-info">Adicionar</button>
            </formulario>
        </painel>
    </modal>
    <modal nome="editar">
        {{-- para apresentar melhor a form q ficaria bugada: usa <painel> --}}
        <painel titulo="Editar">
            <formulario css="" action="#" method="put" enctype="multipart/form-data" token="123456">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo" placeholder="Titulo">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descricão">
                </div>
                {{-- html5 reconhece o button abaixo como submit --}}
                <button class="btn btn-info">Atualizar</button>
            </formulario>
        </painel>
    </modal>
    <modal nome="detalhe">
        <painel v-bind:titulo="$store.state.item.titulo">
            {{-- colocou @ p avisar q é javascript; não confundir com vue --}}
            <p>@{{$store.state.item.descricao}}</p>
        </painel>
    </modal>
@endsection
