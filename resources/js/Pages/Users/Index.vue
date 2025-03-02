<script setup>

import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    users: Object,
});

const searchText = ref("");

const searchUser = () => {
    console.log(searchText.value)
    router.get(route('users.index'), {'search': searchText.value})
};

const form = useForm({});
const deleteUserData = (id) => {

    if (confirm("Are you sure to delete this record?")) {
        form.delete(route('users.destroy', id), {
            onSuccess: (response) => {
                console.log(response);
            }
        });
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between pt-2">
                <div class="self-center">
                    <button class="rounded bg-blue-500 border p-2 text-white" @click="router.get('/users/create')">Create User</button>
                </div>

                <div class="shadow-md p-4">
                    <input type="text" v-model="searchText" class="bborder p-2 rounded ml-2">
                    <button class="text-white border p-2 bg-slate-500" @click="searchUser()">Search</button>
                    </div>
           </div>


            <div class="flex p-6 bg-white shadow-md mt-6">

                <table class="border w-full text-center">
                    <thead>
                        <tr class="border bg-gray-500">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>
                    <tr class="border items-center" v-if="users" v-for="user in users.data">
                        <td class="border">{{  user.id }}</td>
                        <td class="border">{{  user.name }}</td>
                        <td class="border">{{  user.email }}</td>
                        <td class="border text-center space-x-2">
                            <button class="p-2 rounded border" @click="router.get(`/users/${user.id}/edit`)">Edit</button>
                            <button class="p-2 bg-red-500 rounded border text-white" @click="deleteUserData(user.id)">Delete</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="flex justify-between py-6">
                <button class="bg-blue-500 p-2 text-white rounded border" v-if="users.links.prev" @click="router.get(users.links.prev)">Previous</button>


                <button class="bg-blue-500 p-2 text-white rounded border"  v-if="users.links.next" @click="router.get(users.links.next)">Next </button>
            </div>
            <div class="flex justify-center">
                <span>Page {{ users.meta.current_page }} of {{ users.meta.last_page }}</span>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
