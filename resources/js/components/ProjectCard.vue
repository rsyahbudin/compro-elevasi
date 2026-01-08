<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    project: {
        id: number;
        title: string;
        slug: string;
        location: string;
        featured_image: string | null;
        category: {
            name: string;
        };
    };
    size?: 'default' | 'large';
    aspectRatio?: 'default' | 'portrait' | 'video' | 'square';
}>();

const aspectClasses = {
    default: 'aspect-[4/5] md:aspect-[3/4]',
    portrait: 'aspect-[3/4]',
    video: 'aspect-video',
    square: 'aspect-square md:aspect-[3/4]',
};

const sizeClasses = {
    default: 'text-xl',
    large: 'text-2xl',
};
</script>

<template>
    <Link :href="`/projects/${project.slug}`" class="group cursor-pointer">
        <div
            class="relative mb-6 overflow-hidden rounded shadow-md"
            :class="aspectClasses[aspectRatio || 'default']"
        >
            <div
                class="absolute inset-0 z-10 bg-black/10 transition-all duration-500 group-hover:bg-black/0"
            ></div>
            <div
                class="h-full w-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                :style="{
                    backgroundImage: project.featured_image
                        ? `url('/storage/${project.featured_image}')`
                        : `url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop')`,
                }"
            ></div>
            <div class="absolute right-6 bottom-6 z-20">
                <div
                    class="flex size-12 translate-y-4 items-center justify-center rounded-full bg-white text-primary opacity-0 shadow-lg transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100"
                >
                    <span class="material-symbols-outlined">arrow_outward</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <span
                class="text-xs font-bold tracking-widest text-primary uppercase"
                >{{ project.category?.name }}</span
            >
            <h4
                class="font-bold text-gray-900 transition-colors group-hover:text-primary"
                :class="sizeClasses[size || 'default']"
            >
                {{ project.title }}
            </h4>
            <p class="text-sm text-gray-500">{{ project.location }}</p>
        </div>
    </Link>
</template>
