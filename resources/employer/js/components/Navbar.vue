<template>
    <div class="bg-grey-light h-12 w-full">
        <div class="container mx-auto">
            <nav class="flex justify-between items-center">
                <div class="flex items-center">
                   <div class="flex items-center">
                        <h3>TimeTrickler</h3>
                   </div>
                    <ul class="list-reset flex flex-wrap ml-8">
                        <li v-for="(link, index) in links" :key="index">
                            <a
                                class="hover:bg-grey-lightest block px-4 py-4 text-grey-darker text-sm font-semibold bg-gray no-underline w-32 flex justify-center items-center" :href="link.href" :class="{'bg-grey-lightest' : link.active}" v-text="link.text"></a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div>
                        <div class="w-12 bg-gray-dark rounded-full">
                            
                        </div>
                        <h3>Sharik Shaikh</h3>
                    </div>
                </div>
                   
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'NavbarComponent',
        props: ['path'],
        mounted(){
            this.links.forEach(link => {
                if(link.href.includes(this.path)) {
                    link.active = true
                }
            })
        },
        data() {
            return {
                links: [
                    {
                        text: 'Dashboard',
                        href: '/employer/dashboard',
                        active: false
                    },
                    {
                        text: 'Projects',
                        href: '/employer/project',
                        active: false
                    },
                    {
                        text: 'Teams',
                        href: '/employer/team',
                        active: false
                    },
                    {
                        text: 'Settings',
                        href: '/employer/setting',
                        active: false
                    }
                ]
            }
        }
    }
</script>
