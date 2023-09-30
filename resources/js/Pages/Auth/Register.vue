<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    lastname: '',
    firstname: '',
    middlename: '',
    suffix: '',
    type: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <template #logo >
            <img src="images/mdc.jpg" alt="" class="object-cover h-100 w-full rounded-l-xl opacity-80">

            <div class="bg-gray-700 opacity-20 absolute top-0 h-full w-full"></div>

            <div class="absolute top-0 flex-col w-full pt-36">
                <img src="images/mdclogo.png" alt="mdc-logo" class="w-32 h-32 mx-auto mb-3">
                <h1 class="text-4xl font-extrabold text-white text-center" style="font-family: 'Poppins', sans-serif;">Mater Dei College's <br> Clinic Management <br> System</h1>
            </div>
        </template>

        <template #form>
            <div class="px-20 py-20">
            <h1 class="text-4xl font-extrabold text-gray-700 text-center mb-2">Log in to your account</h1>

                <h4 class="text-lg font-light text-gray-700 text-center mb-3">Welcome Back!</h4>

            <form @submit.prevent="submit">
            <div>
                <InputLabel for="firstname" value="Firstname" />

                <TextInput
                    id="firstname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.firstname"
                    required
                    autofocus
                    autocomplete="firstname"
                />

                <InputError class="mt-2" :message="form.errors.firstname" />
            </div>

            <div>
                <InputLabel for="lastname" value="Lastname" />

                <TextInput
                    id="lastname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.lastname"
                    required
                    autofocus
                    autocomplete="lastname"
                />

                <InputError class="mt-2" :message="form.errors.lastname" />
            </div>
            <div>
                <InputLabel for="middlename" value="Middlename" />

                <TextInput
                    id="middlename"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.middlename"
                    autofocus
                    autocomplete="middlename"
                />

                <InputError class="mt-2" :message="form.errors.middlename" />
            </div>
            <div>
                <InputLabel for="suffix" value="Suffix" />

                <TextInput
                    id="suffix"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.suffix"
                    autofocus
                    autocomplete="suffix"
                />

                <InputError class="mt-2" :message="form.errors.suffix" />
            </div>

            <div>
                <InputLabel for="type" value="Type" />

                <TextInput
                    id="type"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.type"
                    required
                    autofocus
                    autocomplete="type"
                />

                <InputError class="mt-2" :message="form.errors.type" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </div>
    </template>
    </GuestLayout>
</template>
