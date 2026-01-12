<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
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

const props = defineProps<{
    message: ContactMessage;
}>();

const deleteMessage = () => {
    if (confirm('Are you sure you want to delete this message?')) {
        router.delete(`/admin/messages/${props.message.id}`, {
            onSuccess: () => {
                router.visit('/admin/messages');
            },
        });
    }
};

const formatDate = (date: string) => {
    return format(new Date(date), "MMMM d, yyyy 'at' HH:mm");
};
</script>

<template>
    <AdminLayout title="View Message">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <Link
                        href="/admin/messages"
                        class="mb-2 inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                    >
                        <span class="material-symbols-outlined mr-1 text-lg">
                            arrow_back
                        </span>
                        Back to Messages
                    </Link>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Message from {{ message.name }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Received {{ formatDate(message.created_at) }}
                    </p>
                </div>
                <Button variant="destructive" @click="deleteMessage">
                    Delete Message
                </Button>
            </div>

            <!-- Message Details -->
            <div class="grid gap-6 md:grid-cols-3">
                <!-- Contact Info -->
                <Card class="md:col-span-1">
                    <CardHeader>
                        <CardTitle>Contact Information</CardTitle>
                    </CardHeader>
                    <CardContent class="space-y-4">
                        <div>
                            <p
                                class="text-xs font-medium text-gray-500 uppercase"
                            >
                                Name
                            </p>
                            <p class="mt-1 text-sm font-medium text-gray-900">
                                {{ message.name }}
                            </p>
                        </div>
                        <div>
                            <p
                                class="text-xs font-medium text-gray-500 uppercase"
                            >
                                Email
                            </p>
                            <a
                                :href="`mailto:${message.email}`"
                                class="mt-1 text-sm text-primary hover:underline"
                            >
                                {{ message.email }}
                            </a>
                        </div>
                        <div v-if="message.phone">
                            <p
                                class="text-xs font-medium text-gray-500 uppercase"
                            >
                                Phone
                            </p>
                            <a
                                :href="`tel:${message.phone}`"
                                class="mt-1 text-sm text-primary hover:underline"
                            >
                                {{ message.phone }}
                            </a>
                        </div>
                        <div v-if="message.location">
                            <p
                                class="text-xs font-medium text-gray-500 uppercase"
                            >
                                Project Location
                            </p>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ message.location }}
                            </p>
                        </div>
                        <div>
                            <p
                                class="text-xs font-medium text-gray-500 uppercase"
                            >
                                Status
                            </p>
                            <p class="mt-1">
                                <span
                                    v-if="message.read_at"
                                    class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800"
                                >
                                    Read
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                >
                                    New
                                </span>
                            </p>
                        </div>
                    </CardContent>
                </Card>

                <!-- Message Content -->
                <Card class="md:col-span-2">
                    <CardHeader>
                        <CardTitle>Message</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p
                            class="text-sm leading-relaxed whitespace-pre-wrap text-gray-700"
                        >
                            {{ message.message }}
                        </p>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>
