<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import MainLayout from '@/layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineProps<{
    contact: {
        address: string;
        phone: string;
        email: string;
        whatsapp?: string;
        map_url?: string;
    };
}>();

const form = useForm({
    name: '',
    email: '',
    phone: '',
    location: '',
    message: '',
});

const submit = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <MainLayout title="Contact Us">
        <main class="flex flex-grow flex-col justify-center py-10 lg:py-16">
            <div class="mx-auto w-full max-w-[1280px] px-6 lg:px-10">
                <!-- Hero -->
                <div class="mb-16 lg:mb-24">
                    <h1
                        class="mb-6 max-w-3xl font-display text-5xl leading-tight font-bold tracking-tight text-gray-900 lg:text-7xl"
                    >
                        Let's Build <br />
                        <span class="text-primary">Something Unique</span>
                    </h1>
                    <p
                        class="max-w-2xl text-lg leading-relaxed font-normal text-gray-500 lg:text-xl"
                    >
                        Reach out to discuss your vision, schedule a
                        consultation, or inquire about our architectural
                        services. We are here to transform spaces.
                    </p>
                </div>

                <div class="flex flex-col gap-12 lg:flex-row lg:gap-24">
                    <!-- Contact Info -->
                    <div class="flex w-full flex-col gap-10 lg:w-1/3">
                        <div class="flex flex-col gap-8">
                            <div class="flex items-start gap-5">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10"
                                >
                                    <span
                                        class="material-symbols-outlined text-xl text-primary"
                                        >location_on</span
                                    >
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-lg font-bold text-gray-900">
                                        Visit Our Studio
                                    </h3>
                                    <p
                                        class="text-sm leading-relaxed text-gray-500"
                                    >
                                        {{ contact.address }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-5">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10"
                                >
                                    <span
                                        class="material-symbols-outlined text-xl text-primary"
                                        >call</span
                                    >
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-lg font-bold text-gray-900">
                                        Call Us
                                    </h3>
                                    <p
                                        class="text-sm leading-relaxed text-gray-500"
                                    >
                                        {{ contact.phone }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start gap-5">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10"
                                >
                                    <span
                                        class="material-symbols-outlined text-xl text-primary"
                                        >mail</span
                                    >
                                </div>
                                <div class="flex flex-col gap-1">
                                    <h3 class="text-lg font-bold text-gray-900">
                                        Email Us
                                    </h3>
                                    <p
                                        class="text-sm leading-relaxed text-gray-500"
                                    >
                                        {{ contact.email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Map -->
                        <div
                            v-if="contact.map_url"
                            class="h-64 w-full overflow-hidden rounded border border-gray-200 lg:h-80"
                        >
                            <iframe
                                :src="contact.map_url"
                                width="100%"
                                height="100%"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div
                        class="w-full rounded-xl border border-gray-200 bg-white p-6 shadow-sm lg:w-2/3 lg:p-10"
                    >
                        <h2 class="mb-8 text-2xl font-bold text-gray-900">
                            Send us a message
                        </h2>

                        <form
                            class="flex flex-col gap-6"
                            @submit.prevent="submit"
                        >
                            <div class="flex flex-col gap-6 md:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <Label
                                        for="name"
                                        class="text-xs font-medium tracking-wider text-gray-700 uppercase"
                                        >Name *</Label
                                    >
                                    <Input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Enter your full name"
                                        class="h-12 border-gray-300 focus:border-primary focus:ring-primary"
                                        required
                                    />
                                    <span
                                        v-if="form.errors.name"
                                        class="text-xs text-red-500"
                                        >{{ form.errors.name }}</span
                                    >
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <Label
                                        for="email"
                                        class="text-xs font-medium tracking-wider text-gray-700 uppercase"
                                        >Email Address *</Label
                                    >
                                    <Input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        placeholder="Enter your email"
                                        class="h-12 border-gray-300 focus:border-primary focus:ring-primary"
                                        required
                                    />
                                    <span
                                        v-if="form.errors.email"
                                        class="text-xs text-red-500"
                                        >{{ form.errors.email }}</span
                                    >
                                </div>
                            </div>

                            <div class="flex flex-col gap-6 md:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <Label
                                        for="phone"
                                        class="text-xs font-medium tracking-wider text-gray-700 uppercase"
                                        >Phone Number</Label
                                    >
                                    <Input
                                        id="phone"
                                        v-model="form.phone"
                                        type="tel"
                                        placeholder="Enter your phone number"
                                        class="h-12 border-gray-300 focus:border-primary focus:ring-primary"
                                    />
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <Label
                                        for="location"
                                        class="text-xs font-medium tracking-wider text-gray-700 uppercase"
                                        >Project Location</Label
                                    >
                                    <Input
                                        id="location"
                                        v-model="form.location"
                                        type="text"
                                        placeholder="City, Province"
                                        class="h-12 border-gray-300 focus:border-primary focus:ring-primary"
                                    />
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Label
                                    for="message"
                                    class="text-xs font-medium tracking-wider text-gray-700 uppercase"
                                    >Project Details *</Label
                                >
                                <Textarea
                                    id="message"
                                    v-model="form.message"
                                    placeholder="Tell us about your project, timeline, and vision..."
                                    rows="5"
                                    class="border-gray-300 focus:border-primary focus:ring-primary"
                                    required
                                />
                                <span
                                    v-if="form.errors.message"
                                    class="text-xs text-red-500"
                                    >{{ form.errors.message }}</span
                                >
                            </div>

                            <div class="pt-4">
                                <Button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="h-12 w-full gap-2 bg-primary px-8 font-bold text-white hover:bg-[#1B5E20] md:w-auto"
                                >
                                    <span>{{
                                        form.processing
                                            ? 'Sending...'
                                            : 'Send Message'
                                    }}</span>
                                    <span
                                        class="material-symbols-outlined text-sm"
                                        >arrow_forward</span
                                    >
                                </Button>
                            </div>

                            <p
                                v-if="$page.props.flash?.success"
                                class="mt-2 text-sm font-medium text-green-600"
                            >
                                {{ $page.props.flash.success }}
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </MainLayout>
</template>
