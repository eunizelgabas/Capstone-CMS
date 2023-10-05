<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import Modal from  '@/Components/Modal.vue';
    import { onMounted, ref } from 'vue';
    import { Link, router, useForm, Head } from '@inertiajs/vue3';
    import { Inertia } from '@inertiajs/inertia-vue3'

    let showConfirm = ref(false)
    let selectedDoctorForDelete = null
    let selectedDoctor = null


    let form = useForm({
        lastname: '',
        firstname: '',
        status: '',
        email:'',
        gender: '',
        specialization: '',
        contact_no: '',
    })

    let props = defineProps({
        doctors: Array,
        user:Object,
        services:Object
    })

    function closeModal(){
        showConfirm.value = false;
    }
    function edit(doc) {
    form.lastname = doc.lastname,
    form.firstname = doc.firstname,
    form.email =  doc.email,
    form.gender =  doc.gender,
    form.status = doc.status,
    form.specialization = doc.qty
    form.contact_no = doc.qty
    selectedDoctor = doc
    }

    function remove(doc) {
        selectedDoctorForDelete = doc
        showConfirm.value = true;
    }
    // const getStatusText = (status) => {
    //   return status === 1 ? 'Active' : 'Inactive';
    // };

    function openInactiveDoctorsModal() {
        showConfirm.value = true;
    }


    const activateDoctor  = () => {
            // Send a request to activate the doctor's status using Inertia.js
             router.post(`/doctor/${props.doctors.id}/activate`);
            // Reload the page or update the doctor data as needed
            router.reload();
        };

        const deactivateDoctor = () => {
            // Send a request to deactivate the doctor's status using Inertia.js
             router.post(`/doctor/${props.doctors.id}/deactivate`);
            // Reload the page or update the doctor data as needed
            router.reload();
        };

    const submit = () =>{
        if(selectedDoctor) {
            form.put('/doctor/' + selectedDoctor.id)

            }else {
            form.post('/doctor')
        }
    }
    //const inactiveDoctors = ref([]);
</script>

<template>
    <Sidebar>
        <Head title="Doctor"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="p-4 mx-2">
                <div class="flex ">
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
                                    <th class="py-3 px-6 text-center">Gender</th>
                                    <th class="py-3 px-6 text-center">Specialization</th>
                                    <th class="py-3 px-6 text-center">Services</th>
                                    <th class="py-3 px-6 text-center">Contact No</th>
                                    <th class="py-3 px-6 text-center">Status</th>
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
                                            <p class="font-medium">{{ doc.user.gender }}</p>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ doc.specialization }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center" v-for="service in doc.services" :key="service.id">
                                            <p class="font-medium">{{ service.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ doc.user.contact_no }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">
                                                <span class=" remarks-cell bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ doc.status ? 'Active' : 'Inactive' }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <!-- <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn" @click="toggleStatus(doc)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                                                      </svg>
                                                </a>
                                            </div> -->
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" v-if="!doc.status">
                                                    <a href="#" class="btn" @click="activateDoctor">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                                                          </svg>
                                                    </a>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" v-if="doc.status">
                                                    <a href="#" class="btn" @click="deactivateDoctor">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                                                          </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <Link :href=" '/doctor/edit/' + doc.id" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </Link>
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
