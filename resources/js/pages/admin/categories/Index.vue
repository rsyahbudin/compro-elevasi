<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { Edit, Plus, Trash2 } from 'lucide-vue-next';

interface Category {
    id: number;
    name: string;
    slug: string;
    icon: string | null;
    order: number;
    projects_count: number;
}

defineProps<{
    categories: Category[];
}>();

const deleteCategory = (category: Category) => {
    if (category.projects_count > 0) {
        alert(
            `Cannot delete "${category.name}" because it has ${category.projects_count} projects.`,
        );
        return;
    }

    if (confirm(`Are you sure you want to delete "${category.name}"?`)) {
        router.delete(`/admin/categories/${category.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Categories">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">
                        Categories
                    </h1>
                    <p class="text-muted-foreground">
                        Manage project categories
                    </p>
                </div>
                <Button as-child>
                    <Link href="/admin/categories/create">
                        <Plus class="mr-2 size-4" />
                        Add Category
                    </Link>
                </Button>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>All Categories</CardTitle>
                    <CardDescription>
                        A list of all project categories.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Icon</TableHead>
                                <TableHead class="text-center">Order</TableHead>
                                <TableHead class="text-center"
                                    >Projects</TableHead
                                >
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <TableCell class="font-medium">{{
                                    category.name
                                }}</TableCell>
                                <TableCell>
                                    <span
                                        v-if="category.icon"
                                        class="material-symbols-outlined text-lg"
                                    >
                                        {{ category.icon }}
                                    </span>
                                    <span v-else class="text-muted-foreground"
                                        >—</span
                                    >
                                </TableCell>
                                <TableCell class="text-center">{{
                                    category.order
                                }}</TableCell>
                                <TableCell class="text-center">{{
                                    category.projects_count
                                }}</TableCell>
                                <TableCell class="text-right">
                                    <div
                                        class="flex items-center justify-end gap-2"
                                    >
                                        <Button
                                            variant="ghost"
                                            size="icon"
                                            as-child
                                        >
                                            <Link
                                                :href="`/admin/categories/${category.id}/edit`"
                                            >
                                                <Edit class="size-4" />
                                            </Link>
                                        </Button>
                                        <Button
                                            variant="ghost"
                                            size="icon"
                                            class="text-destructive hover:text-destructive"
                                            @click="deleteCategory(category)"
                                        >
                                            <Trash2 class="size-4" />
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="categories.length === 0">
                                <TableCell
                                    colspan="5"
                                    class="h-24 text-center text-muted-foreground"
                                >
                                    No categories found. Create your first
                                    category.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
