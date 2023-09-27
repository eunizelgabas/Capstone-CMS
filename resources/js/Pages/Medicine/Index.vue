<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import Modal from  '@/Components/Modal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import Pagination from '@/Components/Pagination.vue'
    import { ref, watch } from 'vue';
    import { useForm, router, Link } from '@inertiajs/vue3';

    let showConfirm = ref(false)
    let selectedMedicineForDelete = null
    let selectedMedicine = null


    let form = useForm({
        name: '',
        cat_id: '',
        type_id: '',
        measurement: '',
        description: ''
    })

    let deleteForm = useForm({});

    function closeModal(){
        showForm.value = false;
    }

    let props = defineProps({
        medicines: Object,
        type: Object,
        category: Object,
        filters:Object,
    })

    function edit(med) {
    form.name = med.name
    form.cat_id = med.cat_id
    form.type_id = med.type_id
    form.measurement = med.measurement
    form.description = med.description
    selectedMedicine = med
    }

    const submit = () =>{
        if(selectedMedicine) {
            form.put('/medicine/' + selectedMedicine.id)
            form.name = "";
            form.cat_id = "",
            form.type_id = "",
            form.measurement = "",
            form.description = ""
            }else {
            form.post('/medicine')
            form.name = "";
            form.cat_id = "",
            form.type_id = "",
            form.measurement = "",
            form.description = ""
        }
    }

    function remove(med) {
        selectedMedicineForDelete = med
        showConfirm.value = true;
    }

    function deleteMed(){
        deleteForm.delete('/medicine/' + selectedMedicineForDelete.id)
        showConfirm.value = false;
    }

    let search = ref(props.filters.search);
    watch(search, (value) => {
        router.get(
            "/medicine",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    });
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medicine</h2>

        </template>

        <div class="px-2 mt-5">
            <div class="flex -mx-2">
            <div class="w-1/3 px-2">
                <div class="h-12">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                          <div class="flex items-center space-x-5">
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Medicine Form</h2>
                            </div>
                          </div>
                          <hr>
                          <div class="divide-y divide-gray-200">
                                <form class="" @submit.prevent="submit">
                                    <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Name</label>
                                            <input type="text" v-model="form.name" id="name" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. Paracetamol">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
                                        </div>
                                        <!-- <div class="flex flex-col">
                                            <label class="leading-loose">Type</label>
                                            <select id="type_id" name="type_id" v-model="form.type_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                <option value="" disabled>Select a type</option>
                                                <option v-for="mt in type" :value="mt.id" :key="mt.id"> {{ mt.name }}</option>
                                            </select>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.type_id">{{ form.errors.type_id }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Category</label>
                                            <select id="cat_id" name="cat_id" v-model="form.cat_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                <option value="" disabled>Select a category</option>
                                                <option v-for="mc in category" :value="mc.id" :key="mc.id"> {{ mc.name }}</option>
                                            </select>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.cat_id">{{ form.errors.cat_id }}</div>
                                        </div> -->
                                        <div class="flex items-center space-x-6">
                                            <div class="flex flex-col">
                                              <label class="leading-loose">Type</label>
                                              <div class="relative focus-within:text-gray-600 text-gray-400 ">
                                                <select id="type_id" name="type_id" v-model="form.type_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                    <option value="" disabled>Select</option>
                                                    <option v-for="mt in type" :value="mt.id" :key="mt.id"> {{ mt.name }}</option>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="flex flex-col">
                                              <label class="leading-loose">Category</label>
                                              <div class="relative focus-within:text-gray-600 text-gray-400 ">
                                                <select id="cat_id" name="cat_id" v-model="form.cat_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                    <option value="" disabled>Select</option>
                                                    <option v-for="mc in category" :value="mc.id" :key="mc.id"> {{ mc.name }}</option>
                                                </select>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Measurement</label>
                                            <input type="text" v-model="form.measurement" id="measurement" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 350mg">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.measurement">{{ form.errors.measurement }}</div>
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Description</label>
                                            <textarea type="text" v-model="form.description" id="description" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. antibiotics"></textarea>
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.description">{{ form.errors.description }}</div>
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
            <div class="w-3/4 px-2">
                <div class="h-12">
                    <!-- <div class="flex justify-between">
                        <h1 class="text-3xl font-medium text-gray-700 "></h1>
                        <Link :href="route('stock.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 mr-4" >Add Stock</Link>
                    </div> -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <div class="mt-4 mr-0 mb-0 ml-0 sm:mt-0">
                            <p class="sr-only">Search Medicine Type</p>
                            <div class="relative">
                                <div class="flex items-center pt-0 pr-0 pb-0 pl-3 absolute inset-y-0 left-0 pointer-events-none">
                                    <p>
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21
                                        21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    </p>
                                </div>
                                <input placeholder="Search Category" type="search" class="border block pt-2 pr-0 pb-2 pl-10 py-2
                                    border-blue-300 rounded-lg focus:ring-blue-600 focus:border-blue-600 sm:text-sm"
                                    v-model="search"/>
                            </div>
                        </div>
                        <table class="mt-5 min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Name</th>
                                    <th class="py-3 px-6 text-center">Category</th>
                                    <th class="py-3 px-6 text-center">Type</th>
                                    <th class="py-3 px-6 text-center">In stocks</th>
                                    <th class="py-3 px-6 text-center">Measurement</th>
                                    <th class="py-3 px-6 text-center">Description</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <!-- <tr v-if="medicines.length === 0">
                                    <td colspan="12">No Available Medicine</td>
                                </tr> -->

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="med in medicines.data" :key="med.id">
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ med.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ med.category.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ med.type.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{med.inventory ? med.inventory.stocks :  0}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ med.measurement }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ med.description }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <Modal :show="showConfirm" @close="closeModal"></Modal>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>

                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn" @click="edit(med)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" @click="remove(med)" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                <Modal :show="showConfirm" @close="closeModal">
                                                    <div class="p-4 sm:p-10 text-center overflow-y-auto">
                                                        <!-- Icon -->
                                                        <span class="mb-4 inline-flex justify-center items-center w-[62px] h-[62px] rounded-full border-4 border-red-50 bg-red-100 text-red-500">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                                        </svg>
                                                        </span>
                                                        <!-- End Icon -->

                                                        <h3 class="mb-2 text-2xl font-bold text-gray-800">
                                                            Delete Medicine
                                                        </h3>
                                                        <p class="text-gray-500">
                                                            Are you sure you want like to delete this Medicine?
                                                        </p>

                                                        <div class="mt-6 flex justify-center gap-x-4">
                                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                                            <DangerButton @click="deleteMed()">Delete</DangerButton>
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
                    <Pagination :links="medicines.links" class="mt-6 text-center"/>
                </div>
            </div>

            </div>
        </div>
    </Sidebar>
</template>
