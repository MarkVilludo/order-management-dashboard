<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm} from '@inertiajs/vue3';


const form = useForm({
    'name': '',
    'email': '',
    'password': ''
});

const submit = () => {
    form.post(route('users.store'));
};


</script>



<template>
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create User
            </h2>
        </template>

        <div class="max-w-6xl mx-auto p-6">
            <form @submit.prevent="submit">
                <div class="m-4">
                    <label class="block">Name</label>
                    <input type="text" v-model="form.name" class="border p-2 w-full">
                </div>
                <div class="m-4">
                    <label class="block">Email</label>
                    <input type="email" v-model="form.email" class="border p-2 w-full">
                </div>

                <div class="m-4">
                    <label class="block">Pass</label>
                    <input type="password" v-model="form.password" class="border p-2 w-full">
                </div>

                <div class="m-4 pt-6">
                    <button type="submit" class="boder p-2 bg-blue-500 rounded text-white">Submit</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>

</template>
