<template>
    <div :class="'col-sm-'+ (sm || '6') + ' col-md-' + (md || '4')">
        <div class="thumbnail">
            <img src="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg" alt="...">
            <div class="caption">
                <small>{{data | formataData}} - {{autor}}</small>
                <h3>{{descricao}}</h3>
                <p>Teste de Descrição</p>
                <p><a v-bind:href="link" class="btn btn-primary" role="button">Ler mais</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo', 'descricao', 'link', 'imagem', 'data', 'autor', 'sm', 'md'],
        filters: {
            formataData: function(valor){//valor  data a ser tratada
                if(!valor) return '';
                valor = valor.toString();
                if(valor.split('-').length == 3) {//3 elementos sepados por -: y-m-d
                    valor = valor.split('-');//virou um array
                    return valor[2] + '/' + valor[1] + '/' + valor[0];
                }
                return valor;
            }
        }
    }
</script>
