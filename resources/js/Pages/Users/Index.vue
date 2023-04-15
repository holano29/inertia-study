<template>

    <Head>
      <title>Users</title>
      <meta type="description"
        content="Information about the Users Page of My App"
        head-key="description"/>
    </Head>

    <div class="flex justify-between mb-6">

        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-green-600">Users</h1>
            <Link href="/users/create" v-if="can.createUser" class="text-blue-500 text-sm ml-5">New User</Link>
        </div>
        

        <input v-model="search" type="text" placeholder="Search" class="border px-2 rounded-lg">
    </div>


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="shadow overlfow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- retieve data -->
                    
                        <tr v-for="user in users.data" :key="user.id">

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sim font-medium text-gray-900">
                                              {{ user.name }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td v-if="user.can.edit" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Paginator -->

<!-- Passing data -->
<Pagination :links="users.links" />

</template>
    
<script setup>
import Pagination from '../../Shared/Pagination.vue';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import debounce from 'lodash/debounce';

let props = defineProps( {
    users: Object,
    filters: Object,
    can: Object
});

let search = ref(props.filters.search);

watch(search, debounce( function (value) {
    Inertia.get('/users', { search: value }, {
        preserveState: true,
        replace: true
    });
}, 100));

</script>


<!-- <script>
// Optons API
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '../Shared/Pagination.vue'

export default{
    props: {
        users: Object,
    },

    // ref() is equal to data() in options api

    // props: {
    //     time: String,
    // },
    components: {
        Link,
        Pagination,
     },

    // equivalent of ref() in Composition API
     data(){
        return {
            search: '',
        }
     },

     watch: {
        search(new_val, old_val){
            //console.log(new_val)
            this.$inertia.get('/users', { search: new_val }, { preserveState: true})
        }
     }

};
</script> -->
    