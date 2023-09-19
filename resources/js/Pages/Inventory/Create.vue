<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    let form = useForm({
        med_id: '',
        qty: '',
        expiry_date: '',
    })

    let props = defineProps({
        inventories: Array,
        medicine: Object,
        stocks:Array
    })

    const submit = () =>{
        form.post('/stock')
    }
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medicine Stock</h2>
        </template>
        <div>
            <div class="w-1/2 mt-10 mx-auto px-2 ">
                <div class="h-12">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                          <div class="flex items-center space-x-5">
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Medicine Stock Form</h2>
                            </div>
                          </div>
                          <hr>
                          <div class="divide-y divide-gray-200">
                                <form class="" @submit.prevent="submit">
                                    <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Medicine Name</label>
                                            <select id="med_id" name="med_id" v-model="form.med_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                <option value="" disabled>Select a medicine</option>
                                                <option v-for="m in medicine" :value="m.id" :key="m.id"> {{ m.name }}</option>
                                            </select>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.cat_id">{{ form.errors.cat_id }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Quantity</label>
                                            <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 100">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Expiry Date</label>
                                            <input type="date" v-model="form.expiry_date" id="expiry_date" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. antibiotics">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.expiry_date">{{ form.errors.expiry_date }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-2 rounded-md focus:outline-none">Save</button>
                                    </div>
                                </form>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </Sidebar>

</template>
