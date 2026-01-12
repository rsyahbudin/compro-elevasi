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

interface CompanyValue {
    id: number;
    icon: string;
    title: string;
    description: string;
    order: number;
}

interface PaginatedValues {
    data: CompanyValue[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

defineProps<{
    values: PaginatedValues;
}>();

const deleteValue = (id: number) => {
    if (confirm('Are you sure you want to delete this value?')) {
        router.delete(`/admin/values/${id}`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AdminLayout title="Company Values">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Company Values
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your company values displayed on the About page
                    </p>
                </div>
                <Link href="/admin/values/create">
                    <Button>Add Value</Button>
                </Link>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm"
            >
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-16">Icon</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead class="w-20">Order</TableHead>
                            <TableHead class="w-32 text-right"
                                >Actions</TableHead
                            >
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="value in values.data" :key="value.id">
                            <TableCell>
                                <span
                                    class="material-symbols-outlined text-2xl text-primary"
                                >
                                    {{ value.icon }}
                                </span>
                            </TableCell>
                            <TableCell class="font-medium">{{
                                value.title
                            }}</TableCell>
                            <TableCell class="text-sm text-gray-600">
                                {{ value.description.substring(0, 100) }}...
                            </TableCell>
                            <TableCell class="text-sm">{{
                                value.order
                            }}</TableCell>
                            <TableCell class="text-right">
                                <div
                                    class="flex items-center justify-end gap-2"
                                >
                                    <Link
                                        :href="`/admin/values/${value.id}/edit`"
                                        class="text-sm font-medium text-primary hover:underline"
                                    >
                                        Edit
                                    </Link>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        class="h-8 text-red-600 hover:bg-red-50 hover:text-red-700"
                                        @click="deleteValue(value.id)"
                                    >
                                        Delete
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="values.data.length === 0">
                            <TableCell
                                colspan="5"
                                class="py-8 text-center text-gray-500"
                            >
                                No company values yet.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
