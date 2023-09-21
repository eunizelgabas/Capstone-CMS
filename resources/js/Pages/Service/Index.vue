<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import ConfirmDialog from '@/Components/ConfirmDialog.vue';
    import Modal from  '@/Components/Modal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import { ref } from 'vue';
    import { useForm, Link } from '@inertiajs/vue3';

    let showConfirmDelete = ref(false)
    let selectedServiceForDelete = null
    let selectedService = null

    let deleteForm = useForm({});

    let form = useForm({
        name: '',
        // doc_id: '',
        description: '',
    })

    let props = defineProps({
    services: Array,
    })

    function closeModal(){
        showConfirmDelete.value = false;
    }
    function remove(service) {
        selectedServiceForDelete = service
        showConfirmDelete.value = true;
        // deleteForm.delete('/service/' + selectedServiceForDelete.id)
    }

    function deleteService(){
        deleteForm.delete('/service/' + selectedServiceForDelete.id)
        showConfirmDelete.value = false;
    }

    function edit(serv){
        form.name = serv.name
        form.description = serv.description
        selectedService = serv
    }

    const submit = () =>{
        if(selectedService) {
            form.put('/service/' + selectedService.id)
            form.name = "";
            form.description = ""
        }else {
            form.post('/service')
            form.name = "";
            form.description = ""
        }
    }
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Service</h2>
        </template>

        <div class="px-2 mt-5">

            <div class="flex -mx-2">
            <div class="w-1/3 px-2">
                <div class="h-12">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                          <div class="flex items-center space-x-5">
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Service Form</h2>
                            </div>
                          </div>
                          <hr>
                          <div class="divide-y divide-gray-200">
                                <form class="" @submit.prevent="submit">
                                    <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Name</label>
                                            <input type="text" v-model="form.name" id="name" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                                        </div>
                                        <!-- <div class="flex flex-col">
                                            <label class="leading-loose">Doctor</label>
                                            <div class="relative focus-within:text-gray-600 text-gray-400 ">
                                              <select id="doc_id" name="doc_id" v-model="form.doc_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                  <option value="" disabled>Select a doctor</option>
                                                  <option v-for="doc in doctors" :value="doc.id" :key="doc.id"> {{ doc.name }}</option>
                                              </select>
                                            </div>
                                        </div> -->
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Description</label>
                                            <textarea type="text" v-model="form.description" id="description" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"></textarea>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.description">{{ form.errors.description }}</div>
                                        </div>
                                    </div>
                                    <div class="pt-4 flex items-center space-x-4">
                                        <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="w-3/4 px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Id</th>
                                    <th class="py-3 px-6 text-center">Name</th>
                                    <!-- <th class="py-3 px-6 text-center">Doctor</th> -->
                                    <th class="py-3 px-6 text-center">Description</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="serv in services" :key="serv.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">

                                            <p class="font-medium">{{ serv.id }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ serv.name }}</p>
                                        </div>
                                    </td>
                                    <!-- <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ serv.doctor.name }}</p>
                                        </div>
                                    </td> -->
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ serv.description }}</p>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#"  @click="edit(serv)" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" @click="remove(serv)" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                <Modal :show="showConfirmDelete" @close="closeModal">
                                                    <div class="p-4 sm:p-10 text-center overflow-y-auto">
                                                        <!-- Icon -->
                                                        <span class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 border-red-50 bg-red-100 text-red-500">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                                        </svg>
                                                        </span>
                                                        <!-- End Icon -->

                                                        <h3 class="mb-2 text-2xl font-bold text-gray-800">
                                                            Delete Service
                                                        </h3>
                                                        <p class="text-gray-500">
                                                            Are you sure you want like to delete this service?
                                                        </p>

                                                        <div class="mt-6 flex justify-center gap-x-4">
                                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                                            <DangerButton @click="deleteService()">Delete</DangerButton>
                                                        </div>
                                                    </div>
                                                </Modal>
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
