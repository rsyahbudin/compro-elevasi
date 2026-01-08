<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Settings {
    general: Record<string, string>;
    contact: Record<string, string>;
    social: Record<string, string>;
    stats: Record<string, string>;
    hero: Record<string, string>;
    branding: Record<string, string>;
}

const props = defineProps<{
    settings: Settings;
}>();

const form = useForm({
    // General
    company_name: props.settings.general?.company_name || '',
    company_tagline: props.settings.general?.company_tagline || '',
    company_description: props.settings.general?.company_description || '',
    established_year: props.settings.general?.established_year || '',

    // Contact
    address: props.settings.contact?.address || '',
    phone: props.settings.contact?.phone || '',
    email: props.settings.contact?.email || '',
    whatsapp: props.settings.contact?.whatsapp || '',

    // Social
    instagram: props.settings.social?.instagram || '',
    linkedin: props.settings.social?.linkedin || '',
    twitter: props.settings.social?.twitter || '',

    // Stats
    years_in_business: props.settings.stats?.years_in_business || '',
    projects_completed: props.settings.stats?.projects_completed || '',
    design_awards: props.settings.stats?.design_awards || '',

    // Hero
    hero_title: props.settings.hero?.hero_title || '',
    hero_subtitle: props.settings.hero?.hero_subtitle || '',

    // Branding
    logo: null as File | null,
    logo_white: null as File | null,
});

const logoPreview = ref<string | null>(
    props.settings.branding?.logo
        ? `/storage/${props.settings.branding.logo}`
        : null,
);
const logoWhitePreview = ref<string | null>(
    props.settings.branding?.logo_white
        ? `/storage/${props.settings.branding.logo_white}`
        : null,
);

const handleLogoUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.logo = target.files[0];
        logoPreview.value = URL.createObjectURL(target.files[0]);
    }
};

const handleLogoWhiteUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        form.logo_white = target.files[0];
        logoWhitePreview.value = URL.createObjectURL(target.files[0]);
    }
};

const submit = () => {
    form.post('/admin/settings', {
        forceFormData: true,
    });
};
</script>

