<script setup>
    import axios from 'axios';   
    import { Eye, EyeClosed, Terminal, TerminalSquare } from 'lucide-vue-next';
    import { ref } from 'vue';
    import { router } from '@inertiajs/vue3';

    const message = ref("");
    const emailValue = ref(null);
    const passwordValue = ref(null);
    const passwordVisibility = ref(false);


    const fetchMessage = async () => {
        try {
            const response = await axios.get("http://localhost:8000/api/user");
            message.value = response.data
            console.log(response.data);
        } catch (error) {
            console.log(error);
        }
    }

    const authUser = async () => {
        try {
            const response = await axios.post('http://localhost:8000/api/auth/login', {
                email: emailValue.value.value,
                password: passwordValue.value.value,
            }, {
                withCredentials: true
            });

            console.log('Logged in:', response.data);
            router.visit('/panel');
        } catch (error) {
            console.error('Authentication failed:', error);
        }
    };

    const togglePassword = () => {
        passwordVisibility.value = !passwordVisibility.value;
        console.log(passwordValue.value.value + " | " + emailValue.value.value);
    }

</script>

<template>
    <div class="flex items-center justify-center h-screen w-full bg-zinc-200">
        <form method="post" class="flex flex-col w-3/12 h-4/6 p-8 gap-4 bg-zinc-100 border border-zinc-300 rounded-xl shadow-xl" @submit.prevent="authUser">
            <div class="flex justify-center items-center w-full h-24">
                <!-- <img src="#" alt="logo" class="bg-zinc-900 w-24 h-24"> -->
                 <TerminalSquare size="75" />
            </div>
            <div class="flex flex-col items-center w-full h-fit gap-2 font-semibold">
                <h2 class="text-3xl">Login to your account</h2>
                <p class="text-lg text-zinc-600">Welcome Back!</p>
            </div>
            <div class="flex flex-col w-full h-fit gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" ref="emailValue"
                    class=" w-full h-10 px-2 rounded-md bg-zinc-200 border border-zinc-400">
            </div>
            <div class="flex flex-col w-full h-fit gap-2">
                <label for="password">Password</label>
                <div class="flex relative">
                    <input :type="passwordVisibility? 'text' : 'password'" name="password" id="password" 
                        class=" w-full h-10 px-2 rounded-md bg-zinc-200 border border-zinc-400" autocomplete="off" auto ref="passwordValue">
                    <button type="button" class="absolute right-0 size-10" @click="togglePassword">
                        <span v-if="passwordVisibility"><EyeClosed /></span>
                        <span v-else ><Eye /></span>
                    </button>
                </div>
            </div>
            <button type="submit" class="w-full h-10 bg-blue-500 rounded-lg text-zinc-100">Sign In</button>
        </form>
    </div>
</template>
