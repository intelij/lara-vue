<script setup>
import { onMounted } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

onMounted(async () => {
    await authStore.getUser();
});
</script>
<template>
    <div class="max-w-7xl mx-auto">
        <div v-if="authStore.user" style="padding: 75px;">
            <div style="padding-top: 60px;"></div>
            <section
                class="flex flex-wrap items-center -mx-3 font-sans px-4 mx-auto w-full lg:max-w-screen-lg sm:max-w-screen-sm md:max-w-screen-md pb-20">
                <!-- Column-1 -->
                <div class="px-3 w-full lg:w-2/5">
                    <div class="mx-auto mb-8 max-w-lg text-center lg:mx-0 lg:max-w-md lg:text-left">
                        <h2 class="mb-4 text-3xl font-bold text-left lg:text-5xl">
                            <span class="text-5xl text-blue-500 leading-relaxeds">Dashboard
                            </span>
                        </h2>

                        <strong>Resources used in the app</strong><br/>
                        https://pinia.vuejs.org/<br/>
                        https://vitejs.dev/<br/>
                            Easily manage and maintain your tasks in the best way possible with the todo tasks
                            application
                            <br/>
                            <br/>
                            <strong>You are signed in {{ authStore.user.name }}</strong>
                            <br/>
                            <br/>
                            <br/>
                            <button @click="authStore.handleLogout" class="block visible py-4 px-8 mb-4 text-xs font-semibold tracking-wide leading-none text-white bg-red-500 rounded cursor-pointer sm:mr-3 sm:mb-0 sm:inline-block">
                                Logout {{ authStore.user.name }}
                            </button>
                            <br/>
                            <div class="flex items-center space-x-5 hidden md:flex">
                
            </div>
                            
                    </div>

                    <div class="text-center lg:text-left">
                        <router-link :to="{ name: 'todolistv' }"
                            class="block visible py-4 px-8 mb-4 text-xs font-semibold tracking-wide leading-none text-white bg-blue-500 rounded cursor-pointer sm:mr-3 sm:mb-0 sm:inline-block">View {{ authStore.user.name }}'s
                            tasks</router-link>


                    </div>
                </div>

            </section>
        </div>
        <div v-else>
            <div style="padding-top: 60px;"></div>
            <section
                class="flex flex-wrap items-center -mx-3 font-sans px-4 mx-auto w-full lg:max-w-screen-lg sm:max-w-screen-sm md:max-w-screen-md pb-20">
                <p class="visible mx-0 mt-3 mb-0 text-sm leading-relaxed text-left text-slate-400">
                    <strong>Resources used in the app</strong><br/>
                        https://pinia.vuejs.org/<br/>
                        https://vitejs.dev/<br/>
                            Easily manage and maintain your tasks in the best way possible with the todo tasks
                            application
                            <br/>
                            <br/>
                            <strong>Register / Login to use the Application</strong>
                            <br/>
                            <br/>
                            <br/>
                            <br/>

                            <router-link :to="{ name: 'Login' }"
                            class="block visible py-4 px-8 mb-4 text-xs font-semibold tracking-wide leading-none text-white bg-blue-500 rounded cursor-pointer sm:mr-3 sm:mb-0 sm:inline-block">Login</router-link>

                        <router-link :to="{ name: 'Register' }"
                            class="block visible py-4 px-8 text-xs font-semibold leading-none bg-white rounded border border-solid cursor-pointer sm:inline-block border-slate-200 text-slate-500">SignUp</router-link>
                </p>
            </section>
        </div>
    </div>
</template>