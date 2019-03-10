<template>
    <div class="container mx-auto">
        <div class="mt-10 bg-grey-lightest rounded shadow">
            <div class="w-full mx-auto">
              <div class="bg-white shadow-md rounded my-6">
                <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                  <thead>
                    <tr>
                      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Title</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Users</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Status</th>
                      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="hover:bg-grey-lighter" v-for="(project, index) in projects" :key="index">
                      <td class="py-4 px-6 border-b border-grey-light">{{ project.title }}</td>
                      <td class="py-4 px-6 border-b border-grey-light">
                        <div class="flex">
                            <div class="w-6 h-6 -ml-2 rounded-full border-2 border-gray-light" v-for="(user, index) in project.users" :key="index">
                                <img :src="user.avatar" :alt="user.name"/>
                            </div>
                            <div class="w-6 h-6 -ml-2 rounded-full bg-white border-2 border-gray-light">
                                <BaseIcon icon="add-outline" />
                            </div>
                        </div>
                      </td>
                        <td class="py-4 px-6 border-b border-grey-light">
                            <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Active</a>
                        </td>
                      <td class="py-4 px-6 border-b border-grey-light flex">
                            <a class="w-6 h-6 rounded-full hover:bg-grey-light hover:text-white flex justify-center items-center">
                                <BaseIcon icon="view-show" class="w-4" />
                            </a>

                            <a class="w-6 h-6 rounded-full hover:bg-grey-light hover:text-white flex justify-center items-center">
                                <BaseIcon icon="compose" class="w-4" />
                            </a>

                            <a class="w-6 h-6 rounded-full hover:bg-grey-light hover:text-white flex justify-center items-center">
                                <BaseIcon icon="trash" class="w-4" />
                            </a>
                     </td>
                    </tr>
                    <tr class="hover:bg-grey-lighter">
                      <td class="py-4 px-6 border-b border-grey-light">Paris</td>
                      <td class="py-4 px-6 border-b border-grey-light">
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">View</a>
                      </td>
                    </tr>
                    <tr class="hover:bg-grey-lighter">
                      <td class="py-4 px-6 border-b border-grey-light">London</td>
                      <td class="py-4 px-6 border-b border-grey-light">
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">View</a>
                      </td>
                    </tr>
                    <tr class="hover:bg-grey-lighter">
                      <td class="py-4 px-6 border-b border-grey-light">Oslo</td>
                      <td class="py-4 px-6 border-b border-grey-light">
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">View</a>
                      </td>
                    </tr>
                    <tr class="hover:bg-grey-lighter">
                      <td class="py-4 px-6 border-b border-grey-light">Mexico City</td>
                      <td class="py-4 px-6 border-b border-grey-light">
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>
                        <a href="#" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark">View</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


        </div>
    </div>
</template>
<script>
    export default {
        name: 'ProjectView',
        props: ['projectData'],
        data() {
            return {
                projects: this.projectData.data,
                meta: this.projectData.meta
            }
        }
    }
</script>
