<script setup lang="ts">
import AdminSidebar from '@/components/AdminSidebar.vue';
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { Toaster } from '@/components/ui/sonner';
import type { BreadcrumbItemType } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';
import { toast } from 'vue-sonner';

interface Props {
    title?: string;
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    title: 'Admin',
    breadcrumbs: () => [],
});

const page = usePage();

// Watch for flash messages
const showFlashMessages = () => {
    const flash = (page.props as any).flash;
    if (flash?.success) {
        toast.success(flash.success);
    }
    if (flash?.error) {
        toast.error(flash.error);
    }
};

onMounted(() => {
    showFlashMessages();
});

watch(
    () => (page.props as any).flash,
    () => {
        showFlashMessages();
    },
    { deep: true },
);
</script>

<template>
    <Head :title="`${title} - Admin`" />
    <AppShell variant="sidebar">
        <AdminSidebar />
        <AppContent variant="sidebar">
            <header
                class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/50 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12"
            >
                <div class="flex items-center gap-2">
                    <SidebarTrigger class="-ml-1" />
                    <Breadcrumbs
                        v-if="breadcrumbs.length"
                        :breadcrumbs="breadcrumbs"
                    />
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-6">
                <slot />
            </main>
        </AppContent>
    </AppShell>
    <Toaster position="top-right" richColors />
</template>
