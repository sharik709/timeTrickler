<template>
    <div style="width:290px;height:312px" class="relative rounded shadow bg-grey-lightest mx-2 mt-5">
        <i class="cursor-pointer absolute pin-r mr-4 mt-3 text-white fas fa-ellipsis-v"></i>
        <div class="h-24 bg-blue rounded-tl rounded-tr">
            <div class="flex pt-12 items-center">
                <div>
                    <div style="" class="h-24 w-24 ml-8 border border-6 border-white rounded-full">
                        <img
                            src="https://cloud.netlifyusercontent.com/assets/344dbf88-fdf9-42bb-adb4-46f01eedd629/242ce817-97a3-48fe-9acd-b1bf97930b01/09-posterization-opt.jpg"
                            class="h-24 w-24 rounded-full border-2"
                            alt="">
                    </div>
                </div>
                <div class="ml-2">
                    <h2 class="-mt-4 text-grey-lighter">JOHN DOE</h2>
                    <p class="m-0 mt-4 block text-sm text-grey-dark">Lives in Ikrain</p>
                </div>
            </div>
        </div>
        <div class="mt-16 flex flex-wrap px-6">
            <UserProjectCardDataCard
                    v-for="(counter, index) in counterData"
                    :key="index"
                    :data-counter="counter.dataCounter"
                    :data-counter-by="counter.dataCounterBy"
                    :icon="counter.icon"
                ></UserProjectCardDataCard>
        </div>
    </div>
</template>

<script>
    import UserProjectCardDataCard from './UserProjectCardDataCard'
    export default {
        name: "UserProjectCard",
        component: [UserProjectCardDataCard],
        props: {
            counterData: []
        }
    }
</script>

<style scoped>

</style>