<script setup lang="ts">
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
import { Link } from '@inertiajs/vue3';
import { FolderOpen, Layers, LayoutDashboard, Trophy } from 'lucide-vue-next';

interface Project {
    id: number;
    title: string;
    slug: string;
    category: {
        name: string;
    };
}

defineProps<{
    stats: {
        totalProjects: number;
        publishedProjects: number;
        featuredProjects: number;
        totalCategories: number;
    };
    recentProjects: Project[];
}>();
</script>

<template>
    <AdminLayout title="Dashboard">
        <div class="space-y-6">
            <div>
                <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
                <p class="text-muted-foreground">
                    Welcome to your admin dashboard
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Total Projects</CardTitle
                        >
                        <FolderOpen class="size-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalProjects }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            All projects in portfolio
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Published</CardTitle
                        >
                        <LayoutDashboard class="size-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.publishedProjects }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Visible on website
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Featured</CardTitle
                        >
                        <Trophy class="size-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.featuredProjects }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Featured on homepage
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Categories</CardTitle
                        >
                        <Layers class="size-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalCategories }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Project categories
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Recent Projects -->
            <Card>
                <CardHeader>
                    <CardTitle>Recent Projects</CardTitle>
                    <CardDescription
                        >Latest projects added to the portfolio</CardDescription
                    >
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Title</TableHead>
                                <TableHead>Category</TableHead>
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="project in recentProjects"
                                :key="project.id"
                            >
                                <TableCell class="font-medium">{{
                                    project.title
                                }}</TableCell>
                                <TableCell>{{
                                    project.category?.name || '—'
                                }}</TableCell>
                                <TableCell class="text-right">
                                    <Link
                                        :href="`/admin/projects/${project.id}/edit`"
                                        class="text-sm text-primary hover:underline"
                                    >
                                        Edit
                                    </Link>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="recentProjects.length === 0">
                                <TableCell
                                    colspan="3"
                                    class="h-24 text-center text-muted-foreground"
                                >
                                    No projects yet.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
