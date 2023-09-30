<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import { ref } from 'vue';
    import { Link, useForm } from '@inertiajs/vue3';

    let showConfirm = ref(false)
    let selectedDoctorForDelete = null
    let selectedDoctor = null


    let form = useForm({
        doc_id: '',
        specialization: '',
        contact_no: '',
    })



    let props = defineProps({
        doctors: Array,
        user: Object,
    })

    function edit(doc) {
    form.doc_id = doc.med_id
    form.specialization = doc.qty
    form.contact_no = doc.qty
    selectedDoctor = inv
    }

    function remove(doc) {
        selectedDoctorForDelete = doc
        showConfirm.value = true;
    }

    const submit = () =>{
        if(selectedDoctor) {
            form.put('/doctor/' + selectedDoctor.id)
            form.doc_id = ""
            form.specialization = ""
            form.contact_no = ""
            }else {
            form.post('/doctor')
            form.doc_id = ""
            form.specialization = ""
            form.contact_no = ""
        }
    }
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="p-4 mx-2">
                <div class="flex justify-between">
                    <h1 class="text-3xl font-medium text-gray-700 "></h1>
                    <Link href="/doctor/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 mr-4" >Add Doctor</Link>
                </div>
            <div class="w-full px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-center">Doctor Name</th>
                                    <th class="py-3 px-6 text-center">Specialization</th>
                                    <th class="py-3 px-6 text-center">Contact No</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="doc in doctors" :key="doc.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">

                                            <p class="font-medium">{{ doc.id }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ doc.user.firstname }} {{ doc.user.lastname }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ doc.specialization }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ doc.contact_no }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn" @click="edit(inv)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                            </div>
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
