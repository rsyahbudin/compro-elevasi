<script setup lang="ts">
import { Button } from '@/components/ui/button';
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

interface TimelineItem {
    id: number;
    year: string;
    title: string;
    description: string;
    order: number;
}

interface PaginatedItems {
    data: TimelineItem[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

defineProps<{
    items: PaginatedItems;
}>();

const deleteItem = (id: number) => {
    if (confirm('Are you sure you want to delete this timeline item?')) {
        router.delete(`/admin/timeline/${id}`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AdminLayout title="Timeline">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Timeline</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your company timeline displayed on the About page
                    </p>
                </div>
                <Link href="/admin/timeline/create">
                    <Button>Add Timeline Item</Button>
                </Link>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm"
            >
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-24">Year</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead class="w-20">Order</TableHead>
                            <TableHead class="w-32 text-right"
                                >Actions</TableHead
                            >
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="item in items.data" :key="item.id">
                            <TableCell class="font-bold text-primary">{{
                                item.year
                            }}</TableCell>
                            <TableCell class="font-medium">{{
                                item.title
                            }}</TableCell>
                            <TableCell class="text-sm text-gray-600">
                                {{ item.description.substring(0, 100) }}...
                            </TableCell>
                            <TableCell class="text-sm">{{
                                item.order
                            }}</TableCell>
                            <TableCell class="text-right">
                                <div
                                    class="flex items-center justify-end gap-2"
                                >
                                    <Link
                                        :href="`/admin/timeline/${item.id}/edit`"
                                        class="text-sm font-medium text-primary hover:underline"
                                    >
                                        Edit
                                    </Link>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        class="h-8 text-red-600 hover:bg-red-50 hover:text-red-700"
                                        @click="deleteItem(item.id)"
                                    >
                                        Delete
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="items.data.length === 0">
                            <TableCell
                                colspan="5"
                                class="py-8 text-center text-gray-500"
                            >
                                No timeline items yet.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
