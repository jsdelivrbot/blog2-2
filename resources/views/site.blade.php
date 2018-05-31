@extends('layouts.app')

@section('content')
     <pagina tamanho="12">
        <painel titulo="Artigos">
            <div class="row">
                <artigocard
                    titulo='Título teste'
                    descricao='Descrição teste'
                    link='#'
                    imagem='https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg'
                    data='10/11/2017'
                    autor='autor'
                    sm='6'
                    md='4'>
                </artigocard>
            </div>
        </painel>
     </pagina>
@endsection
