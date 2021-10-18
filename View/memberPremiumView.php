<main>
    <h1 class="center" id="title"><i class="fas fa-award salmon"></i> Devenir premium ! <i class="fas fa-award salmon"></i></h1>
    <div id="containerCategories" class="flexCenter flexColumn wrap">
        <p>Avoir un badge de membre premium à chaque commentaire et sujets posté !</p>
        <p>Et bien d'autres...</p>
        <p></p>
        <p class="price">Prix : 5€</p>
        <div id="smart-button-container">
            <div class="center" ">
                <div id="paypal-button-container"></div>
            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                paypal.Buttons({
                    style: {
                        shape: 'pill',
                        color: 'blue',
                        layout: 'vertical',
                        label: 'buynow',

                    },

                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{"description":"Membre premium","amount":{"currency_code":"EUR","value":5}}]
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(orderData) {

                            // Full available details
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                            // Show a success message within this page, e.g.
                            const element = document.getElementById('paypal-button-container');
                            element.innerHTML = '';
                            element.innerHTML = '<h3>Thank you for your payment!</h3>';

                            // Or go to another URL:  actions.redirect('thank_you.html');

                        });
                    },

                    onError: function(err) {
                        console.log(err);
                    }
                }).render('#paypal-button-container');
            }
            initPayPalButton();
        </script>
    </div>
</main>