<template>
    <div class="bg-grey-lightest">
        <div class="container mx-auto">
            <ul class="list-reset flex -mx-3">
                <li v-for="(link, index) in links" :key="index">
                    <a
                        :href="link.href"
                         class="block hover:bg-grey-dark hover:text-grey-lightest py-5 px-4 text-grey-darker no-underline"
                        :class="{'bg-grey-dark text-grey-light' : link.active}"
                    >
                        {{ link.text }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProjectSubMenu",
        props: ['project', 'page'],
        mounted() {
            this.setupLinks();
        },
        data() {
            return {
                links: []
            }
        },
        methods: {
            setupLinks() {
                this.links = [
                    {
                        href: '/employer/project/'+this.project.uuid,
                        text: 'Overview',
                        active: false
                    },
                    {
                        href: '/employer/project/'+this.project.uuid+'/user',
                        text: 'Users',
                        active: false
                    },
                    {
                        href: '/employer/project/'+this.project.uuid+'/work-diary',
                        text: 'Work Diary',
                        active: false
                    },
                    {
                        href: '/employer/project/'+this.project.uuid+'/task',
                        text: 'Task',
                        active: false
                    },
                    {
                        href: '/employer/project/'+this.project.uuid+'/project-setting',
                        text: 'Project Settings',
                        active: false
                    }
                ]
                this.links.forEach(link => {
                    if( link.text.toLowerCase() == this.page.toLowerCase() ) {
                        link.active = true;
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>