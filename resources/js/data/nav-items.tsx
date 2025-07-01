import { NavItem } from '@/types';
import { Folder, LayoutGrid } from 'lucide-react';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Settings',
        icon: Folder,
        children: [
            {
                title: 'General',
                href: '/settings',
                icon: Folder,
            },
            {
                title: 'Appearance',
                href: '/settings/appearance',
                icon: Folder,
            },
        ],
    },
];

const footerNavItems: NavItem[] = [
    // {
    //     title: 'Repository',
    //     href: 'https://github.com/laravel/react-starter-kit',
    //     icon: Folder,
    // },
    // {
    //     title: 'Documentation',
    //     href: 'https://laravel.com/docs/starter-kits#react',
    //     icon: BookOpen,
    // },
];

export { footerNavItems, mainNavItems };
