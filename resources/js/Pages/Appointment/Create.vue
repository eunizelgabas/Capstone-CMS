<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import { ref, onMounted } from 'vue';
    import { Link , Head} from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';

    let form = useForm({
       'date' : '',
       'time' : '',
       'user_id': '',
       'doc_id': [],
       'service': '',
       'status': '',
       'reason': '',
    //    'selectedDoctor': null,
        'selectedService':null

    })

    let props = defineProps({
        doctors: Array,
        services: Array,
        user:Object

    });

    const selectedDoctor  = ref(null)

//   // Fetch doctors when the component is mounted
//   async function fetchDoctors() {
//       // Make an API call to fetch available doctors and populate the "doctors" data property
//       // Example: const response = await axios.get('/api/doctors');
//       // this.doctors = response.data.doctors;
//     },
//     // Fetch services when a doctor is selected
//     async function fetchServices() {
//       if (this.selectedDoctor) {
//         // Make an API call to fetch available services for the selected doctor and populate the "services" data property
//         // Example: const response = await axios.get(`/api/doctor/${this.selectedDoctor}/services`);
//         // this.services = response.data.services;
//       } else {
//         // Clear the services when no doctor is selected
//         this.services = [];
//       }
//     },

//     mounted() {
//     // Fetch available doctors when the component is mounted
//     this.fetchDoctors();
//   },
    // const services = ref([]);

    // const getDoctorServices = (ev) => {
    //     let doctor = props.doctors.find(doctor => doctor.id === ev.target.value)

    //     services.value = doctor.services;
    // }

    // Fetch available doctors when the component is mounted
    onMounted(async () => {
      try {
        // Make an API call to fetch available doctors and populate the "doctors" data property
      const response = await axios.get('/api/doctors');
        props.doctors.value = response.data.doctors;
      } catch (error) {
        console.error('Error fetching doctors:', error);
      }
    });

    // Fetch services when a doctor is selected
    const fetchServices = async () => {
      try {
        if (selectedDoctor.value) {
          // Make an API call to fetch available services for the selected doctor and populate the "services" data property
           const response = await axios.get(`/api/doctor/${selectedDoctor.value}/services`);
          props.services.value = response.data.services;
        } else {
          // Clear the services when no doctor is selected
          props.services.value = [];
        }
      } catch (error) {
        console.error('Error fetching services:', error);
      }
    };
    const submit = () =>{
        form.post('/appointment')
    }

</script>

<template>
    <Head title="Create Appointment"/>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Appointment</h2>
        </template>
        <div>
            <div class="w-full mt-10 mx-auto px-4 ">
                <form @submit.prevent="submit">
                    <div class="space-y-6">
                        <div class="block pl-12 font-semibold text-xl self-start text-gray-700">
                            <h1 class="leading-relaxed">Appointment Details Form</h1>
                            <hr>
                          </div>
                      <div class="border-b border-gray-900/10 pb-12">

                        <div class=" px-12 py-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-3 mx-auto">
                          <div class="sm:col-span-1">
                            <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.firstname" name="firstname" id="firstname" autocomplete="firstname" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.firstname">{{ form.errors.firstname }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                            <div class="mt-2">
                              <input type="text" v-model="form.lastname" name="lastname" id="lastname" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.lastname">{{ form.errors.lastname }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                            <div class="mt-2">
                              <input id="date" v-model="form.date" name="date" type="date" autocomplete="date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <div class="text-sm text-red-500 italic" v-if="form.errors.date">{{ form.errors.date }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-1">
                            <label for="doctor" class="block text-sm font-medium leading-6 text-gray-900">Doctor</label>
                            <div class="mt-2">
                              <select id="doctor" v-model="form.doctor" name="doctor" @change="fetchServices"  autocomplete="doctor" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option selected disabled >Select doctor</option>
                                <option v-for="doc in doctors" :key="doc.id" :value="doc.id">{{ doc.user.firstname }} {{ doc.user.lastname }}</option>
                              </select>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.gender">{{ form.errors.gender }}</div>
                            </div>
                          </div>

                          <div class="sm:col-span-2" >
                            <label for="service" class="block text-sm font-medium leading-6 text-gray-900">Services</label>
                            <div class="mt-2">
                                <select id="service" v-model="form.selectedService"  name="service" autocomplete="service"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" >
                                  <option selected disabled >Select services</option>
                                  <option v-for="service in services" :key="service.id" :value="service.id">{{ service.name }}</option>
                                </select>
                                <div class="text-sm text-red-500 italic" v-if="form.errors.service">{{ form.errors.service }}</div>
                              </div>
                          </div>

                          <div class="sm:col-span-3">
                            <label for="reason" class="block text-sm font-medium leading-6 text-gray-900">Reason</label>
                            <div class="mt-2">
                              <textarea id="reason" v-model="form.reason" name="reason" type="text" autocomplete="reason" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                              <div class="text-sm text-red-500 italic" v-if="form.errors.reason">{{ form.errors.reason }}</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6 mb-3">
                      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                  </form>
            </div>
        </div>
    </Sidebar>

</template>
