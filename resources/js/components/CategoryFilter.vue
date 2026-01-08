<script setup lang="ts">
const props = defineProps<{
    categories: Array<{
        id: number;
        name: string;
        slug: string;
    }>;
    activeCategory?: string;
}>();

const emit = defineEmits<{
    (e: 'select', slug: string | null): void;
}>();
</script>

<template>
    <div
        class="no-scrollbar flex flex-wrap items-center justify-start gap-3 overflow-x-auto pb-2 md:gap-4 md:pb-0"
    >
        <button
            class="rounded-sm px-6 py-2 text-xs font-bold tracking-wider uppercase transition-all"
            :class="
                !activeCategory
                    ? 'bg-primary text-white hover:bg-[#1B5E20]'
                    : 'border border-gray-200 bg-transparent text-gray-500 hover:border-primary hover:bg-primary/5 hover:text-primary'
            "
            @click="emit('select', null)"
        >
            All
        </button>
        <button
            v-for="category in categories"
            :key="category.id"
            class="rounded-sm px-6 py-2 text-xs font-bold tracking-wider uppercase transition-all"
            :class="
                activeCategory === category.slug
                    ? 'bg-primary text-white hover:bg-[#1B5E20]'
                    : 'border border-gray-200 bg-transparent text-gray-500 hover:border-primary hover:bg-primary/5 hover:text-primary'
            "
            @click="emit('select', category.slug)"
        >
            {{ category.name }}
        </button>
    </div>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
