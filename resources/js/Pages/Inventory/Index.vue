<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import ConfirmDialog from '@/Components/ConfirmDialog.vue';
    import { ref } from 'vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import moment from 'moment'

    let showConfirm = ref(false)
    let selectedInventoryForDelete = null
    let selectedInventory = null


    let form = useForm({
        med_id: '',
        stocks: '',
    })



    let props = defineProps({
        inventories: Array,
        medicines: Object,
    })

    function edit(inv) {
    form.med_id = inv.med_id
    form.stocks = inv.qty
    selectedInventory = inv
    }

    function remove(inv) {
        selectedInventoryForDelete = inv
        showConfirm.value = true;
    }

    const submit = () =>{
        if(selectedInventory) {
            form.put('/inventory/' + selectedMedicine.id)
            form.med_id = "";
            form.stocks = ""
            }else {
            form.post('/inventory')
            form.med_id = "";
            form.stocks = ""
        }
    }
    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
}
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medicine Inventory</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="p-4 mx-2">
                <!-- <div class="flex justify-between">
                    <h1 class="text-3xl font-medium text-gray-700 "></h1>
                    <Link href="/inventory/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2" >Add Stock</Link>
                </div> -->
            <div class="w-full px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-center">Medicine</th>
                                    <th class="py-3 px-6 text-center">Stocks</th>
                                    <th class="py-3 px-6 text-center">Created Date</th>
                                    <th class="py-3 px-6 text-center">Updated Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="inv in inventories" :key="inv.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">

                                            <p class="font-medium">{{ inv.id }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ inv.medicine.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ inv.stocks }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ formattedDate(inv.created_at)}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ formattedDate(inv.updated_at)}}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </Sidebar>
</template>
