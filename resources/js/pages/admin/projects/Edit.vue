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
import { Link, router, useForm } from '@inertiajs/vue3';
import { ArrowLeft, X } from 'lucide-vue-next';
import { computed, ref } from 'vue';

interface ProjectImage {
    id: number;
    image_path: string;
    alt_text: string | null;
}

const props = defineProps<{
    project: {
        id: number;
        title: string;
        slug: string;
        category_id: number;
        location: string;
        completion_date: string | null;
        area: string | null;
        scope: string | null;
        description: string | null;
        featured_image: string | null;
        is_featured: boolean | number;
        is_published: boolean | number;
        images: ProjectImage[];
    };
    categories: Array<{
        id: number;
        name: string;
    }>;
}>();

const form = useForm({
    title: props.project.title,
    category_id: String(props.project.category_id),
    location: props.project.location,
    completion_date: props.project.completion_date?.split('T')[0] || '',
    area: props.project.area || '',
    scope: props.project.scope || '',
    description: props.project.description || '',
    is_featured: props.project.is_featured ? 1 : 0,
    is_published: props.project.is_published ? 1 : 0,
    featured_image: null as File | null,
    images: [] as File[],
    _method: 'PUT',
});

const featuredImagePreview = ref<string | null>(
    props.project.featured_image
        ? `/storage/${props.project.featured_image}`
        : null,
);
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
            featuredImagePreview.value = props.project.featured_image
                ? `/storage/${props.project.featured_image}`
                : null;
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

const deleteImage = (imageId: number) => {
    if (confirm('Delete this image?')) {
        router.delete(`/admin/projects/${props.project.id}/images/${imageId}`, {
            preserveScroll: true,
        });
    }
};

const submit = () => {
    form.post(`/admin/projects/${props.project.id}`, {
        forceFormData: true,
    });
};
</script>

<template>
    <AdminLayout title="Edit Project">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Button variant="ghost" size="icon" as-child>
                    <Link href="/admin/projects">
                        <ArrowLeft class="size-4" />
                    </Link>
                </Button>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">
                        Edit Project
                    </h1>
                    <p class="text-muted-foreground">
                        Update project information
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
                                    Update the project information.
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
                                        v-if="
                                            slugPreview &&
                                            slugPreview !== project.slug
                                        "
                                        class="text-xs text-muted-foreground"
                                    >
                                        New URL slug:
                                        <span class="font-mono">{{
                                            slugPreview
                                        }}</span>
                                    </p>
                                    <p
                                        v-else-if="project.slug"
                                        class="text-xs text-muted-foreground"
                                    >
                                        Current slug:
                                        <span class="font-mono">{{
                                            project.slug
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
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <Label for="scope">Scope</Label>
                                        <Input
                                            id="scope"
                                            v-model="form.scope"
                                            type="text"
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

                                <!-- Existing Gallery -->
                                <div
                                    v-if="project.images.length"
                                    class="space-y-2"
                                >
                                    <Label>Current Gallery</Label>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div
                                            v-for="image in project.images"
                                            :key="image.id"
                                            class="group relative"
                                        >
                                            <img
                                                :src="`/storage/${image.image_path}`"
                                                class="h-24 w-full rounded object-cover"
                                            />
                                            <button
                                                type="button"
                                                class="absolute -top-2 -right-2 flex size-6 items-center justify-center rounded-full bg-destructive text-destructive-foreground opacity-0 transition-opacity group-hover:opacity-100"
                                                @click="deleteImage(image.id)"
                                            >
                                                <X class="size-4" />
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <Label>Add More Gallery Images</Label>
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
                                <div class="flex items-center justify-between">
                                    <Label for="is_published">Published</Label>
                                    <Switch
                                        :model-value="form.is_published === 1"
                                        @update:model-value="
                                            (val) =>
                                                (form.is_published = val
                                                    ? 1
                                                    : 0)
                                        "
                                    />
                                </div>
                                <div class="flex items-center justify-between">
                                    <Label for="is_featured"
                                        >Featured on Homepage</Label
                                    >
                                    <Switch
                                        :model-value="form.is_featured === 1"
                                        @update:model-value="
                                            (val) =>
                                                (form.is_featured = val ? 1 : 0)
                                        "
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
                                        ? 'Saving...'
                                        : 'Save Changes'
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
