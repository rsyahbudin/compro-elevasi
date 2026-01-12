<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();

const isMobileMenuOpen = ref(false);

const navLinks = [
    // { name: 'Projects', href: '/projects' },
    { name: 'About', href: '/about' },
    { name: 'Contact', href: '/contact' },
];

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const logo = computed(() => {
    const settings = (page.props as any).settings;
    return settings?.branding?.logo
        ? `/storage/${settings.branding.logo}`
        : null;
});

const companyName = computed(() => {
    const settings = (page.props as any).settings;
    return settings?.general?.company_name || 'Elevasi Design Build';
});
</script>

<template>
    <nav
        class="sticky top-0 z-50 w-full border-b border-gray-100 bg-white/90 backdrop-blur-md transition-all duration-300"
    >
        <div class="mx-auto max-w-[1440px] px-4 sm:px-10">
            <div class="flex h-20 items-center justify-between">
                <!-- Logo -->
                <Link href="/" class="flex items-center gap-3">
                    <template v-if="logo">
                        <img
                            :src="logo"
                            :alt="companyName"
                            class="h-10 w-auto object-contain"
                        />
                        <span
                            class="font-display text-xl font-bold tracking-tight text-gray-900 uppercase"
                            >Elevasi Design Build</span
                        >
                    </template>
                    <template v-else>
                        <div
                            class="flex size-8 items-center justify-center text-primary"
                        >
                            <span class="material-symbols-outlined text-3xl"
                                >architecture</span
                            >
                        </div>
                        <h2
                            class="font-display text-xl font-bold tracking-tight text-gray-900 uppercase"
                        >
                            {{ companyName }}
                        </h2>
                    </template>
                </Link>

                <!-- Desktop Navigation -->
                <div
                    class="hidden flex-1 items-center justify-end gap-8 md:flex"
                >
                    <div class="flex items-center gap-8">
                        <Link
                            v-for="link in navLinks"
                            :key="link.name"
                            :href="link.href"
                            class="text-sm font-medium text-gray-900 transition-colors hover:text-primary"
                        >
                            {{ link.name }}
                        </Link>
                    </div>
                    <Link
                        href="/projects"
                        class="group flex items-center gap-2 rounded bg-primary px-6 py-2.5 text-sm font-bold text-white shadow-md shadow-green-900/10 transition-all duration-300 hover:bg-[#1B5E20]"
                    >
                        <span>Projects</span>
                        <span
                            class="material-symbols-outlined text-[16px] transition-transform group-hover:translate-x-1"
                            >arrow_forward</span
                        >
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <button
                    class="p-2 text-gray-900 md:hidden"
                    @click="toggleMobileMenu"
                >
                    <span class="material-symbols-outlined">{{
                        isMobileMenuOpen ? 'close' : 'menu'
                    }}</span>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div
                v-show="isMobileMenuOpen"
                class="border-t border-gray-100 pb-4 md:hidden"
            >
                <div class="flex flex-col gap-4 pt-4">
                    <Link
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        class="px-2 py-2 text-sm font-medium text-gray-900 transition-colors hover:text-primary"
                        @click="isMobileMenuOpen = false"
                    >
                        {{ link.name }}
                    </Link>
                    <Link
                        href="/contact"
                        class="mt-2 flex items-center justify-center gap-2 rounded bg-primary px-6 py-2.5 text-sm font-bold text-white"
                        @click="isMobileMenuOpen = false"
                    >
                        <span>Projects</span>
                        <span class="material-symbols-outlined text-[16px]"
                            >arrow_forward</span
                        >
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>
