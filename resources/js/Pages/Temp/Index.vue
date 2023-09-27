<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { ref } from 'vue';
    import { Link, useForm } from '@inertiajs/vue3';
    import moment from 'moment';
    // import axios from 'axios';

    let showConfirm = ref(false)
    let selectedStockForDelete = null
    let selectedStock = null


    let form = useForm({
        med_id: '',
        qty: '',
        expiry_date: '',
    })



    let props = defineProps({
        stocks: Array,
        medicine:Object
    })

    function edit(doc) {
    form.med_id = doc.lastname,
    form.qty = doc.firstname,
    form.expiry_date =  doc.email
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

//     const medicineList = ref([]);

//     const addMedicineToList = async () => {
//   // Validate and add medicine to the list
//   medicineList.value.push({ ...form.value });
//   // Clear the form fields
//   form.value = {
//     med_id: '',
//     qty: '',
//     expiry_date: '',
//   };

//   try {
//     // Send an Axios POST request to the Laravel backend
//     await axios.post('/api/temporary-stocks', medicineList.value);
//   } catch (error) {
//     // Handle any errors that occur during the request
//   }
// };
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Medicine Stock</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="p-4 mx-2">
                <div class="flex justify-start">
                    <h1 class="text-3xl font-medium text-gray-700 "></h1>
                    <!-- <Link href="/stock/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 mr-4" >Add Stock</Link> -->
                    <form  @submit.prevent="addMedicineToList">
                        <div class="grid gap-6 mb-6 md:grid-cols-4 px-2">
                            <div>
                                <label class="leading-loose">Medicine</label>
                                <select id="med_id" name="med_id" v-model="form.med_id" class="pr-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                                    <option value="" disabled>Select</option>
                                    <option v-for="med in medicine" :value="med.id" :key="med.id"> {{ med.name }} | {{ med.measurement }}</option>
                                </select>
                              </div>
                            <div>
                                <label class="leading-loose">Quantity</label>
                                <input type="number" v-model="form.qty" id="qty" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                                <div class="text-sm text-red-500 italic" v-if="form.errors.qty">{{ form.errors.qty }}</div>
                            </div>

                            <div>
                                <label class="leading-loose">Expiry Date</label>
                                <input type="date" v-model="form.expiry_date" id="expiry_date" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required >
                                <div class="text-sm text-red-500 italic" v-if="form.errors.expiry_date">{{ form.errors.expiry_date }}</div>
                            </div>
                            <div class="mt-7">
                                <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-3 py-2 rounded-md focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                  Add to list
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="w-full px-2">
                <div class="h-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- <div class="p-6 text-gray-900">You're logged in!</div> -->
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Medicine</th>
                                    <th class="py-3 px-6 text-center">Qty</th>
                                    <th class="py-3 px-6 text-center">Expiry Date</th>
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="sto in stocks" :key="sto.id">

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
                    <PrimaryButton class="mt-5 items-right" >Save</PrimaryButton>
                </div>
            </div>

            </div>
        </div>
    </Sidebar>
</template>
