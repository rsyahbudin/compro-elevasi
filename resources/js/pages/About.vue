<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';

interface TimelineItem {
    year: string;
    title: string;
    description: string;
}

interface Value {
    icon: string;
    title: string;
    description: string;
}

interface TeamMember {
    name: string;
    role: string;
    image: string;
}

defineProps<{
    about?: {
        about_section?: string;
        our_people_section?: string;
        the_journey_section?: string;
        the_blueprint_section?: string;
    };
    company: {
        name: string;
        established: string;
    };
    stats: {
        years: string;
        projects: string;
        awards: string;
    };
    timeline: TimelineItem[];
    values: Value[];
    team: TeamMember[];
}>();
</script>

<template>
    <MainLayout title="About Us">
        <!-- Hero Section -->
        <section
            class="mx-auto flex w-full max-w-[1440px] flex-col items-end gap-12 px-6 py-20 md:flex-row md:gap-20 md:px-10 md:py-32"
        >
            <div class="flex-1 space-y-8">
                <div
                    class="inline-flex items-center gap-2 rounded border border-primary/30 bg-primary/5 px-3 py-1 text-xs font-bold tracking-widest text-primary uppercase"
                >
                    <span class="material-symbols-outlined text-sm"
                        >auto_awesome</span
                    >
                    Manifesto
                </div>
                <h1
                    class="font-display text-5xl leading-[0.9] font-medium tracking-tighter text-gray-900 uppercase md:text-7xl lg:text-8xl"
                >
                    Building <br />
                    <span
                        class="bg-gradient-to-r from-gray-900 to-gray-400 bg-clip-text text-transparent"
                        >Beyond</span
                    >
                    <br />
                    <span class="block pl-12 text-primary md:pl-24"
                        >Structure</span
                    >
                </h1>
            </div>
            <div class="flex w-full flex-col gap-6 pb-2 md:w-1/3">
                <p class="text-lg leading-relaxed text-gray-600">
                    We don't just build walls; we craft environments that
                    inspire. Our mission is to bridge the gap between functional
                    construction and artistic expression, treating every
                    blueprint as a promise of quality.
                </p>
                <div class="h-[1px] w-full bg-gray-200"></div>
                <div class="flex items-center justify-between">
                    <span
                        class="text-xs tracking-widest text-gray-500 uppercase"
                        >Established {{ company.established }}</span
                    >
                    <span
                        class="text-xs tracking-widest text-gray-500 uppercase"
                        >Indonesia</span
                    >
                </div>
            </div>
        </section>

        <!-- Image Gallery -->
        <section class="mx-auto w-full max-w-[1440px] px-6 pb-24 md:px-10">
            <div
                class="grid h-auto grid-cols-1 gap-6 md:h-[600px] md:grid-cols-12"
            >
                <div
                    class="group relative h-[400px] overflow-hidden rounded md:col-span-7 md:h-full"
                >
                    <div
                        class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                        style="
                            background-image: url('https://images.unsplash.com/photo-1487958449943-2429e8be8625?q=80&w=2070&auto=format&fit=crop');
                        "
                    ></div>
                    <div
                        class="absolute inset-0 bg-black/10 transition-colors group-hover:bg-black/20"
                    ></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p
                            class="mb-1 text-xs font-bold tracking-widest uppercase"
                        >
                            Architecture
                        </p>
                        <p class="text-xl font-medium md:text-2xl">
                            Modernist Concrete Forms
                        </p>
                    </div>
                </div>
                <div class="flex h-full flex-col gap-6 md:col-span-5">
                    <div class="group relative flex-1 overflow-hidden rounded">
                        <div
                            class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                            style="
                                background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2076&auto=format&fit=crop');
                            "
                        ></div>
                        <div
                            class="absolute inset-0 bg-black/10 transition-colors group-hover:bg-black/20"
                        ></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p
                                class="mb-1 text-xs font-bold tracking-widest uppercase"
                            >
                                Planning
                            </p>
                            <p class="text-lg font-medium">
                                Precision Engineering
                            </p>
                        </div>
                    </div>
                    <Link
                        href="/projects"
                        class="group flex h-1/3 cursor-pointer flex-col justify-between rounded bg-primary p-8 shadow-lg shadow-primary/10 transition-colors hover:bg-[#1B5E20]"
                    >
                        <span
                            class="material-symbols-outlined text-4xl text-white"
                            >arrow_outward</span
                        >
                        <p
                            class="text-lg font-bold tracking-wider text-white uppercase"
                        >
                            View Our Portfolio
                        </p>
                    </Link>
                </div>
            </div>
        </section>

        <!-- Timeline Section -->
        <section
            v-if="about?.the_journey_section || timeline.length > 0"
            class="w-full bg-gray-50 py-24"
        >
            <div class="mx-auto max-w-[1000px] px-6 md:px-10">
                <div class="mb-16 flex items-end gap-4">
                    <h2
                        class="font-display text-4xl font-bold tracking-tight text-gray-900 uppercase md:text-5xl"
                    >
                        The Journey
                    </h2>
                    <div class="mb-2 h-[2px] flex-1 bg-gray-200"></div>
                    <span class="text-xl font-bold text-primary">02</span>
                </div>

                <div class="relative space-y-16 pl-8 md:pl-0">
                    <div
                        v-for="(item, index) in timeline"
                        :key="item.year"
                        class="relative grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-24"
                    >
                        <div
                            :class="[
                                index % 2 === 1
                                    ? 'md:order-2'
                                    : 'md:text-right',
                                'md:pt-4',
                            ]"
                        >
                            <span
                                class="relative z-0 -mb-4 block text-6xl font-bold text-gray-200 md:-mb-6 md:text-8xl"
                                >{{ item.year }}</span
                            >
                            <h3
                                class="relative z-10 text-2xl font-bold text-gray-900"
                            >
                                {{ item.title }}
                            </h3>
                        </div>
                        <div
                            :class="[
                                index % 2 === 1
                                    ? 'md:order-1 md:text-right'
                                    : '',
                                'pt-2 md:pt-12',
                            ]"
                        >
                            <p class="leading-relaxed text-gray-600">
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section
            v-if="about?.the_blueprint_section || values.length > 0"
            class="mx-auto w-full max-w-[1440px] bg-white px-6 py-24 md:px-10 md:py-32"
        >
            <div class="mb-16 flex items-end gap-4">
                <h2
                    class="font-display text-4xl font-bold tracking-tight text-gray-900 uppercase md:text-5xl"
                >
                    The Blueprint
                </h2>
                <div class="mb-2 h-[2px] flex-1 bg-gray-200"></div>
                <span class="text-xl font-bold text-primary">03</span>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div
                    v-for="value in values"
                    :key="value.title"
                    class="group rounded border border-gray-200 bg-white p-8 transition-colors hover:border-primary/50 hover:shadow-lg hover:shadow-gray-100"
                >
                    <div
                        class="mb-6 flex size-12 items-center justify-center rounded bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-white"
                    >
                        <span class="material-symbols-outlined text-2xl">{{
                            value.icon
                        }}</span>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900 uppercase">
                        {{ value.title }}
                    </h3>
                    <p class="text-sm leading-relaxed text-gray-600">
                        {{ value.description }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <!-- <section
            v-if="about?.our_people_section || team.length > 0"
            class="w-full bg-gray-50 py-24 text-gray-900"
        >
            <div class="mx-auto max-w-[1440px] px-6 md:px-10">
                <div
                    class="mb-16 flex flex-col justify-between gap-6 md:flex-row md:items-end"
                >
                    <div>
                        <div
                            class="mb-2 text-sm font-bold tracking-widest text-primary uppercase"
                        >
                            Our People
                        </div>
                        <h2
                            class="font-display text-4xl font-bold tracking-tight uppercase md:text-5xl"
                        >
                            The Architects
                        </h2>
                    </div>
                    <p class="max-w-md text-sm text-gray-500 md:text-right">
                        {{
                            about?.our_people_section ||
                            'A collective of visionaries, engineers, and artisans dedicated to the art of building.'
                        }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4 md:gap-6">
                    <div
                        v-for="(member, index) in team"
                        :key="member.name"
                        class="group relative aspect-[3/4] cursor-pointer overflow-hidden rounded"
                        :class="{ 'md:mt-12': index % 2 === 1 }"
                    >
                        <img
                            :src="member.image"
                            :alt="member.name"
                            class="absolute inset-0 h-full w-full object-cover grayscale filter transition-transform duration-500 group-hover:scale-110 group-hover:grayscale-0"
                        />
                        <div
                            class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-primary/90 to-transparent p-6 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                        >
                            <h4 class="text-xl font-bold text-white uppercase">
                                {{ member.name }}
                            </h4>
                            <p
                                class="text-xs tracking-widest text-white uppercase opacity-90"
                            >
                                {{ member.role }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- CTA Section -->
        <section
            class="relative flex w-full flex-col items-center justify-center overflow-hidden bg-white px-6 py-32 text-center"
        >
            <div class="pointer-events-none absolute inset-0 opacity-[0.03]">
                <div
                    class="h-full w-full bg-[linear-gradient(to_right,#000_1px,transparent_1px),linear-gradient(to_bottom,#000_1px,transparent_1px)] bg-[size:24px_24px]"
                ></div>
            </div>
            <h2
                class="relative z-10 mb-8 font-display text-5xl font-bold tracking-tight text-gray-900 uppercase md:text-7xl"
            >
                Ready to Build?
            </h2>
            <p class="relative z-10 mb-10 max-w-xl text-lg text-gray-600">
                Whether it's a commercial landmark or a residential masterpiece,
                we are ready to bring your vision to life.
            </p>
            <Link
                href="/contact"
                class="relative z-10 flex h-14 items-center justify-center rounded bg-primary px-10 text-sm font-bold tracking-[0.15em] text-white uppercase shadow-lg shadow-primary/20 transition-all hover:-translate-y-1 hover:bg-[#1B5E20] hover:shadow-primary/40"
            >
                Start Project Request
                <span class="material-symbols-outlined ml-2 text-lg"
                    >arrow_forward</span
                >
            </Link>
        </section>
    </MainLayout>
</template>
