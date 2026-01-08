<script setup lang="ts">
defineProps<{
    title: string;
    description: string;
    icon: string;
}>();
</script>

<template>
    <div class="flex gap-4">
        <div
            class="flex size-10 shrink-0 items-center justify-center rounded bg-primary/10 text-primary"
        >
            <span class="material-symbols-outlined">{{ icon }}</span>
        </div>
        <div>
            <h4 class="mb-2 text-xl font-bold text-gray-900">{{ title }}</h4>
            <p class="text-gray-500">{{ description }}</p>
        </div>
    </div>
</template>
