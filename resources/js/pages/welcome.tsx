import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Shipping">
            </Head>
            <div className="flex min-h-screen flex-col items-center p-6 lg:justify-center lg:p-8">
                <h1>
                    Admir
                </h1>
            </div>
        </>
    );
}
