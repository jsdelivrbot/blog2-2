@extends('layouts.app')

@section('content')
    <pagina tamanho="12">
        <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
            {{-- #meuModalTeste está mais abaixo em <modal> --}}
            <modallink tipo="link" nome="meuModalTeste" titulo="Criar" css="">

            </modallink>
            <tabela-lista
                v-bind:titulos="['#', 'Título', 'Descrição']"
                v-bind:itens="[[1, 'OOP PHP', 'Curso de PHP'], [2, 'Vue JS', 'Curso de Vue JS']]"
                ordem="desc" ordemcol="1"
                criar="#criar" detalhe="#detalhe"  editar="#editar" deletar="#deletar" token="4567888412"
            ></tabela-lista>
        </painel>
    </pagina>
    <modal nome="meuModalTeste">
        {{-- para apresentar melhor a form q ficaria bugada: usa <painel> --}}
        <painel titulo="Adicionar">
            <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Check me out
                    </label>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </painel>
    </modal>
@endsection
