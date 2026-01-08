<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Switch } from '@/components/ui/switch';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const props = defineProps<{
    categories: Array<{
        id: number;
        name: string;
    }>;
}>();

const form = useForm({
    title: '',
    category_id: '',
    location: '',
    completion_date: '',
    area: '',
    scope: '',
    description: '',
    is_featured: false,
    is_published: true,
    featured_image: null as File | null,
    images: [] as File[],
});

const featuredImagePreview = ref<string | null>(null);
const galleryPreviews = ref<string[]>([]);
const imageError = ref<string | null>(null);

// Computed slug preview
const slugPreview = computed(() => {
    if (!form.title) return '';
    return form.title
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
});

const validateImage = (file: File, maxSizeMB: number = 5): string | null => {
    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

    if (!validTypes.includes(file.type)) {
        return 'Please select a valid image file (JPEG, PNG, JPG, or WebP).';
    }

    const maxSizeBytes = maxSizeMB * 1024 * 1024;
    if (file.size > maxSizeBytes) {
        return `Image size must not exceed ${maxSizeMB}MB.`;
    }

    return null;
};

const handleFeaturedImage = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const error = validateImage(target.files[0]);
        if (error) {
            imageError.value = error;
            form.featured_image = null;
            featuredImagePreview.value = null;
            target.value = '';
            return;
        }

        imageError.value = null;
        form.featured_image = target.files[0];
        featuredImagePreview.value = URL.createObjectURL(target.files[0]);
    }
};

const handleGalleryImages = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files) {
        const files = Array.from(target.files);

        for (const file of files) {
            const error = validateImage(file);
            if (error) {
                imageError.value = error;
                form.images = [];
                galleryPreviews.value = [];
                target.value = '';
                return;
            }
        }

        imageError.value = null;
        form.images = files;
        galleryPreviews.value = form.images.map((file) =>
            URL.createObjectURL(file),
        );
    }
};

const submit = () => {
    form.post('/admin/projects', {
        forceFormData: true,
    });
};
</script>

<template>
    <AdminLayout title="Create Project">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Button variant="ghost" size="icon" as-child>
                    <Link href="/admin/projects">
                        <ArrowLeft class="size-4" />
                    </Link>
                </Button>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">
                        Create Project
                    </h1>
                    <p class="text-muted-foreground">
                        Add a new project to your portfolio
                    </p>
                </div>
            </div>

            <form @submit.prevent="submit">
                <div class="grid gap-6 lg:grid-cols-3">
                    <!-- Main Content -->
                    <div class="space-y-6 lg:col-span-2">
                        <Card>
                            <CardHeader>
                                <CardTitle>Project Details</CardTitle>
                                <CardDescription>
                                    Fill in the project information.
                                </CardDescription>
                            </CardHeader>
                            <CardContent class="space-y-6">
                                <div class="space-y-2">
                                    <Label for="title">Title *</Label>
                                    <Input
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                    />
                                    <p
                                        v-if="form.errors.title"
                                        class="text-sm text-destructive"
                                    >
                                        {{ form.errors.title }}
                                    </p>
                                    <p
                                        v-if="slugPreview"
                                        class="text-xs text-muted-foreground"
                                    >
                                        URL slug:
                                        <span class="font-mono">{{
                                            slugPreview
                                        }}</span>
                                    </p>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div class="space-y-2">
                                        <Label for="category">Category *</Label>
                                        <Select v-model="form.category_id">
                                            <SelectTrigger>
                                                <SelectValue
                                                    placeholder="Select category"
                                                />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem
                                                    v-for="category in categories"
                                                    :key="category.id"
                                                    :value="String(category.id)"
                                                >
                                                    {{ category.name }}
                                                </SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>
                                    <div class="space-y-2">
                                        <Label for="location">Location *</Label>
                                        <Input
                                            id="location"
                                            v-model="form.location"
                                            type="text"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div class="space-y-2">
                                        <Label for="completion_date"
                                            >Completion Date</Label
                                        >
                                        <Input
                                            id="completion_date"
                                            v-model="form.completion_date"
                                            type="date"
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <Label for="area">Area</Label>
                                        <Input
                                            id="area"
                                            v-model="form.area"
                                            type="text"
                                            placeholder="e.g., 450 sqm"
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <Label for="scope">Scope</Label>
                                        <Input
                                            id="scope"
                                            v-model="form.scope"
                                            type="text"
                                            placeholder="e.g., Full Construction"
                                        />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <Label for="description">Description</Label>
                                    <Textarea
                                        id="description"
                                        v-model="form.description"
                                        rows="6"
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Images -->
                        <Card>
                            <CardHeader>
                                <CardTitle>Images</CardTitle>
                                <CardDescription>
                                    Upload project images.
                                </CardDescription>
                            </CardHeader>
                            <CardContent class="space-y-6">
                                <p
                                    v-if="imageError"
                                    class="text-sm text-destructive"
                                >
                                    {{ imageError }}
                                </p>

                                <div class="space-y-2">
                                    <Label>Featured Image</Label>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        class="block w-full text-sm text-muted-foreground file:mr-4 file:rounded file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-medium file:text-primary-foreground hover:file:bg-primary/90"
                                        @change="handleFeaturedImage"
                                    />
                                    <div
                                        v-if="featuredImagePreview"
                                        class="mt-4"
                                    >
                                        <img
                                            :src="featuredImagePreview"
                                            alt="Preview"
                                            class="h-48 rounded object-cover"
                                        />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <Label>Gallery Images</Label>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        multiple
                                        class="block w-full text-sm text-muted-foreground file:mr-4 file:rounded file:border-0 file:bg-secondary file:px-4 file:py-2 file:text-sm file:font-medium file:text-secondary-foreground hover:file:bg-secondary/80"
                                        @change="handleGalleryImages"
                                    />
                                    <div
                                        v-if="galleryPreviews.length"
                                        class="mt-4 grid grid-cols-4 gap-4"
                                    >
                                        <img
                                            v-for="(
                                                preview, index
                                            ) in galleryPreviews"
                                            :key="index"
                                            :src="preview"
                                            alt="Gallery preview"
                                            class="h-24 w-full rounded object-cover"
                                        />
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle>Publish Settings</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-6">
                                <!-- Published -->
                                <div class="flex items-center justify-between">
                                    <Label>Published</Label>
                                    <Switch
                                        v-model:checked="form.is_published"
                                    />
                                </div>

                                <!-- Featured -->
                                <div class="flex items-center justify-between">
                                    <Label>Featured on Homepage</Label>
                                    <Switch
                                        v-model:checked="form.is_featured"
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        <div class="flex flex-col gap-3">
                            <Button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full"
                            >
                                {{
                                    form.processing
                                        ? 'Creating...'
                                        : 'Create Project'
                                }}
                            </Button>
                            <Button variant="outline" as-child class="w-full">
                                <Link href="/admin/projects">Cancel</Link>
                            </Button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
