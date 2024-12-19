<script setup>
    import { onMounted, ref } from 'vue';
    import Sidebar from './Sidebar.vue';
    import { AlignJustify } from 'lucide-vue-next';
    import "../../css/styles.css";
    import Leaflet from './Leaflet.vue';
    import Tiptap from './Tiptap.vue';
    import axios from 'axios';
    import { router } from '@inertiajs/vue3';   

    const sidebarToggle = ref(true);

    const toggle = () => {
        sidebarToggle.value = !sidebarToggle.value;
    }

    const itemNameRef = ref(null);
    const itemCategoryRef = ref(null);
    const itemPriceRef = ref(null);
    const itemDescriptionRef = ref(null);
    const itemConditionRef = ref(null);
    const itemTypeRef = ref(null);

    const ownerNameRef = ref(null);
    const ownerNumberRef = ref(null);
    const ownerAddressRef = ref(null);

    const ownerLocationRef = ref({lat: 0, lng: 0});

    const fetchLocation = async () => {
        try {
            const response = await axios.get(`
            https://api.opencagedata.com/geocode/v1/json?q=${ownerLocationRef.value.lat}+${ownerLocationRef.value.lng}&key=611d6ef744b841da87d800d816fde425`)

            console.log(response.data);

            ownerAddressRef.value.value = response.data.results[0].formatted;
        } catch (error) {
            console.log(error);
        }
    }

    const getOwnerLocation = async () => {
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                successCallback
            )
        }
    }

    const successCallback = async (position) => {
        ownerLocationRef.value.lat = position.coords.latitude;
        ownerLocationRef.value.lng = position.coords.longitude;

        console.log(ownerLocationRef.value.lat, ownerLocationRef.value.lng);
    }

    const handleSubmit = async () => {
        const itemData = {
            "item_name": itemNameRef.value.value,
            "item_category": itemCategoryRef.value.value,
            "item_price": parseFloat(itemPriceRef.value.value),
            "item_description": itemDescriptionRef.value.getContent(),
            "item_condition": itemConditionRef.value.value,
            "item_type": itemTypeRef.value.value,
            "owner_name": ownerNameRef.value.value,
            "owner_contact_number": ownerNumberRef.value.value,
            "owner_address": ownerAddressRef.value.value,
            "owner_lat": ownerLocationRef.value.lat,
            "owner_lng": ownerLocationRef.value.lng
        }
        console.log(itemData);
        try {
            const response = await axios.post('http://localhost:8000/api/add',itemData)
            console.log(response.data);

            router.visit('/panel');
        } catch (error) {
            console.log(error);
        }
        console.log(itemDescriptionRef.value.getContent());
    }

    const getEditorContent = () => {
        if (editorRef.value) {
            const htmlContent = editorRef.value.getHTML();
            const jsonContent = editorRef.value.getJSON();
            const textContent = editorRef.value.getText();
            
            console.log('HTML:', htmlContent);
            console.log('JSON:', jsonContent);
            console.log('Text:', textContent);
        }
    };

    function updateLocation({ lat, lng }) {
        ownerLocationRef.value.lat = lat;
        ownerLocationRef.value.lng = lng;

        fetchLocation();
    }

    const routeToPanel = () => {
        router.visit('/panel');
    }
    getOwnerLocation();
</script>

<template>
    <div class="flex h-screen w-full">
        <div :class="sidebarToggle ? 'w-1/5' : 'w-20'" class="h-full transition-all duration-500">
            <Sidebar :sidebar-status="sidebarToggle" />
        </div>
        <form @submit.prevent="handleSubmit" class="flex flex-col h-full w-1/2 flex-grow ">
            <div class="flex items-center w-full h-14 border-b border-zinc-500">
                <button @click="toggle" class="h-full w-fit px-4">
                    <AlignJustify />
                </button>
            </div>
            <div class="flex flex-col w-full h-1/2 px-10 py-4 gap-4 flex-grow overflow-y-scroll">
                <div class="w-full h-fit py-2">
                    <button @click="routeToPanel" class=" underline">Panel</button>
                    <span> > Add</span>

                </div>
                <div class="w-full h-fit px-4 py-2 text-lg bg-indigo-100 font-semibold rounded-md">
                    Add Items
                </div>
                <div class="flex w-full h-fit gap-10 font-semibold">
                    <div class="flex flex-col w-1/2 h-full gap-4">
                        <h2 class="text-lg">Item Information</h2>
                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="item-name">Item Name</label>
                            <input type="text" id="item-name" ref="itemNameRef"class="h-12 px-2 rounded-md">
                        </div>
                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="select-category">Item Category</label>
                            <select name="category" id="select-category" ref="itemCategoryRef"class="h-12 rounded-md">
                                <option value="clothes">Clothes</option>
                                <option value="computers">Computers</option>
                                <option value="mobiles">Mobiles</option>
                                <option value="books">Books</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="item-price">Item Price</label>
                            <input type="text" id="item-price" ref="itemPriceRef"class="h-12 px-2 rounded-md">
                        </div>
                        <div class="flex flex-col w-full h-fit gap-2 font-light">
                            <label>Description</label>
                            <Tiptap ref="itemDescriptionRef"/>
                        </div>
                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="select-condition">Select Item Condition</label>
                            <select name="condition" id="select-condition" ref="itemConditionRef" class="h-12 rounded-md">
                                <option value="new">New</option>
                                <option value="used">Used</option>
                                <option value="good-used">Good Second Hand</option>
                            </select>
                        </div>
                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="select-type">Select Item Type</label>
                            <select name="type" id="select-type" ref="itemTypeRef" class="h-12 rounded-md">
                                <option value="sell">For Sell</option>
                                <option value="buy">For Buy</option>
                                <option value="exchange">For Exchange</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col w-1/2 h-full gap-4">
                        <h2 class="text-lg">Owner Information</h2>

                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="owner-name">Owner Name</label>
                            <input type="text" id="owner-name" name="ownerName" ref="ownerNameRef" class="h-12 px-2 rounded-md">
                        </div>

                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="owner-number">Contact Number</label>
                            <input type="tel" id="owner-number" name="ownerNumber" ref="ownerNumberRef" class="h-12 px-2 rounded-md">
                        </div>

                        <div class="flex flex-col w-full h-fit gap-2">
                            <label for="owner-address">Address</label>
                            <textarea name="address" id="owner-address" ref="ownerAddressRef" class="h-32 max-h-32 resize-none rounded-lg"></textarea>
                        </div>
                        <div class="flex flex-col w-full h-full gap-2 border border-zinc-400">
                            <Leaflet :lat="ownerLocationRef.lat" :lng="ownerLocationRef.lng" @update-location="updateLocation"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end w-full h-14 px-4 gap-2 border-t border-zinc-400">
                <button class="w-fit h-fit px-6 py-1">Cancel</button>
                <button type="submit" class="w-fit h-fit px-6 py-1 rounded-[4px] bg-blue-400 text-white hover:bg-blue-500">
                    Add
                </button>
            </div>
        </form>
    </div>
</template>