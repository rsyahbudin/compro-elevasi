<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

interface ProjectImage {
    id: number;
    image_path: string;
    alt_text: string | null;
}

interface Project {
    id: number;
    title: string;
    slug: string;
    location: string;
    completion_date: string;
    area: string | null;
    scope: string | null;
    description: string | null;
    featured_image: string | null;
    category: {
        name: string;
    };
    images: ProjectImage[];
}

interface NavProject {
    id: number;
    title: string;
    slug: string;
}

defineProps<{
    project: Project;
    previousProject: NavProject | null;
    nextProject: NavProject | null;
}>();

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
};
</script>

<template>
    <MainLayout :title="project.title">
        <main class="mx-auto flex w-full max-w-[1440px] flex-col bg-white">
            <!-- Hero Section -->
            <section class="flex flex-col px-4 pt-10 pb-6 md:px-10 lg:px-20">
                <div class="mb-8 flex flex-col gap-2">
                    <p
                        class="mb-2 text-xs font-bold tracking-widest text-primary uppercase"
                    >
                        {{ project.category?.name }}
                    </p>
                    <h1
                        class="font-display text-4xl leading-tight font-black tracking-[-0.033em] text-gray-900 md:text-5xl lg:text-6xl"
                    >
                        {{ project.title }}
                    </h1>
                </div>
                <div
                    class="group relative aspect-[16/9] w-full overflow-hidden rounded bg-cover bg-center bg-no-repeat md:aspect-[21/9]"
                    :style="{
                        backgroundImage: project.featured_image
                            ? `url('/storage/${project.featured_image}')`
                            : `url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop')`,
                    }"
                >
                    <div
                        class="absolute inset-0 bg-black/5 transition-all duration-700 group-hover:bg-transparent"
                    ></div>
                </div>
            </section>

            <!-- Content Section -->
            <section
                class="flex flex-col gap-12 px-4 py-10 md:px-10 lg:flex-row lg:px-20"
            >
                <!-- Sidebar -->
                <aside class="w-full shrink-0 lg:w-1/4">
                    <div
                        class="flex flex-col gap-8 border-l-2 border-primary/20 py-2 pl-6 lg:sticky lg:top-32"
                    >
                        <div class="flex flex-col gap-1">
                            <span
                                class="flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase"
                            >
                                <span class="material-symbols-outlined text-lg"
                                    >location_on</span
                                >
                                Location
                            </span>
                            <p class="text-base font-medium text-gray-900">
                                {{ project.location }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span
                                class="flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase"
                            >
                                <span class="material-symbols-outlined text-lg"
                                    >calendar_month</span
                                >
                                Completion
                            </span>
                            <p class="text-base font-medium text-gray-900">
                                {{ formatDate(project.completion_date) }}
                            </p>
                        </div>
                        <div v-if="project.area" class="flex flex-col gap-1">
                            <span
                                class="flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase"
                            >
                                <span class="material-symbols-outlined text-lg"
                                    >square_foot</span
                                >
                                Area
                            </span>
                            <p class="text-base font-medium text-gray-900">
                                {{ project.area }}
                            </p>
                        </div>
                        <div v-if="project.scope" class="flex flex-col gap-1">
                            <span
                                class="flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase"
                            >
                                <span class="material-symbols-outlined text-lg"
                                    >design_services</span
                                >
                                Scope
                            </span>
                            <p class="text-base font-medium text-gray-900">
                                {{ project.scope }}
                            </p>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-6">
                            <p class="mb-2 text-xs font-normal text-gray-500">
                                Interested in a similar project?
                            </p>
                            <Link
                                href="/contact"
                                class="inline-flex items-center gap-1 text-sm font-bold text-primary hover:text-primary/80"
                            >
                                Contact Us
                                <span class="material-symbols-outlined text-sm"
                                    >arrow_forward</span
                                >
                            </Link>
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="flex flex-1 flex-col gap-16">
                    <!-- Description -->
                    <article class="prose max-w-none lg:max-w-2xl">
                        <h3 class="mb-4 text-2xl font-bold text-gray-900">
                            Design Philosophy
                        </h3>
                        <div
                            class="space-y-6 text-lg leading-relaxed font-light text-gray-500"
                        >
                            <p
                                v-for="(paragraph, index) in (
                                    project.description || ''
                                ).split('\n\n')"
                                :key="index"
                            >
                                {{ paragraph }}
                            </p>
                        </div>
                    </article>

                    <!-- Gallery -->
                    <div
                        v-if="project.images && project.images.length > 0"
                        class="flex flex-col gap-4"
                    >
                        <h3 class="mb-2 text-xl font-bold text-gray-900">
                            Project Gallery
                        </h3>
                        <div
                            class="grid h-auto grid-cols-1 gap-4 md:h-[800px] md:grid-cols-2"
                        >
                            <div
                                v-for="(image, index) in project.images.slice(
                                    0,
                                    3,
                                )"
                                :key="image.id"
                                class="group relative min-h-[300px] overflow-hidden rounded"
                                :class="{ 'md:row-span-2': index === 0 }"
                            >
                                <div
                                    class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    :style="{
                                        backgroundImage: `url('/storage/${image.image_path}')`,
                                    }"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Default gallery placeholder if no images -->
                    <div v-else class="flex flex-col gap-4">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">
                            Project Gallery
                        </h3>
                        <div
                            class="grid h-auto grid-cols-1 gap-4 md:h-[800px] md:grid-cols-2"
                        >
                            <div
                                class="group relative min-h-[300px] overflow-hidden rounded md:row-span-2"
                            >
                                <div
                                    class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    style="
                                        background-image: url('https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?q=80&w=2070&auto=format&fit=crop');
                                    "
                                ></div>
                            </div>
                            <div
                                class="group relative min-h-[300px] overflow-hidden rounded"
                            >
                                <div
                                    class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    style="
                                        background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop');
                                    "
                                ></div>
                            </div>
                            <div
                                class="group relative min-h-[300px] overflow-hidden rounded"
                            >
                                <div
                                    class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                                    style="
                                        background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=2053&auto=format&fit=crop');
                                    "
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Navigation Section -->
            <section class="mt-20 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <Link
                        v-if="previousProject"
                        :href="`/projects/${previousProject.slug}`"
                        class="group relative flex flex-col items-start justify-center overflow-hidden border-b border-gray-200 p-10 transition-colors hover:bg-gray-50 md:border-r md:border-b-0"
                    >
                        <span
                            class="mb-2 flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase transition-transform group-hover:-translate-x-1"
                        >
                            <span class="material-symbols-outlined text-sm"
                                >arrow_back</span
                            >
                            Previous Project
                        </span>
                        <h4
                            class="text-2xl font-bold text-gray-900 transition-colors group-hover:text-primary"
                        >
                            {{ previousProject.title }}
                        </h4>
                        <div
                            class="absolute bottom-0 left-0 h-1 w-0 bg-primary transition-all duration-300 group-hover:w-full"
                        ></div>
                    </Link>
                    <div v-else class="hidden md:block"></div>

                    <Link
                        v-if="nextProject"
                        :href="`/projects/${nextProject.slug}`"
                        class="group relative flex flex-col items-end justify-center overflow-hidden p-10 transition-colors hover:bg-gray-50"
                    >
                        <span
                            class="mb-2 flex items-center gap-2 text-xs font-bold tracking-wider text-primary uppercase transition-transform group-hover:translate-x-1"
                        >
                            Next Project
                            <span class="material-symbols-outlined text-sm"
                                >arrow_forward</span
                            >
                        </span>
                        <h4
                            class="text-2xl font-bold text-gray-900 transition-colors group-hover:text-primary"
                        >
                            {{ nextProject.title }}
                        </h4>
                        <div
                            class="absolute right-0 bottom-0 h-1 w-0 bg-primary transition-all duration-300 group-hover:w-full"
                        ></div>
                    </Link>
                </div>
            </section>
        </main>
    </MainLayout>
</template>
