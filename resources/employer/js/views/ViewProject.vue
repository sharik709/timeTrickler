<template>
    <div>
        <ProjectSubMenu
            :project="project"
            page="Overview"
        ></ProjectSubMenu>
        <div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "ViewProject",
        props: ['project']
    }
</script>

<style scoped>

</style>