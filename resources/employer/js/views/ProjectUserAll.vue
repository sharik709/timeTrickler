<template>
    <div >
        <div>
            <project-sub-menu :project="project" page="users" ></project-sub-menu>
        </div>
        <div class="container mx-auto">
            <div class="flex justify-between mt-4">
                <button type="button" class="btn btn-outline-primary">
                    Go Back
                </button>
                <h3 class="text-grey-darker capitalize">
                    <a :href="'/employer/project/'+project.uuid">
                        Project: {{ project.title }}
                    </a>
                </h3>
            </div>
            <hr />
            <div class="flex mt-10 -mx-2 flex-wrap justify-center" >
                <UserProjectCard
                    v-for="(loop, index) in [{}, {}, {}, {}, {}, {}]"
                    :key="index"
                    :counterData="[
                        {
                            dataCounter : 10,
                            dataCounterBy: 'Hrs/Day',
                            icon: 'chart-line'
                        },
                        {
                            dataCounter : 14,
                            dataCounterBy: 'Days/Month',
                            icon: 'calendar'
                        },
                        {
                            dataCounter : '$250',
                            dataCounterBy: '/Month',
                            icon: 'wallet'
                        },
                        {
                            dataCounter : 10,
                            dataCounterBy: 'Awards',
                            icon: 'trophy'
                        }

                    ]"
                ></UserProjectCard>
            </div>
        </div>
    </div>
</template>

<script>
    import UserProjectCard from '../components/UserProjectCard'
    export default {
        name: "ProjectUserAll",
        props: ['project', 'users'],
        components: [UserProjectCard]
    }
</script>

<style scoped>

</style>