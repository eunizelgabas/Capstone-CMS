<script setup>
    import Sidebar from '@/Layouts/Sidebar.vue';
    import ConfirmDialog from '@/Components/ConfirmDialog.vue';
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3';

    let showConfirm = ref(false)
    let selectedCategoryForDelete = null
    let selectedCategory = null


    let form = useForm({
        name: '',
    })

    // let deleteForm = useForm();

    let props = defineProps({
    medcategories: Array,
    })

    function edit(category) {
    form.name = category.name
    selectedCategory = category
    }

    function remove(category) {
        selectedCategoryForDelete = category
        showConfirm.value = true;
    }

    const submit = () =>{
        if(selectedCategory) {
            form.put('/category/' + selectedCategory.id)
            form.name = "";
            }else {
            form.post('/category')
            form.name = "";
        }
    }
</script>

<template>
    <Sidebar>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category</h2>
        </template>

        <div class="px-2 mt-5">
            <div class="flex -mx-2">
            <div class="w-1/3 px-2">
                <div class="h-12">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                          <div class="flex items-center space-x-5">
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Medicine Category Form</h2>
                            </div>
                          </div>
                          <hr>
                          <div class="divide-y divide-gray-200">
                                <form class="" @submit.prevent="submit">
                                    <div class="py-5 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                        <div class="flex flex-col">
                                            <label class="leading-loose">Category</label>
                                            <input type="text" v-model="form.name" id="name" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="e.g. antibiotics">
                                            <div class="text-sm text-red-500 italic" v-if="form.errors.name">{{ form.errors.name }}</div>
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
                                    <th class="py-3 px-6 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light" >

                                <tr  class="border-b border-gray-200 hover:bg-gray-100" v-for="category in medcategories" :key="category.id">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">

                                            <p class="font-medium">{{ category.id }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="font-medium">{{ category.name }}</p>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <a href="#" class="btn" @click="edit(category)">
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
