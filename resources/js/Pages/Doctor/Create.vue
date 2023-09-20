<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    let form = useForm({
        doc_id: '',
        specialization: '',
        contact_no: '',
    })

    let props = defineProps({
        doctors: Array,
        user: Object,
    })

    const submit = () =>{
        form.post('/doctor')
    }
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Doctor</h2>
        </template>
        <div>
            <div class="w-1/2 mt-10 mx-auto px-2 ">
                <div class="h-12">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                          <div class="flex items-center space-x-5">
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Create Doctor Form</h2>
                            </div>
                          </div>
                          <hr>
                          <div class="divide-y divide-gray-200">
                                <form class="" @submit.prevent="submit">
                                    <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Firstname</label>
                                            <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 100">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Lastname</label>
                                            <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 100">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Specialization</label>
                                            <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 100">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Contact No</label>
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
