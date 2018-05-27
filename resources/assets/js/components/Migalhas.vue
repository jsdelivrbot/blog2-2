<template>
    <!-- não pode ter mais q um elemento aqui dentro! -->
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li><a href="#">Library</a></li>
      <li class="active">Data</li>
    </ol>
</template>

<script>
    export default {
        props: ['lista'],
        mounted: function () {
            console.log(this.lista);
        }
    }
</script>
