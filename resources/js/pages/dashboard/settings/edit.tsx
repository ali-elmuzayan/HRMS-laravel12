import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';

const breadcrumps: BreadcrumbItem[] = [
    {
        title: 'edit settings',
        href: '/company/settings/edit',
    },
];

export default function Edit() {
    const { data, setData, put } = useForm({
        name: '',
        description: '',
        weekStartDay: '',
        fiscalDayStart: '',
    });

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        console.log(data);
        e.preventDefault();
        put(route('tenant.settings.update'));
    };

    return (
        <AppLayout breadcrumbs={breadcrumps}>
            <Head title="edit settings" />
            <div className="bg-amber-100 p-4">
                <form className="space-y-6" onSubmit={handleSubmit}>
                    <div className="grid gap-2">
                        <Label htmlFor="    ">Setting</Label>
                        <Input placeholder="setting name" value={data.name} onChange={(e) => setData('name', e.target.value)}></Input>
                    </div>
                    <div className="mt-6 grid gap-2">
                        <Label htmlFor="    ">Description</Label>
                        <Textarea
                            placeholder="description"
                            value={data.description}
                            onChange={(e) => setData('description', e.target.value)}
                        ></Textarea>
                    </div>
                    <div className="mt-6 grid gap-2">
                        <Label htmlFor="    ">Setting</Label>
                        <Input
                            placeholder="setting name"
                            type="date"
                            value={data.weekStartDay}
                            onChange={(e) => setData('weekStartDay', e.target.value)}
                        ></Input>
                    </div>
                    <div className="mt-6 grid gap-2">
                        <Label htmlFor="fiscalDayStart">Fiscal Day start</Label>
                        <Input
                            placeholder="setting name"
                            type="date"
                            value={data.fiscalDayStart}
                            onChange={(e) => setData('fiscalDayStart', e.target.value)}
                        ></Input>
                    </div>
                    <div className="mt-6 grid">
                        <Button type="submit" className="mt-4 bg-amber-800 hover:bg-amber-500">
                            Edit settings
                        </Button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
