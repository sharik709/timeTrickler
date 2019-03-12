<template>
    <div class="flex w-1/2 mt-5">
        <div class="flex justify-center items-center bg-blue-dark text-white rounded-full p-3">
            <i :class="'fas fa-'+icon"></i>
        </div>

        <div class="text-right ml-2">
            <h4 class="text-grey-darker" v-text="dataCounter"></h4>
            <p class="text-sm text-grey-dark" v-text="dataCounterBy"></p>
        </div>

    </div>
</template>

<script>
    export default {
        name: "UserProjectCardDataChart",
        props: {
            dataCounter: '',
            dataCounterBy: '',
            icon: ''
        }
    }
</script>

<style scoped>

</style>