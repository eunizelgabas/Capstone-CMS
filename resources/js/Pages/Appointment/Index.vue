<template>
    <Head title="Appointments" />

    <Sidebar>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Appointments</h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="border rounded-lg">
            <div class="flex justify-between items-center border-b p-2">
              <h1 class="text-2xl text-gray-600">Appointments</h1>

              <Link href="/appointments/create" class="px-4 py-2 rounded-lg text-sm bg-blue-600 hover:bg-blue-500 text-white flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
                  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8z"/>
                </svg>
                &nbsp;&nbsp;Add Appointment
              </Link>
            </div>
            <div class="p-2">
              <table class="w-full h-auto table-fixed">
                <thead>
                  <tr>
                    <th class="p-2 text-gray-600 border border-gray-300">ID</th>
                    <th class="p-2 text-gray-600 border border-gray-300">Name</th>
                    <th class="p-2 text-gray-600 border border-gray-300">Date</th>
                    <th class="p-2 text-gray-600 border border-gray-300">Time</th>
                    <th class="p-2 text-gray-600 border border-gray-300 text-center">Service</th>
                    <th class="p-2 text-gray-600 border border-gray-300 text-center">Status</th>
                    <th class="p-2 text-gray-600 border border-gray-300 text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop through appointments -->
                  <tr v-for="appointment in appointments" :key="appointment.id" class="border border-gray-300">
                    <td class="p-2 border border-gray-300">{{ appointment.id }}</td>
                    <td class="p-2 border border-gray-300">{{ appointment.name }}</td>
                    <td class="p-2 border border-gray-300 text-gray-500">{{ appointment.appointment_date }}</td>
                    <td class="p-2 border border-gray-300 text-center text-gray-500">{{ appointment.appointment_time }}</td>
                    <td class="p-2 border border-gray-300 text-center text-gray-500">{{ appointment.service_id }}</td>
                    <td class="p-2 border border-gray-300 text-center text-gray-500">{{ appointment.status }}</td>
                    <td class="p-2 border border-gray-300 text-center text-gray-500 space-x-2">
                        <button class="text-gray-700" @click="editAppointment(appointment.id)">Edit</button>
                      <button @click="confirmDelete(appointment.id)" class="text-red-600 cursor-pointer">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </Sidebar>
  </template>
<script setup>
import Sidebar from '@/Layouts/Sidebar.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<script>
export default {
    methods: {
        async confirmDelete(appointmentId) {
            const confirmDelete = window.confirm('Are you sure you want to delete this appointment?');

            if (confirmDelete) {
                await this.$inertia.delete(route('appointments.destroy', appointmentId));
            }
        },
    },
};
</script>
