@extends('layouts.app')

@section('content')
     <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
            <tabela-lista
                v-bind:titulos="['#', 'Título', 'Descrição']"
                v-bind:itens="[[1, 'OOP PHP', 'Curso de PHP'], [2, 'Vue JS', 'Curso de Vue JS']]"
                ordem="desc" ordemcol="1"
                criar="#criar" detalhe="#detalhe"  editar="#editar" deletar="#deletar" token="4567888412"
            ></tabela-lista>
        </painel>
     </pagina>
@endsection
