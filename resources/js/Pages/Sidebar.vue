<script setup>
    import { ChevronRight, Shapes, SquareTerminal } from 'lucide-vue-next';

    const props = defineProps({
        sidebarStatus: Boolean
    })
    const sidebarLinks = [
        { text: "Item", url: "#" },
        { text: "Item", url: "#" },
        { text: "Item", url: "#" },
    ]
</script>

<template>
    <div class="flex flex-col w-full h-full px-4 gap-4 bg-zinc-50 border-r-2 border-zinc-300">
        <div class="flex w-full items-center justify-center h-24 gap-2">
            <SquareTerminal size="50" />
            <h1 :class="props.sidebarStatus ? 'block' : 'hidden'" class=" transition-all duration-500 text-2xl font-semibold">Admin Panel</h1>
        </div>
        <div class="w-full h-fit">
            <ul v-for="(e,i) in sidebarLinks" class="flex flex-col font-semibold">
                <li :key="i" 
                    class="flex items-center w-full h-fit my-1 py-3 border hover:bg-blue-500 hover:text-zinc-100 cursor-pointer rounded-lg"  
                    :class="sidebarStatus ? 'justify-start px-4' : 'justify-center px-0'">
                    
                    <a :href="e.url" class="flex gap-1">
                        <ChevronRight /> 
                        <span :class="sidebarStatus ? 'block' : 'hidden'">
                            {{ e.text }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>