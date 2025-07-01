import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { ChevronDown, ChevronRight } from 'lucide-react';
import { useState } from 'react';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const page = usePage();
    const [openMenus, setOpenMenus] = useState<Record<string, boolean>>({});

    const toggleMenu = (title: string) => {
        setOpenMenus((prev) => ({
            ...prev,
            [title]: !prev[title],
        }));
    };

    const renderItem = (item: NavItem) => {
        const isActive = page.url.startsWith(item.href || '');
        const hasChildren = !!item.children?.length;

        return (
            <SidebarMenuItem key={item.title}>
                {hasChildren ? (
                    <>
                        <SidebarMenuButton onClick={() => toggleMenu(item.title)} isActive={isActive} tooltip={{ children: item.title }}>
                            <div className="flex w-full items-center justify-between">
                                <div className="flex items-center gap-2">
                                    {item.icon && <item.icon />}
                                    <span>{item.title}</span>
                                </div>
                                {openMenus[item.title] ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
                            </div>
                        </SidebarMenuButton>
                        {openMenus[item.title] &&
                            item.children!.map((child) => (
                                <SidebarMenuItem key={child.title} className="pl-6">
                                    <SidebarMenuButton asChild isActive={page.url.startsWith(child.href)} tooltip={{ children: child.title }}>
                                        <Link href={child.href} prefetch>
                                            {child.icon && <child.icon />}
                                            <span>{child.title}</span>
                                        </Link>
                                    </SidebarMenuButton>
                                </SidebarMenuItem>
                            ))}
                    </>
                ) : (
                    <SidebarMenuButton asChild isActive={isActive} tooltip={{ children: item.title }}>
                        <Link href={item.href!} prefetch>
                            {item.icon && <item.icon />}
                            <span>{item.title}</span>
                        </Link>
                    </SidebarMenuButton>
                )}
            </SidebarMenuItem>
        );
    };

    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>Main</SidebarGroupLabel>
            <SidebarMenu>{items.map(renderItem)}</SidebarMenu>
        </SidebarGroup>
    );
}

// import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
// import { type NavItem } from '@/types';
// import { Link, usePage } from '@inertiajs/react';

// export function NavMain({ items = [] }: { items: NavItem[] }) {
//     const page = usePage();
//     console.log(items);
//     return (
//         <SidebarGroup className="px-2 py-0">
//             <SidebarGroupLabel>Main</SidebarGroupLabel>
//             <SidebarMenu>
//                 {items.map((item) => (
//                     <SidebarMenuItem key={item.title}>
//                         <SidebarMenuButton asChild isActive={page.url.startsWith(item.href)} tooltip={{ children: item.title }}>
//                             <Link href={item.href} prefetch>
//                                 {item.icon && <item.icon />}
//                                 <span>{item.title}</span>
//                             </Link>
//                         </SidebarMenuButton>
//                     </SidebarMenuItem>
//                 ))}
//             </SidebarMenu>
//         </SidebarGroup>
//     );
// }
