<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import { ref } from 'vue';
    import { Link, Head } from '@inertiajs/vue3';

    const props = defineProps({
        doctor: Object,
        services: Array,
        serviceCount:Number
    })

    const getStatusText = (status) => {
      return status === 1 ? 'Active' : 'Inactive';
    };
</script>

<template>
    <Sidebar>
        <Head title="Doctor Details"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor Details</h2>
        </template>
        <div>
            <div class="p-12">
                <div class="p-8 bg-white shadow mt-12">
                  <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                      <div>
                        <p class="font-bold text-gray-700 text-xl">{{ serviceCount }}</p>
                        <p class="text-gray-400">Services</p>
                      </div>
                      <!-- <div>
                           <p class="font-bold text-gray-700 text-xl">10</p>
                        <p class="text-gray-400">Photos</p>
                      </div>
                          <div>
                           <p class="font-bold text-gray-700 text-xl">89</p>
                        <p class="text-gray-400">Comments</p>
                      </div> -->
                    </div>
                    <div class="relative">
                      <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                      </div>
                    </div>

                    <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                <button
                  class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"
                >
                  Active
                </button>
                    <button
                  class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5"
                >
                  Make Inactive
                </button>
                    </div>
                  </div>

                  <div class="mt-20 text-center border-b pb-12">
                    <h1 class="text-4xl font-medium text-gray-700">{{ doctor.user.firstname }} {{ doctor.user.lastname }},  <span class="font-light text-gray-500">{{ doctor.specialization }}</span></h1>
                    <p class="font-light text-gray-600 mt-3">Contact No: {{ doctor.user.contact_no }}</p>
                    <p class="remarks-cell inline-block bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ getStatusText(doctor.status) }}</p>

                    <p class="mt-8 text-gray-500">{{ doctor.user.gender }}</p>
                    <p class="mt-2 text-gray-500">{{ doctor.user.email }}</p>
                  </div>

                  <div class="mt-12 flex flex-col justify-center">
                    <p class="text-gray-600 text-center font-light lg:px-16" v-for="service in doctor.services" :key="service.id">{{ service.name}}</p>
                    <button
                  class="text-indigo-500 py-2 px-4  font-medium mt-4"
                >
                  Show more
                </button>
                  </div>

                </div>
                </div>
            </div>
    </Sidebar>

</template>
