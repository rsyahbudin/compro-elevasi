<script setup lang="ts">
import MainFooter from '@/components/MainFooter.vue';
import MainNavbar from '@/components/MainNavbar.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    title?: string;
}>();
</script>

<template>
    <Head :title="title" />
    <div
        class="relative flex min-h-screen w-full flex-col overflow-x-hidden bg-white font-body antialiased"
    >
        <MainNavbar />
        <main class="flex-1">
            <slot />
        </main>
        <MainFooter />
    </div>
</template>
