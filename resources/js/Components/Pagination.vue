<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: Array
})

</script>

<template>
    <div>
        <Link href="#"
            :is="link.url ? 'Link' : 'span' "
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-1"
            :class="{ 'text-gray-500': ! link.url, 'font-bold text-xl text-black' : link.active}"
        />

    </div>
</template>
