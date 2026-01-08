<script setup lang="ts">
import ProjectCard from '@/components/ProjectCard.vue';
import ServiceCard from '@/components/ServiceCard.vue';
import StatCard from '@/components/StatCard.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

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

defineProps<{
    featuredProjects: Project[];
    stats: {
        years: string;
        projects: string;
        awards: string;
    };
    hero: {
        title: string;
        subtitle: string;
    };
    company: {
        name: string;
        established: string;
    };
}>();

const services = [
    {
        icon: 'design_services',
        title: 'Design-Build',
        description:
            'Integrated project delivery that streamlines your construction process from initial concept to final handover.',
    },
    {
        icon: 'engineering',
        title: 'General Contracting',
        description:
            'Expert management of subcontractors, vendors, and materials to ensure quality and efficiency.',
    },
    {
        icon: 'handyman',
        title: 'Renovation & Restoration',
        description:
            'Breathing new life into existing structures while preserving their historical integrity.',
    },
];
</script>

<template>
    <MainLayout title="Home">
        <!-- Hero Section -->
        <header
            class="relative flex h-[calc(100vh-80px)] min-h-[600px] w-full items-center justify-center overflow-hidden"
        >
            <div class="absolute inset-0 z-0">
                <div
                    class="absolute inset-0 z-10 bg-gradient-to-t from-white via-transparent to-black/20"
                ></div>
                <div class="absolute inset-0 z-0 bg-black/20"></div>
                <div
                    class="h-full w-full scale-105 bg-cover bg-center bg-no-repeat"
                    style="
                        background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop');
                    "
                ></div>
            </div>
            <div
                class="relative z-20 container mx-auto flex flex-col items-center px-4 text-center sm:px-10"
            >
                <span
                    class="mb-6 inline-block rounded border border-white/40 bg-white/20 px-3 py-1 text-xs font-medium tracking-widest text-white uppercase shadow-sm backdrop-blur-sm"
                >
                    Established {{ company.established }}
                </span>
                <h1
                    class="mb-6 font-display text-5xl leading-[0.9] font-black tracking-tighter text-white drop-shadow-lg md:text-7xl lg:text-8xl"
                >
                    Building<br />
                    <span
                        class="bg-gradient-to-r from-white via-white to-white/70 bg-clip-text text-transparent"
                        >Tomorrow's Spaces</span
                    >
                </h1>
                <p
                    class="mb-10 max-w-xl text-lg leading-relaxed font-light text-white/90 drop-shadow-md md:text-xl"
                >
                    {{ hero.subtitle }}
                </p>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <Link
                        href="/projects"
                        class="flex h-12 items-center justify-center gap-2 rounded bg-primary px-8 text-base font-bold text-white shadow-lg shadow-green-900/20 transition-colors hover:bg-[#1B5E20]"
                    >
                        View Projects
                    </Link>
                    <button
                        class="flex h-12 items-center justify-center gap-2 rounded border border-white/40 bg-white/20 px-8 text-base font-medium text-white shadow-lg backdrop-blur-md transition-colors hover:bg-white/30"
                    >
                        <span class="material-symbols-outlined text-[20px]"
                            >play_circle</span
                        >
                        Watch Reel
                    </button>
                </div>
            </div>
            <div
                class="absolute bottom-10 left-1/2 flex -translate-x-1/2 animate-bounce flex-col items-center gap-2 opacity-80"
            >
                <span class="text-xs tracking-widest text-gray-900/60 uppercase"
                    >Scroll</span
                >
                <span class="material-symbols-outlined text-gray-900/60"
                    >keyboard_arrow_down</span
                >
            </div>
        </header>

        <!-- Philosophy Section -->
        <section id="about" class="bg-white px-4 py-24 sm:px-10">
            <div class="mx-auto flex max-w-[960px] flex-col gap-6 text-center">
                <div
                    class="flex items-center justify-center gap-2 text-primary"
                >
                    <span class="material-symbols-outlined text-sm">star</span>
                    <span class="text-sm font-bold tracking-widest uppercase"
                        >Our Philosophy</span
                    >
                    <span class="material-symbols-outlined text-sm">star</span>
                </div>
                <h2
                    class="font-display text-4xl leading-tight font-bold tracking-tight text-gray-900 md:text-6xl"
                >
                    Precision. Craftsmanship.
                    <span class="text-primary">Legacy.</span>
                </h2>
                <div class="mx-auto my-2 h-1 w-24 bg-primary"></div>
                <p
                    class="mx-auto max-w-2xl text-lg leading-relaxed font-normal text-gray-500 md:text-xl"
                >
                    We don't just build structures; we craft environments. Our
                    philosophy is rooted in a deep respect for materials and a
                    commitment to sustainable, timeless design that withstands
                    the test of time.
                </p>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="border-y border-gray-100 bg-white py-12">
            <div class="mx-auto max-w-[1200px] px-4 sm:px-10">
                <div
                    class="grid grid-cols-1 divide-y divide-gray-100 text-center md:grid-cols-3 md:divide-x md:divide-y-0"
                >
                    <StatCard
                        :value="stats.years + '+'"
                        label="Years in Business"
                        icon="history"
                    />
                    <StatCard
                        :value="stats.projects + '+'"
                        label="Projects Completed"
                        icon="foundation"
                    />
                    <StatCard
                        :value="stats.awards"
                        label="Design Awards"
                        icon="trophy"
                    />
                </div>
            </div>
        </section>

        <!-- Featured Projects Section -->
        <section id="projects" class="bg-[#f1f8f4] px-4 py-24 sm:px-10">
            <div class="mx-auto max-w-[1440px]">
                <div
                    class="mb-16 flex flex-col justify-between gap-6 md:flex-row md:items-end"
                >
                    <div>
                        <span
                            class="mb-2 block text-sm font-bold tracking-widest text-primary uppercase"
                            >Selected Works</span
                        >
                        <h3
                            class="font-display text-4xl font-bold text-gray-900 md:text-5xl"
                        >
                            Featured Projects
                        </h3>
                    </div>
                    <Link
                        href="/projects"
                        class="group flex items-center gap-2 font-bold text-gray-900 transition-colors hover:text-primary"
                    >
                        <span>View All Projects</span>
                        <span
                            class="material-symbols-outlined transition-transform group-hover:translate-x-1"
                            >arrow_forward</span
                        >
                    </Link>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:gap-16">
                    <div class="flex flex-col gap-8 lg:gap-16">
                        <ProjectCard
                            v-if="featuredProjects[0]"
                            :project="featuredProjects[0]"
                            size="large"
                            aspect-ratio="default"
                        />
                        <ProjectCard
                            v-if="featuredProjects[1]"
                            :project="featuredProjects[1]"
                            aspect-ratio="video"
                        />
                    </div>
                    <div class="flex flex-col gap-8 md:mt-24 lg:gap-16">
                        <ProjectCard
                            v-if="featuredProjects[2]"
                            :project="featuredProjects[2]"
                            aspect-ratio="square"
                        />
                        <ProjectCard
                            v-if="featuredProjects[3]"
                            :project="featuredProjects[3]"
                            aspect-ratio="video"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Services/Expertise Section -->
        <section class="border-t border-gray-100 bg-white py-24">
            <div class="mx-auto max-w-[1440px] px-4 sm:px-10">
                <div
                    class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2"
                >
                    <div>
                        <span
                            class="mb-4 block text-sm font-bold tracking-widest text-primary uppercase"
                            >Our Expertise</span
                        >
                        <h3
                            class="mb-8 font-display text-4xl font-bold text-gray-900 md:text-5xl"
                        >
                            Comprehensive Construction Solutions
                        </h3>
                        <div class="space-y-6">
                            <ServiceCard
                                v-for="service in services"
                                :key="service.title"
                                :icon="service.icon"
                                :title="service.title"
                                :description="service.description"
                            />
                        </div>
                    </div>
                    <div
                        class="relative h-[600px] overflow-hidden rounded shadow-xl"
                    >
                        <div
                            class="absolute inset-0 bg-cover bg-center"
                            style="
                                background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2076&auto=format&fit=crop');
                            "
                        ></div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"
                        ></div>
                        <div class="absolute right-8 bottom-8 left-8">
                            <div
                                class="rounded border border-white/40 bg-white/90 p-6 shadow-lg backdrop-blur-md"
                            >
                                <p class="text-lg text-gray-900 italic">
                                    "Elevasi Design Build transformed our vision
                                    into reality with unmatched precision. Their
                                    attention to detail is simply
                                    extraordinary."
                                </p>
                                <div class="mt-4 flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-full bg-gray-300 bg-cover"
                                        style="
                                            background-image: url('https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100');
                                        "
                                    ></div>
                                    <div>
                                        <p
                                            class="text-sm font-bold text-gray-900"
                                        >
                                            Budi Santoso
                                        </p>
                                        <p
                                            class="text-xs tracking-wide text-gray-500 uppercase"
                                        >
                                            CEO, Apex Corp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section
            id="contact"
            class="relative overflow-hidden bg-primary px-4 py-32 text-white sm:px-10"
        >
            <div
                class="absolute top-0 right-0 -mt-20 -mr-20 size-96 rounded-full bg-white/10 blur-3xl"
            ></div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 size-80 rounded-full bg-black/10 blur-3xl"
            ></div>
            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <h2 class="mb-8 font-display text-4xl font-bold md:text-6xl">
                    Ready to start your project?
                </h2>
                <p class="mb-12 text-xl font-light text-green-100 md:text-2xl">
                    Let's discuss how we can bring your architectural vision to
                    life.
                </p>
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <Link
                        href="/contact"
                        class="flex h-14 items-center justify-center rounded bg-white px-10 text-lg font-bold text-primary shadow-lg transition-colors hover:bg-gray-100"
                    >
                        Get a Free Quote
                    </Link>
                    <Link
                        href="/contact"
                        class="flex h-14 items-center justify-center rounded border border-white bg-transparent px-10 text-lg font-bold text-white transition-colors hover:bg-white/10"
                    >
                        Contact Us
                    </Link>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
