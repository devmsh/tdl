<template>
    <div>
        <input v-model.number="number1"/> +
        <input v-model.number="number2"/>
        =
        <input v-model.number="result"/>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                number1: 0,
                number2: 0,
            }
        },
        computed:{
            result: function (){
                return this.number1 + this.number2;
            }
        }
    }
</script>