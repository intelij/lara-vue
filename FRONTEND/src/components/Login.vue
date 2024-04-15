<script setup>
import { ref } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

const form = ref({
    email: "",
    password: "",
});
</script>
<template>
    <div class="text-center mt-24">
        <h4 class="text-4xl tracking-tight">
            Sign in
        </h4>
        <span class="text-sm">or <router-link :to="{ name: 'Register' }" class="text-blue-500">
                 New User Registration
            </router-link>
        </span>
    </div>
    <div class="flex justify-center my-2 mx-4 md:mx-0">
        <form @submit.prevent="authStore.handleLogin(form)" class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for='Password'>Email address</label>
                    <input v-model="form.email"
                        class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"
                        type='email' placeholder="example@test.com" required>
                    <div v-if="authStore.errors.email" class="flex">
                        <span class="text-red-400 text-sm m-2 p-2">{{
            authStore.errors.email[0]
        }}</span>
                    </div>
                </div>
                <div class="w-full md:w-full px-3 mb-6">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for='Password'>Password</label>
                    <input v-model="form.password"
                        class="appearance-none block w-full bg-white text-gray-900 font-medium border border-gray-400 rounded-lg py-3 px-3 leading-tight focus:outline-none"
                        type='password' placeholder="********" required>

                    <div v-if="authStore.errors.password" class="flex">
                        <span class="text-red-400 text-sm m-2 p-2">{{
            authStore.errors.password[0]
                            }}</span>
                    </div>
                    <div class="w-full flex items-center justify-between px-3 mb-3 ">
                        <label for="remember" class="flex items-center w-1/2">
                            <input type="checkbox" name="" id="" class="mr-1 bg-white shadow">
                            <span class="text-sm text-gray-700 pt-1">Remember Me</span>
                        </label>
                        <div class="w-1/2 text-right">
                            <router-link to="/forgot-password" class="text-blue-500 text-sm tracking-tight">Forgot your
                                password?</router-link>
                        </div>
                    </div>
                    <div class="w-full md:w-full px-3 mb-6">
                        <button
                            class="appearance-none block w-full bg-blue-600 text-gray-100 font-bold border border-gray-200 rounded-lg py-3 px-3 leading-tight hover:bg-blue-500 focus:outline-none focus:bg-white focus:border-gray-500">Sign
                            in</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>