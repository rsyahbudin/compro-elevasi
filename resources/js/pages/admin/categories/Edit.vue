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
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft } from 'lucide-vue-next';

interface Category {
    id: number;
    name: string;
    icon: string | null;
    order: number;
}

const props = defineProps<{
    category: Category;
}>();

const form = useForm({
    name: props.category.name,
    icon: props.category.icon || '',
    order: props.category.order,
});

const submit = () => {
    form.put(`/admin/categories/${props.category.id}`);
};
</script>

<template>
    <AdminLayout title="Edit Category">
        <div class="space-y-6">
            <div class="flex items-center gap-4">
                <Button variant="ghost" size="icon" as-child>
                    <Link href="/admin/categories">
                        <ArrowLeft class="size-4" />
                    </Link>
                </Button>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">
                        Edit Category
                    </h1>
                    <p class="text-muted-foreground">
                        Update category information
                    </p>
                </div>
            </div>

            <Card class="max-w-2xl">
                <CardHeader>
                    <CardTitle>Category Details</CardTitle>
                    <CardDescription>
                        Update the category information below.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <form class="space-y-6" @submit.prevent="submit">
                        <div class="space-y-2">
                            <Label for="name">Name *</Label>
                            <Input
                                id="name"
                                v-model="form.name"
                                type="text"
                                placeholder="e.g., Residential"
                                required
                            />
                            <p
                                v-if="form.errors.name"
                                class="text-sm text-destructive"
                            >
                                {{ form.errors.name }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <Label for="icon">Icon (Material Symbol)</Label>
                            <Input
                                id="icon"
                                v-model="form.icon"
                                type="text"
                                placeholder="e.g., home, business, construction"
                            />
                            <p class="text-xs text-muted-foreground">
                                Use Material Symbols icon names. See:
                                <a
                                    href="https://fonts.google.com/icons"
                                    target="_blank"
                                    class="text-primary hover:underline"
                                >
                                    Google Fonts Icons
                                </a>
                            </p>
                        </div>

                        <div class="space-y-2">
                            <Label for="order">Order</Label>
                            <Input
                                id="order"
                                v-model="form.order"
                                type="number"
                                min="0"
                            />
                        </div>

                        <div class="flex gap-4 pt-4">
                            <Button type="submit" :disabled="form.processing">
                                {{
                                    form.processing
                                        ? 'Saving...'
                                        : 'Save Changes'
                                }}
                            </Button>
                            <Button variant="outline" as-child>
                                <Link href="/admin/categories">Cancel</Link>
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
