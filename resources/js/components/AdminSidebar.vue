<script setup lang="ts">
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { Link, router, usePage } from '@inertiajs/vue3';
import {
    Calendar, // Added Calendar as it's used but not imported
    FolderOpen,
    Home,
    LayoutDashboard,
    LogOut,
    Mail,
    Settings,
    Tag,
    Trophy,
    Users,
} from 'lucide-vue-next';
import { computed } from 'vue';

const page = usePage();

interface NavItem {
    title: string;
    href: string;
    icon: typeof LayoutDashboard;
    active?: (path: string) => boolean;
}

const navItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
        icon: LayoutDashboard,
        active: (path) => path === '/admin',
    },
    {
        title: 'Categories',
        href: '/admin/categories',
        icon: Tag,
        active: (path) => path.startsWith('/admin/categories'),
    },
    {
        title: 'Projects',
        href: '/admin/projects',
        icon: FolderOpen,
        active: (path) => path.startsWith('/admin/projects'),
    },
    {
        title: 'Messages',
        href: '/admin/messages',
        icon: Mail,
        active: (path) => path.startsWith('/admin/messages'),
    },
    {
        title: 'Team',
        href: '/admin/team',
        icon: Users,
        active: (path) => path.startsWith('/admin/team'),
    },
    {
        title: 'Timeline',
        href: '/admin/timeline',
        icon: Calendar,
        active: (path) => path.startsWith('/admin/timeline'),
    },
    {
        title: 'Values',
        href: '/admin/values',
        icon: Trophy,
        active: (path) => path.startsWith('/admin/values'),
    },
    {
        title: 'Settings',
        href: '/admin/settings',
        icon: Settings,
        active: (path) => path.startsWith('/admin/settings'),
    },
];

const currentPath = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.pathname;
    }
    return '';
});

const isActive = (item: NavItem) => {
    if (item.active) {
        return item.active(currentPath.value);
    }
    return currentPath.value === item.href;
};

const logout = () => {
    router.post('/logout');
};

const username = computed(() => page.props.auth?.user?.name || 'Admin');
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link href="/admin" class="flex items-center gap-2">
                            <div
                                class="flex size-8 items-center justify-center rounded-md bg-primary text-primary-foreground"
                            >
                                <LayoutDashboard class="size-4" />
                            </div>
                            <div class="flex flex-col gap-0.5 leading-none">
                                <span class="font-semibold">Elevasi Admin</span>
                                <span class="text-xs text-muted-foreground"
                                    >Dashboard</span
                                >
                            </div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <SidebarGroup>
                <SidebarGroupLabel>Menu</SidebarGroupLabel>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <SidebarMenuItem
                            v-for="item in navItems"
                            :key="item.href"
                        >
                            <SidebarMenuButton
                                as-child
                                :is-active="isActive(item)"
                            >
                                <Link :href="item.href">
                                    <component :is="item.icon" class="size-4" />
                                    <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroupContent>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton as-child>
                        <Link href="/" target="_blank">
                            <Home class="size-4" />
                            <span>View Site</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
                <SidebarMenuItem>
                    <SidebarMenuButton
                        @click="logout"
                        class="text-destructive hover:text-destructive"
                    >
                        <LogOut class="size-4" />
                        <span>Logout</span>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarFooter>
    </Sidebar>
</template>
