<script setup>
    import { ref } from 'vue';
    import { AlignJustify, Pencil, Plus, Trash } from 'lucide-vue-next';
    import Sidebar from './Sidebar.vue';
    import { router } from '@inertiajs/vue3';

    const sidebarToggle = ref(true);
    const itemsRef = ref(null);

    const toggle = () => {
        sidebarToggle.value = !sidebarToggle.value;
    }

    const routeToAddItem = () => {
        router.visit('/panel/add');
    }

    const fetchItems = async () => {
        try {
            const response = await axios.get('http://localhost:8000/api/items');
            itemsRef.value = response.data.items;

            console.log(response.data.items);
        } catch (error) {
            console.log(error)
        }
    }
    fetchItems();
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
            <div class="flex-grow h-2/6 w-full p-4 bg-zinc-50 overflow-y-scroll">
                <div class="flex items-center w-fit h-fit gap-2 ">
                    <label for="rowCount" class="text-lg">Shows:</label>
                    <select class="h-fit w-32 rounded-md border-zinc-400">
                        <option value="10">10 rows</option>
                        <option value="15">15 rows</option>
                        <option value="20">20 rows</option>
                    </select>
                </div>
                <div class="flex flex-grow w-full h-full">
                    <div class="container mx-auto py-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Action</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">No</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Item</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Category</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Description</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Price</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Owner</th>
                                <th class="flex justify-center px-4 py-2 text-left text-gray-600 font-medium">Publish</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            <tr class="border-b" v-for="(item, index) in itemsRef" :key = "index">
                            <td class="flex px-4 py-2 gap-1">
                                <button class="size-fit p-1 box-border border rounded-md border-zinc-300">
                                    <Pencil size="20" />
                                </button>
                                <button class="size-fit p-1 box-border border rounded-md border-zinc-300">
                                    <Trash size="20" />
                                </button>
                            </td>
                            <td class="px-4 py-2">{{ item.id }}</td>
                            <td class="px-4 py-2">{{ item.item_name }}</td>
                            <td class="px-4 py-2">{{ item.item_category }}</td>
                            <td class="px-4 py-2">{{ item.item_description }}</td>
                            <td class="px-4 py-2">{{ item.item_price }}</td>
                            <td class="px-4 py-2">{{ item.owner_name }}</td>
                            <td class="flex justify-center px-4 py-2">
                                <input type="checkbox">
                            </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                        </table>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>