<template>
    <AdminLayout title="Settings">
        <div class="space-y-6">
            <h1 class="text-2xl font-bold text-gray-900">Company Settings</h1>

            <form class="space-y-6" @submit.prevent="submit">
                <!-- Branding Settings -->
                <Card>
                    <CardHeader>
                        <CardTitle>Branding & Logo</CardTitle>
                    </CardHeader>
                    <CardContent class="grid gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <Label>Logo (Dark Version)</Label>
                            <p class="text-xs text-gray-500">
                                Used on light backgrounds
                            </p>
                            <input
                                type="file"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:rounded file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-[#1B5E20]"
                                @change="handleLogoUpload"
                            />
                            <div
                                v-if="logoPreview"
                                class="mt-4 rounded-lg border border-gray-200 bg-white p-4"
                            >
                                <img
                                    :src="logoPreview"
                                    alt="Logo Preview"
                                    class="h-16 object-contain"
                                />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <Label>Logo (Light Version)</Label>
                            <p class="text-xs text-gray-500">
                                Used on dark backgrounds
                            </p>
                            <input
                                type="file"
                                accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:rounded file:border-0 file:bg-gray-700 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-gray-600"
                                @change="handleLogoWhiteUpload"
                            />
                            <div
                                v-if="logoWhitePreview"
                                class="mt-4 rounded-lg border border-gray-700 bg-gray-800 p-4"
                            >
                                <img
                                    :src="logoWhitePreview"
                                    alt="Logo White Preview"
                                    class="h-16 object-contain"
                                />
                            </div>
                        </div>
                    </CardContent>
                </Card>

                <!-- General Settings -->
                <Card>
                    <CardHeader>
                        <CardTitle>General Information</CardTitle>
                    </CardHeader>
                    <CardContent class="grid gap-6 sm:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="company_name">Company Name</Label>
                            <Input
                                id="company_name"
                                v-model="form.company_name"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="established_year"
                                >Established Year</Label
                            >
                            <Input
                                id="established_year"
                                v-model="form.established_year"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <Label for="company_tagline">Tagline</Label>
                            <Input
                                id="company_tagline"
                                v-model="form.company_tagline"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <Label for="company_description">Description</Label>
                            <Textarea
                                id="company_description"
                                v-model="form.company_description"
                                rows="3"
                            />
                        </div>
                    </CardContent>
                </Card>

                <!-- Contact Settings -->
                <Card>
                    <CardHeader>
                        <CardTitle>Contact Information</CardTitle>
                    </CardHeader>
                    <CardContent class="grid gap-6 sm:grid-cols-2">
                        <div class="space-y-2 sm:col-span-2">
                            <Label for="address">Address</Label>
                            <Textarea
                                id="address"
                                v-model="form.address"
                                rows="2"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="phone">Phone</Label>
                            <Input
                                id="phone"
                                v-model="form.phone"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="whatsapp">WhatsApp</Label>
                            <Input
                                id="whatsapp"
                                v-model="form.whatsapp"
                                type="text"
                                placeholder="+6281234567890"
                            />
                        </div>
                    </CardContent>
                </Card>

                <!-- Social Media -->
                <Card>
                    <CardHeader>
                        <CardTitle>Social Media</CardTitle>
                    </CardHeader>
                    <CardContent class="grid gap-6 sm:grid-cols-3">
                        <div class="space-y-2">
                            <Label for="instagram">Instagram URL</Label>
                            <Input
                                id="instagram"
                                v-model="form.instagram"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="linkedin">LinkedIn URL</Label>
                            <Input
                                id="linkedin"
                                v-model="form.linkedin"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="twitter">Twitter URL</Label>
                            <Input
                                id="twitter"
                                v-model="form.twitter"
                                type="text"
                            />
                        </div>
                    </CardContent>
                </Card>

                <!-- Stats -->
                <Card>
                    <CardHeader>
                        <CardTitle>Homepage Statistics</CardTitle>
                    </CardHeader>
                    <CardContent class="grid gap-6 sm:grid-cols-3">
                        <div class="space-y-2">
                            <Label for="years_in_business"
                                >Years in Business</Label
                            >
                            <Input
                                id="years_in_business"
                                v-model="form.years_in_business"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="projects_completed"
                                >Projects Completed</Label
                            >
                            <Input
                                id="projects_completed"
                                v-model="form.projects_completed"
                                type="text"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="design_awards">Design Awards</Label>
                            <Input
                                id="design_awards"
                                v-model="form.design_awards"
                                type="text"
                            />
                        </div>
                    </CardContent>
                </Card>

                <!-- Hero Section -->
                <Card>
                    <CardHeader>
                        <CardTitle>Hero Section</CardTitle>
                    </CardHeader>
                    <CardContent class="space-y-6">
                        <div class="space-y-2">
                            <Label for="hero_title">Hero Title</Label>
                            <Textarea
                                id="hero_title"
                                v-model="form.hero_title"
                                rows="2"
                            />
                        </div>
                        <div class="space-y-2">
                            <Label for="hero_subtitle">Hero Subtitle</Label>
                            <Textarea
                                id="hero_subtitle"
                                v-model="form.hero_subtitle"
                                rows="3"
                            />
                        </div>
                    </CardContent>
                </Card>

                <div class="flex justify-end">
                    <Button
                        type="submit"
                        :disabled="form.processing"
                        class="bg-primary hover:bg-[#1B5E20]"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Settings' }}
                    </Button>
                </div>

                <p
                    v-if="$page.props.flash?.success"
                    class="text-sm font-medium text-green-600"
                >
                    {{ $page.props.flash.success }}
                </p>
            </form>
        </div>
    </AdminLayout>
</template>
