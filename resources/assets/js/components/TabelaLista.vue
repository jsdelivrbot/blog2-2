<template>
    <div>
        <!-- classes bootstrap 3 para deixar campos na mesma linha e jogar um para a direita -->
        <div class="form-inline">
            <!-- <p>{{this.$store.state.itens}}</p> -->
            <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
            <modallink v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modallink>
            <div class="form-group pull-right">
                <!-- search é do html5; v-model define uma variável q após preechida a form será atribuido um valor -->
                <input type="search" class="form-control" placeholder="Buscar" v-model="buscar">
            </div>
        </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos">{{titulo}}</th>

                        <th v-if="detalhe || editar || deletar">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- substituiu itens por lista q é função definida nas props -->
                    <tr v-for="(item, index) in lista">
                        <!-- são dois loops pq é um array de um array na index: [[ , ]]-->
                        <td v-for="i in item">{{i}}</td>
                        <td v-if="detalhe || editar || deletar">
                            <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" v-bind:value="token">

                                <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe|" css=""></modallink>

                                <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                                <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo=" Editar|" css=""></modallink>
                                <a href="#" v-on:click="executaForm(index)"> Deletar</a>
                            </form>
                            <span v-if="!token">
                                <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe|" css=""></modallink>

                                <a v-if="editar && !modal" v-bind:href="editar"> Editar |</a>
                                <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo=" Editar|" css=""></modallink>
                                <a v-if="deletar" v-bind:href="deletar"> Deletar</a>
                            </span>
                             <span v-if="token && !deletar">
                                <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                <modallink v-if="detalhe && modal" v-bind:item="item"  v-bind:url="detalhe" tipo="link"  nome="detalhe" titulo=" Detalhe|" css=""></modallink>

                                <a v-if="editar && !modal" v-bind:href="editar"> Editar</a>
                                <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo=" Editar|" css=""></modallink>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</template>

<script>
    export default {
        props: ['titulos', 'itens', 'ordem', 'odercol', 'criar', 'detalhe', 'editar', 'deletar', 'token', 'modal'],
        data: function() {
            return {
                buscar: '',
                ordemAux: this.ordem || 'asc',
                ordemAuxCol: this.ordemcol || 0
            }
        },   //para definir uma variável (search) dentro de um componente
        methods: {//usar methods ao invés de computed sempre q tiver um botão submit p clicar
            executaForm: function(index) {
                document.getElementById(index).submit();
            },
            ordenaColuna: function (coluna) {
                this.ordemAuxCol = coluna;
                if(this.ordemAux.toLowerCase() == "asc") {
                    this.ordemAux = 'desc';
                } else {
                    this.ordemAux = 'asc';
                }
            }
        },
        computed: {//aconselhável p carregar no boot da página
            lista: function () {
                //commit define o método q vai utlizar dado em app.js vuex; opa: objeto
                //this.$store.commit('setItens', {opa:"OK"})//modificando o obj da 'loja' vuex
                let lista = this.itens.data;
                let ordem = this.ordemAux;//decrescente
                let ordemCol = this.ordemAuxCol;
                ordem = ordem.toLowerCase();
                ordemCol = parseInt(ordemCol);//transf string em inteiro
                if (ordem == 'asc') {//crescente
                    lista.sort(function(a,b) {
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return 1;}
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return -1;}
                        return 0;
                    });
                } else {
                    lista.sort(function(a,b) {//função js p ordenação
                    //a=b retorna 0, a>b retorna >0, a<b retorna <0
                        if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]) {return 1;}//primeira coluna na tabela, id
                        if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]) {return -1;}
                        return 0; //case a = b
                    });
                }
                if(this.buscar) {
                    return lista.filter(res => {//javascript função filter para buscar (search)
                        res = Object.values(res);
                        for(let k = 0; k < res.length; k++) {//enquanto k < tamanho de res
                            if ((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >=0) {
                            return true;//(res[k] + "") transforma tudo em string pq há inteiros em id
                            }
                        }
                                        //if (res[1].toLowerCase().indexOf(this.buscar.toLowerCase()) >=0) {
                                            //js - verifica a posição 1 (titulo) dos items, passa p minuscula e compara com variável
                                            //busca; caso < 0 não encontrou nada; positivou ounulo encontrou algo
                                        //    return true;
                                        //} else {
                            return false;
                                        //}
                    });
                }
                return lista;
            }
        }
    }
</script>
