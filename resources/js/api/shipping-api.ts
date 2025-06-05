export default class ShippingApi {
    public static async getShipping(trackingCode: string) {
        const res = await fetch(`/api/v1/shipping/${trackingCode}`)

        const data = await res.json()

        if (res.ok) {
            return data;
        }

        if (data.message) {
            throw data.message;
        }

        throw 'Uknown error occured';
    }
}
