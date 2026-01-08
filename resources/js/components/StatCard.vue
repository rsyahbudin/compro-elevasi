<script setup lang="ts">
defineProps<{
    value: string | number;
    label: string;
    icon?: string;
}>();
</script>

<template>
    <div class="flex flex-col items-center gap-2 p-4">
        <span
            v-if="icon"
            class="material-symbols-outlined mb-2 text-4xl text-primary opacity-80"
            >{{ icon }}</span
        >
        <p
            class="font-display text-4xl font-bold tracking-tight text-gray-900 md:text-5xl"
        >
            {{ value }}
        </p>
        <p
            class="text-sm font-semibold tracking-widest text-gray-500 uppercase"
        >
            {{ label }}
        </p>
    </div>
</template>
