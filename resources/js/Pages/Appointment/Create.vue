<script setup>
import Sidebar from '@/Layouts/Sidebar.vue';
import TextInput from '@/Components/TextInput.vue'
import { useForm, Head, Link } from '@inertiajs/vue3';
// import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    appointments: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    name: '',
    // appointment_no: '',
    appointment_date: '',
    appointment_time: '',
    service: '',
    status: '',
    // patient: '',

});

const submit = () => {
    form.post(route("appointments.store"));
};
</script>

<template>
    <Head title="Add" />

    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div> -->
                <div class="border rounded-lg">
                    <div class="border-b p-2">
                        <h1 class="text-2xl font-semibold text-gray-800 leading-tight">Add New Appointment</h1>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-4">
                            <label for="name" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Name</label>
                            <TextInput
                                v-model="form.name"
                                type="text"
                                id="name"
                                class="flex-1"
                            />
                        </div>
                        <!-- Fields Here -->
                        <!-- <div class="flex items-center mb-4">
                            <label for="appointment_no" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Appointment no.</label>
                            <TextInput
                                v-model="form.appointment_no"
                                type="number"
                                id="appointment_no"
                                class="flex-1"
                            />
                        </div> -->

                        <div class="flex items-center mb-4">
                            <label for="app-date" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Date</label>
                            <TextInput
                            v-model="form.appointment_date"
                                type="date"
                                id="app-date"
                                class="flex-1"
                            />
                        </div>

                        <div class="flex items-center mb-4">
                            <label for="app-time" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Time</label>
                            <TextInput
                                v-model="form.appointment_time"
                                type="time"
                                id="app-time"
                                class="flex-1"
                            />
                        </div>

                         <!-- <div class="flex items-center mb-4">
                            <label for="patient" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Patient</label>
                            <select name="" id="patient" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm flex-1">
                                <option value="">Select Patient</option>
                            </select>
                        </div> -->

                        <div class="flex items-center mb-4">
                            <label for="service" class="border rounded-l-lg py-2.5 px-2 text-sm bg-gray-100 select-none">Service</label>
                            <select name="" id="service" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm flex-1">
                                <option value="">Select Service</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" @click="submit" class="px-4 py-2 rounded-lg text-sm bg-blue-600 hover:bg-blue-500 text-white">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>
</template>
