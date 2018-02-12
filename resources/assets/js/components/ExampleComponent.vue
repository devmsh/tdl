<template>
    <div>
        {{count}}
        <button class="increment" @click="increment">Increment</button>
        <button class="decrement" @click="decrement">Decrement</button>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                count: 0,
            }
        },
        computed: {
            test: function(){
                return this.count + 1
            }
        },
        methods: {
            increment () {
                this.count++
            },
            decrement () {
                this.count--
            }
        }
    }
</script>