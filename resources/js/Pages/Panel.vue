<script setup>
    import { ref } from 'vue';
    import { AlignJustify, Plus } from 'lucide-vue-next';
    import Sidebar from './Sidebar.vue';
    import { router } from '@inertiajs/vue3';

    const sidebarToggle = ref(true);

    const toggle = () => {
        sidebarToggle.value = !sidebarToggle.value;
    }

    const routeToAddItem = () => {
        router.visit('/panel/add');
    }
</script>

<template>
    <div class="flex h-screen w-full bg-zinc-100">
 
        <div :class="sidebarToggle ? 'w-1/5' : 'w-20'" class="h-full transition-all duration-500">
            <Sidebar :sidebar-status="sidebarToggle" />
        </div>
        <div class="flex flex-col h-full w-1/2 flex-grow">
            <div class="flex items-center w-full h-14 border-b border-zinc-500">
                <button @click="toggle" class="h-full w-fit px-4">
                    <AlignJustify />
                </button>
            </div>
            <div class="flex w-full items-end justify-between h-1/6 p-4 border-b border-zinc-400 bg-zinc-100">
                <h1 class="text-4xl">Item List</h1>
                <button class="flex items-center justify-center h-10 w-32 gap-2 bg-blue-500 rounded-md border border-blue-300 text-zinc-100" @click="routeToAddItem">
                    <Plus />Add Item
                </button>
            </div>
            <div class="flex-grow h-2/6 w-full p-4 bg-zinc-50">
                <div class="flex items-center w-fit h-fit gap-2 ">
                    <label for="rowCount" class="text-lg">Shows:</label>
                    <select class="h-fit w-32 rounded-md border-zinc-400">
                        <option value="10">10 rows</option>
                        <option value="15">15 rows</option>
                        <option value="20">20 rows</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>