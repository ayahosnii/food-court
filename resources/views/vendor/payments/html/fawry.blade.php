<!-- Import FawryPay CSS Library-->
<link rel="stylesheet" href="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/css/fawrypay-payments.css">

<!-- FawryPay Checkout Button -->
<input type="image" onclick="checkout();" src="https://www.atfawry.com/assets/img/FawryPayLogo.jpg"
       alt="pay-using-fawry" id="fawry-payment-btn"/>

<!-- Import FawryPay Staging JavaScript Library-->
<script type="text/javascript" src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>
<!-- Import FawryPay Production JavaScript Library -->
<script type="text/javascript" src="https://www.atfawry.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script>

<script type="text/javascript">
    function checkout() {
        const configuration = {
            locale : "en",  //default en
            mode: DISPLAY_MODE.POPUP,  //required, allowed values [POPUP, INSIDE_PAGE, SIDE_PAGE , SEPARATED]
        };
        FawryPay.checkout(buildChargeRequest(), configuration);
    }

    function buildChargeRequest() {
        const chargeRequest = {
            merchantCode: '1tSa6uxz2nRbgY+b+cZGyA==',
            merchantRefNum: '2312465464',
            customerMobile: '01xxxxxxxxx',
            customerEmail: 'email@domain.com',
            customerName: 'Customer Name',
            customerProfileId: '1212',
            paymentExpiry: '1631138400000',
            chargeItems: [
                {
                    itemId: '6b5fdea340e31b3b0339d4d4ae5',
                    description: 'Product Description',
                    price: 50.00,
                    quantity: 2,
                    imageUrl: 'https://developer.fawrystaging.com/photos/45566.jpg',
                },
                {
                    itemId: '97092dd9e9c07888c7eef36',
                    description: 'Product Description',
                    price: 75.25,
                    quantity: 3,
                    imageUrl: 'https://developer.fawrystaging.com/photos/639855.jpg',
                },
            ],
            selectedShippingAddress: {
                governorate: 'GIZA', //Governorate code at Fawry
                city: 'MOHANDESSIN', //City code at Fawry
                area: 'GAMETDEWAL', //Area code at Fawry
                address: '9th 90 Street, apartment number 8, 4th floor',
                receiverName: 'Receiver Name'
            },
            returnUrl: 'https://developer.fawrystaging.com',
            authCaptureModePayment: false,
            signature: "cf031d43901def1e209c1c74f2d6ef80da1e19331e1c94786f558dada612d118"
        };
        return chargeRequest;
    }
</script>
