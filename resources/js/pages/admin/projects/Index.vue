<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
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

interface Project {
    id: number;
    title: string;
    slug: string;
    location: string;
    is_featured: boolean;
    is_published: boolean;
    category: {
        id: number;
        name: string;
    };
}

interface Pagination {
    data: Project[];
    current_page: number;
    last_page: number;
    prev_page_url: string | null;
    next_page_url: string | null;
}

defineProps<{
    projects: Pagination;
}>();

const deleteProject = (project: Project) => {
    if (confirm(`Are you sure you want to delete "${project.title}"?`)) {
        router.delete(`/admin/projects/${project.id}`);
    }
};
</script>

<template>
    <AdminLayout title="Projects">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Projects</h1>
                    <p class="text-muted-foreground">
                        Manage your portfolio projects
                    </p>
                </div>
                <Button as-child>
                    <Link href="/admin/projects/create">
                        <Plus class="mr-2 size-4" />
                        Add Project
                    </Link>
                </Button>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>All Projects</CardTitle>
                    <CardDescription>
                        A list of all projects in your portfolio.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Title</TableHead>
                                <TableHead>Category</TableHead>
                                <TableHead>Location</TableHead>
                                <TableHead class="text-center"
                                    >Status</TableHead
                                >
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="project in projects.data"
                                :key="project.id"
                            >
                                <TableCell>
                                    <div class="font-medium">
                                        {{ project.title }}
                                    </div>
                                </TableCell>
                                <TableCell>{{
                                    project.category?.name || '—'
                                }}</TableCell>
                                <TableCell>{{ project.location }}</TableCell>
                                <TableCell class="text-center">
                                    <div
                                        class="flex items-center justify-center gap-2"
                                    >
                                        <Badge
                                            :variant="
                                                project.is_published
                                                    ? 'default'
                                                    : 'secondary'
                                            "
                                        >
                                            {{
                                                project.is_published
                                                    ? 'Published'
                                                    : 'Draft'
                                            }}
                                        </Badge>
                                        <Badge
                                            v-if="project.is_featured"
                                            variant="outline"
                                            >Featured</Badge
                                        >
                                    </div>
                                </TableCell>
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
                                                :href="`/admin/projects/${project.id}/edit`"
                                            >
                                                <Edit class="size-4" />
                                            </Link>
                                        </Button>
                                        <Button
                                            variant="ghost"
                                            size="icon"
                                            class="text-destructive hover:text-destructive"
                                            @click.stop.prevent="
                                                deleteProject(project)
                                            "
                                        >
                                            <Trash2 class="size-4" />
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="projects.data.length === 0">
                                <TableCell
                                    colspan="5"
                                    class="h-24 text-center text-muted-foreground"
                                >
                                    No projects found. Create your first
                                    project.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <!-- Pagination -->
                    <div
                        v-if="projects.last_page > 1"
                        class="mt-4 flex items-center justify-end gap-2"
                    >
                        <Button
                            variant="outline"
                            size="sm"
                            :disabled="!projects.prev_page_url"
                            as-child
                        >
                            <Link :href="projects.prev_page_url || '#'"
                                >Previous</Link
                            >
                        </Button>
                        <span class="text-sm text-muted-foreground">
                            Page {{ projects.current_page }} of
                            {{ projects.last_page }}
                        </span>
                        <Button
                            variant="outline"
                            size="sm"
                            :disabled="!projects.next_page_url"
                            as-child
                        >
                            <Link :href="projects.next_page_url || '#'"
                                >Next</Link
                            >
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
