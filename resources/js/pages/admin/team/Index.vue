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

interface TeamMember {
    id: number;
    name: string;
    role: string;
    photo: string | null;
    order: number;
    is_active: boolean;
}

interface PaginatedMembers {
    data: TeamMember[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

defineProps<{
    members: PaginatedMembers;
}>();

const deleteMember = (id: number) => {
    if (confirm('Are you sure you want to delete this team member?')) {
        router.delete(`/admin/team/${id}`, {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AdminLayout title="Team Members">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Team Members
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your team members displayed on the About page
                    </p>
                </div>
                <Link href="/admin/team/create">
                    <Button>Add Team Member</Button>
                </Link>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm"
            >
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-16">Photo</TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Role</TableHead>
                            <TableHead class="w-20">Order</TableHead>
                            <TableHead class="w-24">Status</TableHead>
                            <TableHead class="w-32 text-right"
                                >Actions</TableHead
                            >
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="member in members.data"
                            :key="member.id"
                        >
                            <TableCell>
                                <img
                                    v-if="member.photo"
                                    :src="
                                        member.photo.startsWith('http')
                                            ? member.photo
                                            : `/storage/${member.photo}`
                                    "
                                    :alt="member.name"
                                    class="h-10 w-10 rounded-full object-cover"
                                />
                                <div
                                    v-else
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 text-xs font-medium text-gray-500"
                                >
                                    {{ member.name.charAt(0) }}
                                </div>
                            </TableCell>
                            <TableCell class="font-medium">{{
                                member.name
                            }}</TableCell>
                            <TableCell class="text-sm text-gray-600">{{
                                member.role
                            }}</TableCell>
                            <TableCell class="text-sm">{{
                                member.order
                            }}</TableCell>
                            <TableCell>
                                <span
                                    v-if="member.is_active"
                                    class="inline-flex rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800"
                                >
                                    Active
                                </span>
                                <span
                                    v-else
                                    class="inline-flex rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800"
                                >
                                    Inactive
                                </span>
                            </TableCell>
                            <TableCell class="text-right">
                                <div
                                    class="flex items-center justify-end gap-2"
                                >
                                    <Link
                                        :href="`/admin/team/${member.id}/edit`"
                                        class="text-sm font-medium text-primary hover:underline"
                                    >
                                        Edit
                                    </Link>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        class="h-8 text-red-600 hover:bg-red-50 hover:text-red-700"
                                        @click="deleteMember(member.id)"
                                    >
                                        Delete
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="members.data.length === 0">
                            <TableCell
                                colspan="6"
                                class="py-8 text-center text-gray-500"
                            >
                                No team members yet.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
