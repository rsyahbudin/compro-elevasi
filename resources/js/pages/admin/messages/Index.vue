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
import { format } from 'date-fns';

interface ContactMessage {
    id: number;
    name: string;
    email: string;
    phone?: string;
    location?: string;
    message: string;
    read_at?: string;
    created_at: string;
}

interface PaginatedMessages {
    data: ContactMessage[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

defineProps<{
    messages: PaginatedMessages;
    unreadCount: number;
}>();

const deleteMessage = (id: number) => {
    if (confirm('Are you sure you want to delete this message?')) {
        router.delete(`/admin/messages/${id}`, {
            preserveScroll: true,
        });
    }
};

const formatDate = (date: string) => {
    return format(new Date(date), 'MMM d, yyyy HH:mm');
};
</script>

<template>
    <AdminLayout title="Contact Messages">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Contact Messages
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ messages.total }} total messages
                        <span v-if="unreadCount > 0" class="text-primary">
                            ({{ unreadCount }} unread)
                        </span>
                    </p>
                </div>
            </div>

            <!-- Messages Table -->
            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm"
            >
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-12"></TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Phone</TableHead>
                            <TableHead>Date</TableHead>
                            <TableHead class="text-right">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="message in messages.data"
                            :key="message.id"
                            :class="{
                                'bg-blue-50': !message.read_at,
                            }"
                        >
                            <TableCell>
                                <span
                                    v-if="!message.read_at"
                                    class="flex h-2 w-2 rounded-full bg-primary"
                                    title="Unread"
                                ></span>
                            </TableCell>
                            <TableCell class="font-medium">
                                {{ message.name }}
                            </TableCell>
                            <TableCell class="text-sm text-gray-600">
                                {{ message.email }}
                            </TableCell>
                            <TableCell class="text-sm text-gray-600">
                                {{ message.phone || '-' }}
                            </TableCell>
                            <TableCell class="text-sm text-gray-600">
                                {{ formatDate(message.created_at) }}
                            </TableCell>
                            <TableCell class="text-right">
                                <div
                                    class="flex items-center justify-end gap-2"
                                >
                                    <Link
                                        :href="`/admin/messages/${message.id}`"
                                        class="text-sm font-medium text-primary hover:underline"
                                    >
                                        View
                                    </Link>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        class="h-8 text-red-600 hover:bg-red-50 hover:text-red-700"
                                        @click="deleteMessage(message.id)"
                                    >
                                        Delete
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="messages.data.length === 0">
                            <TableCell
                                colspan="6"
                                class="py-8 text-center text-gray-500"
                            >
                                No messages yet.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>

            <!-- Pagination -->
            <div
                v-if="messages.last_page > 1"
                class="flex items-center justify-between"
            >
                <p class="text-sm text-gray-500">
                    Showing
                    {{ (messages.current_page - 1) * messages.per_page + 1 }}
                    to
                    {{
                        Math.min(
                            messages.current_page * messages.per_page,
                            messages.total,
                        )
                    }}
                    of {{ messages.total }} messages
                </p>
                <div class="flex gap-2">
                    <Button
                        v-if="messages.current_page > 1"
                        variant="outline"
                        size="sm"
                        @click="
                            router.get(
                                `/admin/messages?page=${messages.current_page - 1}`,
                            )
                        "
                    >
                        Previous
                    </Button>
                    <Button
                        v-if="messages.current_page < messages.last_page"
                        variant="outline"
                        size="sm"
                        @click="
                            router.get(
                                `/admin/messages?page=${messages.current_page + 1}`,
                            )
                        "
                    >
                        Next
                    </Button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
