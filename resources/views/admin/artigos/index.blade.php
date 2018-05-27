@extends('layouts.app')

@section('content')
     <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <tabela-lista
                v-bind:titulos="['#', 'Título', 'Descrição']"
                v-bind:itens="[[1, 'OOP PHP', 'Curso de PHP'], [2, 'Vue JS', 'Curso de Vue JS']]"
            ></tabela-lista>
        </painel>
     </pagina>
@endsection
