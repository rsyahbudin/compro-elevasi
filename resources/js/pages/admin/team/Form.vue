<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Switch } from '@/components/ui/switch';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface TeamMember {
    id: number;
    name: string;
    role: string;
    photo: string | null;
    order: number;
    is_active: boolean;
}

const props = defineProps<{
    member: TeamMember | null;
}>();

const form = useForm({
    name: props.member?.name || '',
    role: props.member?.role || '',
    photo: null as File | null,
    order: props.member?.order || 0,
    is_active: props.member ? Boolean(props.member.is_active) : true,
});

const photoPreview = ref<string | null>(
    props.member?.photo
        ? props.member.photo.startsWith('http')
            ? props.member.photo
            : `/storage/${props.member.photo}`
        : null,
);

const handlePhotoUpload = (event: Event) => {
    const file = (event.target as HTMLInputElement).files?.[0];
    if (file) {
        form.photo = file;
        photoPreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    if (props.member) {
        // For updates, use PUT with _method spoofing
        form.transform((data) => ({
            ...data,
            _method: 'PUT',
        })).post(`/admin/team/${props.member.id}`, {
            forceFormData: true,
            onSuccess: () => form.reset(),
        });
    } else {
        form.post('/admin/team', {
            forceFormData: true,
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <AdminLayout :title="member ? 'Edit Team Member' : 'Add Team Member'">
        <div class="space-y-6">
            <div>
                <Link
                    href="/admin/team"
                    class="mb-2 inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                >
                    <span class="material-symbols-outlined mr-1 text-lg"
                        >arrow_back</span
                    >
                    Back to Team
                </Link>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ member ? 'Edit Team Member' : 'Add Team Member' }}
                </h1>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Team Member Information</CardTitle>
                </CardHeader>
                <CardContent>
                    <form class="space-y-6" @submit.prevent="submit">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <Label for="name">Name *</Label>
                                <Input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    required
                                />
                                <p
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <Label for="role">Role *</Label>
                                <Input
                                    id="role"
                                    v-model="form.role"
                                    type="text"
                                    required
                                />
                                <p
                                    v-if="form.errors.role"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.role }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <Label for="order">Order</Label>
                                <Input
                                    id="order"
                                    v-model.number="form.order"
                                    type="number"
                                    min="0"
                                />
                                <p class="text-xs text-gray-500">
                                    Lower numbers appear first
                                </p>
                            </div>

                            <div class="flex items-center space-x-2">
                                <Switch
                                    id="is_active"
                                    :checked="form.is_active"
                                    @update:checked="form.is_active = $event"
                                />
                                <Label for="is_active">Active</Label>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <Label for="photo">Photo</Label>
                            <Input
                                id="photo"
                                type="file"
                                accept="image/*"
                                @change="handlePhotoUpload"
                            />
                            <p class="text-xs text-gray-500">Max size: 2MB</p>
                            <div v-if="photoPreview" class="mt-4">
                                <img
                                    :src="photoPreview"
                                    alt="Photo preview"
                                    class="h-32 w-32 rounded-lg object-cover"
                                />
                            </div>
                            <p
                                v-if="form.errors.photo"
                                class="text-sm text-red-600"
                            >
                                {{ form.errors.photo }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <Button type="submit" :disabled="form.processing">
                                {{ form.processing ? 'Saving...' : 'Save' }}
                            </Button>
                            <Link href="/admin/team">
                                <Button type="button" variant="outline"
                                    >Cancel</Button
                                >
                            </Link>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
