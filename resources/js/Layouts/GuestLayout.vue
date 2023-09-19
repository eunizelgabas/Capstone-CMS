<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div> -->
    <div class="flex flex-col md:flex-row h-screen items-center justify-center">

        <div class="flex items-start w-[80rem] rounded-xl border border-gray-300 shadow-md">
            <div class="w-1/2 relative">
                <!-- Logo -->
                <slot name="logo"/>
            </div>

            <div class="w-1/2">
                <!-- Login form -->
                <slot name="form" />
            </div>
        </div>
    </div>
</template>
