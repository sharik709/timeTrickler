<template>
    <div style="width:290px;height:312px" class="relative rounded shadow bg-grey-lightest mx-2 mt-5">
        <button
            type="button"
            @click="toggleMenu"
            class="focus:outline-none cursor-pointer absolute pin-r mr-4 mt-3 text-white p-2 rounded-full"
        >
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div class="h-24 bg-blue rounded-tl rounded-tr">
            <div class="flex pt-12 items-center">
                <div>
                    <div style="" class="h-24 w-24 ml-8 border border-6 border-white rounded-full">
                        <img
                            :src="user.avatar"
                            class="h-24 w-24 rounded-full border-2"
                            alt="">
                    </div>
                </div>
                <div class="ml-2">
                    <div class="">
                        <h3 class="text-grey-lighter" v-text="user.name"></h3>
                    </div>
                    <p class="m-0 mt-6 block text-sm text-grey-dark">
                        Member since <br /> {{ user.created_at | formatDate }}
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-16 flex flex-wrap px-6">
            <UserProjectCardDataCard
                    v-for="(counter, index) in user.counterData"
                    :key="index"
                    :data-counter="counter.dataCounter"
                    :data-counter-by="counter.dataCounterBy"
                    :icon="counter.icon"
                ></UserProjectCardDataCard>
        </div>
        <div v-if="menu" class="bg-grey-lightest absolute pin-x pin-y p-5">
            <div class="flex justify-end">
                <button type="button" @click="toggleMenu" class="btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <ul class="mt-10 ml-5 list-reset">
                <li>
                    <a href="#" class="block font-semibold text-blue">Remove From This Project</a>
                </li>
                <li>
                    <a href="#" class="block font-semibold text-blue mt-2">Remove From Everywhere</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import UserProjectCardDataCard from './UserProjectCardDataCard'
    export default {
        name: "UserProjectCard",
        components: {UserProjectCardDataCard},
        props: {
            user: {
                default: () => {
                    return {}
                }
            },
        },
        data() {
            return {
                menu: false
            }
        },
        methods: {
            toggleMenu() {
                this.menu = !this.menu
            }
        }
    }
</script>

<style scoped>

</style>