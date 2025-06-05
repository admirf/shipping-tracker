import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import ShipmentTracker from '@/components/shipping/shipment-tracker';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Shipping">
            </Head>
            <div className="flex min-h-screen flex-col items-center p-6 lg:justify-center lg:p-8">
                <h1 className="mb-2">
                    Amazing Shipping Tracker
                </h1>
                <ShipmentTracker />
            </div>
        </>
    );
}
