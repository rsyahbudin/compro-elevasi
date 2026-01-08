<script setup lang="ts">
import CategoryFilter from '@/components/CategoryFilter.vue';
import ProjectCard from '@/components/ProjectCard.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { Link, router } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
    slug: string;
}

interface Project {
    id: number;
    title: string;
    slug: string;
    location: string;
    featured_image: string | null;
    category: {
        name: string;
    };
}

interface PaginatedProjects {
    data: Project[];
    current_page: number;
    last_page: number;
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}

defineProps<{
    projects: PaginatedProjects;
    categories: Category[];
    activeCategory: string | null;
}>();

const selectCategory = (slug: string | null) => {
    router.get('/projects', slug ? { category: slug } : {}, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <MainLayout title="Projects">
        <!-- Hero Section -->
        <section
            class="relative flex w-full flex-col items-start justify-center bg-white px-6 py-24 md:px-16 lg:py-32"
        >
            <div
                class="relative z-10 flex w-full max-w-5xl flex-col items-start text-left"
            >
                <span
                    class="mb-6 inline-block text-xs font-bold tracking-[0.2em] text-primary uppercase"
                >
                    Portfolio 2024
                </span>
                <h1
                    class="mb-8 font-display text-6xl leading-none font-medium tracking-tight text-gray-900 md:text-8xl lg:text-9xl"
                >
                    Design <span class="font-light text-gray-400 italic">&</span
                    ><br />
                    <span class="ml-12 block text-primary md:ml-24"
                        >Build.</span
                    >
                </h1>
                <p
                    class="max-w-xl text-lg leading-relaxed font-light text-gray-500 md:text-xl"
                >
                    We craft architectural experiences that merge function with
                    unique design aesthetics. Exploring the intersection of
                    nature, structure, and human living.
                </p>
            </div>
        </section>

        <!-- Category Filter -->
        <section
            class="sticky top-[76px] z-40 w-full border-b border-gray-100 bg-white/95 px-6 py-6 backdrop-blur md:px-16"
        >
            <CategoryFilter
                :categories="categories"
                :active-category="activeCategory ?? undefined"
                @select="selectCategory"
            />
        </section>

        <!-- Projects Grid -->
        <section class="bg-white px-6 py-12 md:px-10 lg:px-16">
            <div
                class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-12"
            >
                <template
                    v-for="(project, index) in projects.data"
                    :key="project.id"
                >
                    <!-- Large card for first item -->
                    <div
                        v-if="index === 0"
                        class="col-span-1 md:col-span-2 lg:col-span-8"
                    >
                        <ProjectCard
                            :project="project"
                            size="large"
                            aspect-ratio="video"
                        />
                    </div>
                    <!-- Medium card for second item -->
                    <div
                        v-else-if="index === 1"
                        class="col-span-1 lg:col-span-4 lg:mt-24"
                    >
                        <ProjectCard
                            :project="project"
                            aspect-ratio="portrait"
                        />
                    </div>
                    <!-- Regular grid for remaining items -->
                    <div
                        v-else
                        class="col-span-1 lg:col-span-4"
                        :class="{ 'lg:mt-12': index % 3 === 0 }"
                    >
                        <ProjectCard
                            :project="project"
                            aspect-ratio="portrait"
                        />
                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div v-if="projects.data.length === 0" class="py-20 text-center">
                <span
                    class="material-symbols-outlined mb-4 text-6xl text-gray-300"
                    >folder_open</span
                >
                <h3 class="mb-2 text-xl font-bold text-gray-900">
                    No projects found
                </h3>
                <p class="text-gray-500">
                    Try selecting a different category or check back later.
                </p>
            </div>
        </section>

        <!-- Pagination -->
        <section
            v-if="projects.last_page > 1"
            class="flex w-full justify-center py-10 pb-32"
        >
            <div class="flex items-center gap-6">
                <Link
                    v-if="projects.current_page > 1"
                    :href="`/projects?page=${projects.current_page - 1}${activeCategory ? '&category=' + activeCategory : ''}`"
                    class="flex items-center justify-center text-gray-500 transition-colors hover:text-primary"
                >
                    <span class="material-symbols-outlined">west</span>
                    <span
                        class="ml-2 text-sm font-medium tracking-wider uppercase"
                        >Prev</span
                    >
                </Link>
                <div class="flex gap-2">
                    <template v-for="page in projects.last_page" :key="page">
                        <Link
                            :href="`/projects?page=${page}${activeCategory ? '&category=' + activeCategory : ''}`"
                            class="flex size-8 items-center justify-center rounded-sm text-xs font-bold transition-colors"
                            :class="
                                page === projects.current_page
                                    ? 'bg-primary text-white shadow-sm'
                                    : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900'
                            "
                        >
                            {{ page }}
                        </Link>
                    </template>
                </div>
                <Link
                    v-if="projects.current_page < projects.last_page"
                    :href="`/projects?page=${projects.current_page + 1}${activeCategory ? '&category=' + activeCategory : ''}`"
                    class="flex items-center justify-center text-gray-500 transition-colors hover:text-primary"
                >
                    <span
                        class="mr-2 text-sm font-medium tracking-wider uppercase"
                        >Next</span
                    >
                    <span class="material-symbols-outlined">east</span>
                </Link>
            </div>
        </section>
    </MainLayout>
</template>
