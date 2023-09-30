<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { ref } from 'vue';
    import { Link, useForm, Head } from '@inertiajs/vue3';
    import moment from 'moment';
    // import axios from 'axios';

    let showConfirm = ref(false)
    let selectedStockForDelete = null
    let selectedStock = null


    let form = useForm({
        med_id: '',
        purchase_date: '',
        qty: '',
        expiry_date: '',
    })



    let props = defineProps({
        stocks: Array,
        medicine:Object
    })

    function edit(sto) {
    form.med_id = doc.med_id,
    form.qty = doc.qty,
    form.purchase_date = doc.purchase_date
    form.expiry_date =  doc.expiry_date
    }

    // function remove(doc) {
    //     selectedDoctorForDelete = doc
    //     showConfirm.value = true;
    // }


    const submit = () =>{
        if(selectedStock) {
            form.put('/stock/' + selectedStock.id)
            }else {
            form.post('/stock')
        }
    }

    function formattedDate(date){
        return moment(date).format('MMMM   D, YYYY');
    }
</script>

<template>
    <Head title="Purchase"/>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Purchase Medicine</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="flex -mx-2">
                <div class="w-1/3 px-2">
                    <div class="h-12">
                        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                            <div class="max-w-md mx-auto">
                              <div class="flex items-center space-x-5">
                                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                                  <h2 class="leading-relaxed">Purchase Stock Form</h2>
                                </div>
                              </div>
                              <hr>
                              <div class="divide-y divide-gray-200">
                                    <form class="" @submit.prevent="submit">
                                        <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                            <div class="flex flex-col">
                                                <label class="leading-loose">Purchase Date</label>
                                                <input type="date" v-model="form.purchase_date" id="purchase_date" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. 350mg">
                                                <div class="text-sm text-red-500 italic" v-if="form.errors.purchase_date">{{ form.errors.purchase_date }}</div>
                                            </div>

                                                <div class="flex flex-col">
                                                    <label class="leading-loose">Medine</label>
                                                    <div class="relative focus-within:text-gray-600 text-gray-400 sm:col-span-2 ">
                                                      <select id="med_id" name="med_id" v-model="form.med_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                          <option value="" disabled>Select</option>
                                                          <option v-for="med in medicine" :value="med.id" :key="med.id"> {{ med.name }}</option>
                                                      </select>
                                                    </div>
                                                  </div>

                                            <div class="flex flex-col">
                                                <label class="leading-loose">Quantity</label>
                                                <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                                <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                                            </div>
                                            <div class="flex flex-col">
                                                <label class="leading-loose">Expiry Date</label>
                                                <input type="date" v-model="form.expiry_date" id="expiry_date" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
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
            <div class="w-3/4 px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Purchase Date</th>
                                    <th class="py-3 px-6 text-center">Medicine</th>
                                    <th class="py-3 px-6 text-center">Quantity</th>
                                    <th class="py-3 px-6 text-center">Expiry Date</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="sto in stocks" :key="sto.id">
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{  formattedDate(sto.purchase_date) }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ sto.medicine.name }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ sto.qty }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ formattedDate(sto.expiry_date)}}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn" @click="edit(sto)" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="w-4  ml-2 mr-2 transform hover:text-red-500 hover:scale-110">
                                                <a href="#" class="btn" title="Delete">
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
                    <!-- <PrimaryButton class="mt-5 items-right" >Save</PrimaryButton> -->
                </div>
            </div>

            </div>
        </div>
    </Sidebar>
</template>
