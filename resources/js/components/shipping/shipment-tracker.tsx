import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { useEffect, useState } from 'react';
import ShippingApi from '@/api/shipping-api';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

export default function ShipmentTracker() {
    const [trackingCode, setTrackingCode] = useState<string>('');
    const [error, setError] = useState<string>('');
    const [deliveryDate, setDeliveryDate] = useState<string>('')
    const [remainingTime, setRemainingTime] = useState<string>('')

    useEffect(() => {
        const interval = setInterval(() => {
            if (deliveryDate !== '') {
                setRemainingTime(dayjs(deliveryDate).fromNow());
                return;
            }

            setRemainingTime('');
        }, 1000);

        return () => {
            clearInterval(interval);
        };
    }, []);

    const resetState = () => {
        setError('');
        setTrackingCode('');
    }

    const getShipping = async () => {
        try {
            const shipping = await ShippingApi.getShipping(trackingCode);
            resetState();

            const timeString = shipping.data.expected_delivery_at;

            setDeliveryDate(timeString);
            setRemainingTime(dayjs(timeString).fromNow())
        } catch (e) {
            if (typeof e === 'string') {
                setError(e);
                setDeliveryDate('')
            }
        }
    }

    return (
        <>
            <form action={getShipping}>
                <div className="flex flex-row">
                    <Input required={true} className="mr-2" value={trackingCode} onChange={(e) => setTrackingCode(e.target.value)} />
                    <Button type={"submit"}>Check</Button>
                </div>

                {error !== '' ? (
                    <div className="flex flex-col items-center mt-5 text-red-600">
                        { error }
                    </div>
                ): ''}

                {deliveryDate !== '' ? (
                    <div className="flex flex-col items-center mt-5">
                        <div>
                            Expected delivery is at: { deliveryDate }
                        </div>
                        <div>
                            In { remainingTime } from now
                        </div>
                    </div>
                ): ''}
            </form>
        </>
    );
}
