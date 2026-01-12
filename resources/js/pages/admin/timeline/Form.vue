<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

interface TimelineItem {
    id: number;
    year: string;
    title: string;
    description: string;
    order: number;
}

const props = defineProps<{
    item: TimelineItem | null;
}>();

const form = useForm({
    year: props.item?.year || '',
    title: props.item?.title || '',
    description: props.item?.description || '',
    order: props.item?.order || 0,
});

const submit = () => {
    if (props.item) {
        form.put(`/admin/timeline/${props.item.id}`, {
            onSuccess: () => form.reset(),
        });
    } else {
        form.post('/admin/timeline', {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <AdminLayout :title="item ? 'Edit Timeline Item' : 'Add Timeline Item'">
        <div class="space-y-6">
            <div>
                <Link
                    href="/admin/timeline"
                    class="mb-2 inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                >
                    <span class="material-symbols-outlined mr-1 text-lg"
                        >arrow_back</span
                    >
                    Back to Timeline
                </Link>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ item ? 'Edit Timeline Item' : 'Add Timeline Item' }}
                </h1>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Timeline Information</CardTitle>
                </CardHeader>
                <CardContent>
                    <form class="space-y-6" @submit.prevent="submit">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <Label for="year">Year *</Label>
                                <Input
                                    id="year"
                                    v-model="form.year"
                                    type="text"
                                    placeholder="2024"
                                    required
                                />
                                <p
                                    v-if="form.errors.year"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.year }}
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
                        </div>

                        <div class="space-y-2">
                            <Label for="title">Title *</Label>
                            <Input
                                id="title"
                                v-model="form.title"
                                type="text"
                                placeholder="Expansion"
                                required
                            />
                            <p
                                v-if="form.errors.title"
                                class="text-sm text-red-600"
                            >
                                {{ form.errors.title }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <Label for="description">Description *</Label>
                            <Textarea
                                id="description"
                                v-model="form.description"
                                rows="4"
                                placeholder="Describe what happened in this year..."
                                required
                            />
                            <p
                                v-if="form.errors.description"
                                class="text-sm text-red-600"
                            >
                                {{ form.errors.description }}
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <Button type="submit" :disabled="form.processing">
                                {{ form.processing ? 'Saving...' : 'Save' }}
                            </Button>
                            <Link href="/admin/timeline">
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
