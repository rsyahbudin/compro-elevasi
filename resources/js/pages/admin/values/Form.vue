<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

interface CompanyValue {
    id: number;
    icon: string;
    title: string;
    description: string;
    order: number;
}

const props = defineProps<{
    value: CompanyValue | null;
}>();

const form = useForm({
    icon: props.value?.icon || '',
    title: props.value?.title || '',
    description: props.value?.description || '',
    order: props.value?.order || 0,
});

const submit = () => {
    if (props.value) {
        form.put(`/admin/values/${props.value.id}`, {
            onSuccess: () => form.reset(),
        });
    } else {
        form.post('/admin/values', {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <AdminLayout :title="value ? 'Edit Company Value' : 'Add Company Value'">
        <div class="space-y-6">
            <div>
                <Link
                    href="/admin/values"
                    class="mb-2 inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                >
                    <span class="material-symbols-outlined mr-1 text-lg"
                        >arrow_back</span
                    >
                    Back to Values
                </Link>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ value ? 'Edit Company Value' : 'Add Company Value' }}
                </h1>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Value Information</CardTitle>
                </CardHeader>
                <CardContent>
                    <form class="space-y-6" @submit.prevent="submit">
                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <Label for="icon"
                                    >Icon (Material Symbol) *</Label
                                >
                                <Input
                                    id="icon"
                                    v-model="form.icon"
                                    type="text"
                                    placeholder="verified, eco, lightbulb"
                                    required
                                />
                                <p class="text-xs text-gray-500">
                                    Find icons at
                                    <a
                                        href="https://fonts.google.com/icons"
                                        target="_blank"
                                        class="text-primary hover:underline"
                                    >
                                        Google Material Symbols
                                    </a>
                                </p>
                                <div
                                    v-if="form.icon"
                                    class="mt-2 flex items-center gap-2"
                                >
                                    <span
                                        class="material-symbols-outlined text-3xl text-primary"
                                    >
                                        {{ form.icon }}
                                    </span>
                                    <span class="text-sm text-gray-500"
                                        >Icon preview</span
                                    >
                                </div>
                                <p
                                    v-if="form.errors.icon"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.icon }}
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
                                placeholder="Quality"
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
                                placeholder="Describe this company value..."
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
                            <Link href="/admin/values">
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
