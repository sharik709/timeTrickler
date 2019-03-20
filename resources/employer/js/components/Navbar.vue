<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a 
                v-for="(link, index) in links" 
                :key="index"
                class="nav-item nav-link active" 
                :href="link.href"
                v-text="link.text"
                ></a>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'NavbarComponent',
        props: ['path'],
        mounted(){
            this.links.forEach(link => {
                if(this.path.includes(link.pattern)) {
                    link.active = true
                }
            })
        },
        data() {
            return {
                links: [
                    {
                        text: 'Dashboard',
                        pattern: '/employer/dashboard',
                        href: '/employer/dashboard',
                        active: false
                    },
                    {
                        text: 'Projects',
                        pattern: '/employer/project',
                        href: '/employer/project',
                        active: false
                    },
                    {
                        text: 'Teams',
                        pattern: '/employer/team',
                        href: '/employer/team',
                        active: false
                    },
                    {
                        text: 'Settings',
                        pattern: '/employer/setting',
                        href: '/employer/setting',
                        active: false
                    }
                ]
            }
        }
    }
</script>
<style lang="scss" scoped>
    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .nav-links {
        display: flex;
        list-style: none;
        a {
            display: block;
            padding: 10px 5px;
            background-color: lightgrey;
        }
    }
</style>
