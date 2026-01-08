<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const logoWhite = computed(() => {
    const settings = (page.props as any).settings;
    return settings?.branding?.logo_white
        ? `/storage/${settings.branding.logo_white}`
        : null;
});

const companyName = computed(() => {
    const settings = (page.props as any).settings;
    return settings?.general?.company_name || 'Elevasi Design Build';
});

const contact = computed(() => {
    const settings = (page.props as any).settings;
    return {
        address:
            settings?.contact?.address ||
            'Jl. Arsitektur No. 123, Jakarta Selatan, Indonesia',
        phone: settings?.contact?.phone || '+62 21 555 0123',
        email: settings?.contact?.email || 'hello@elevasi.co.id',
    };
});

const social = computed(() => {
    const settings = (page.props as any).settings;
    return {
        instagram: settings?.social?.instagram || '#',
        twitter: settings?.social?.twitter || '#',
        linkedin: settings?.social?.linkedin || '#',
    };
});
</script>

<template>
    <footer
        class="border-t border-green-900/50 bg-surface-dark pt-20 pb-10 text-white"
    >
        <div class="mx-auto max-w-[1440px] px-4 sm:px-10">
            <div
                class="mb-16 grid grid-cols-1 gap-12 md:grid-cols-2 lg:grid-cols-4"
            >
                <!-- Company Info -->
                <div class="flex flex-col gap-6">
                    <Link href="/" class="flex items-center gap-2">
                        <template v-if="logoWhite">
                            <img
                                :src="logoWhite"
                                :alt="companyName"
                                class="h-12 w-auto object-contain"
                            />
                        </template>
                        <template v-else>
                            <span class="material-symbols-outlined text-3xl"
                                >architecture</span
                            >
                            <h2
                                class="font-display text-2xl font-bold tracking-tight uppercase"
                            >
                                Elevasi
                            </h2>
                        </template>
                    </Link>
                    <p class="text-sm leading-relaxed text-gray-300">
                        Crafting spaces that inspire, endure, and define the
                        future. Award-winning contractors specializing in luxury
                        residential and commercial projects.
                    </p>
                    <div class="mt-2 flex gap-4">
                        <a
                            :href="social.instagram"
                            class="text-gray-300 transition-colors hover:text-white"
                        >
                            <span class="sr-only">Instagram</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                />
                            </svg>
                        </a>
                        <a
                            :href="social.twitter"
                            class="text-gray-300 transition-colors hover:text-white"
                        >
                            <span class="sr-only">Twitter</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
                                />
                            </svg>
                        </a>
                        <a
                            :href="social.linkedin"
                            class="text-gray-300 transition-colors hover:text-white"
                        >
                            <span class="sr-only">LinkedIn</span>
                            <svg
                                class="h-6 w-6"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"
                                />
                                <rect height="12" width="4" x="2" y="9" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Company Links -->
                <div>
                    <h3 class="mb-6 text-lg font-bold">Company</h3>
                    <ul class="flex flex-col gap-4 text-sm text-gray-300">
                        <li>
                            <Link
                                href="/about"
                                class="transition-colors hover:text-white"
                                >About Us</Link
                            >
                        </li>
                        <li>
                            <Link
                                href="/projects"
                                class="transition-colors hover:text-white"
                                >Our Projects</Link
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="transition-colors hover:text-white"
                                >Careers</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="transition-colors hover:text-white"
                                >Awards</a
                            >
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="mb-6 text-lg font-bold">Contact</h3>
                    <ul class="flex flex-col gap-4 text-sm text-gray-300">
                        <li class="flex items-start gap-3">
                            <span
                                class="material-symbols-outlined mt-0.5 text-lg text-green-400"
                                >location_on</span
                            >
                            <span>{{ contact.address }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="material-symbols-outlined text-lg text-green-400"
                                >call</span
                            >
                            <span>{{ contact.phone }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="material-symbols-outlined text-lg text-green-400"
                                >mail</span
                            >
                            <span>{{ contact.email }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="mb-6 text-lg font-bold">Newsletter</h3>
                    <p class="mb-4 text-sm text-gray-300">
                        Subscribe for the latest architecture trends and project
                        updates.
                    </p>
                    <form class="flex flex-col gap-3">
                        <input
                            type="email"
                            placeholder="Your email address"
                            class="w-full rounded border border-white/20 bg-white/10 px-4 py-3 text-sm text-white transition-colors placeholder:text-gray-400 focus:border-green-400 focus:outline-none"
                        />
                        <button
                            type="button"
                            class="rounded bg-primary px-4 py-3 text-sm font-bold tracking-widest text-white uppercase transition-colors hover:bg-[#1B5E20]"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div
                class="flex flex-col items-center justify-between gap-4 border-t border-green-900/50 pt-8 text-xs text-gray-400 md:flex-row"
            >
                <p>
                    © {{ new Date().getFullYear() }} {{ companyName }}. All
                    rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="transition-colors hover:text-white"
                        >Privacy Policy</a
                    >
                    <a href="#" class="transition-colors hover:text-white"
                        >Terms of Service</a
                    >
                    <a href="#" class="transition-colors hover:text-white"
                        >Sitemap</a
                    >
                </div>
            </div>
        </div>
    </footer>
</template>
