<template>
    <form action="/purchases" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <button type="submit" @click.prevent="buy">Buy my Book</button>
    </form>
</template>

<script>
    export default {

      data() {
        return {
          stripeEmail: '',
          stripeToken: ''
        };
      },

      created() {
        this.stripe = StripeCheckout.configure({
          key: keyhash.key,
          image: "https://stripe.com/img/documentation/checkout/marketplace.png",
          locale: "auto",
          token: function (token) {
            this.stripeEmail = token.email;
            this.stripeToken = token.id;
            let formData = {
              stripeEmail: this.stripeEmail,
              stripeToken: this.stripeToken
            };

            axios.post('/purchases', formData).then(response => alert('Complete! Thanks for your payment!'));
          }
        });
      },

      methods: {
        buy() {
          this.stripe.open({
            name: 'My Book',
            description: 'Some details about the book.',
            zipCode: true,
            amount: 2500
          });
        }
      }

    }
</script>
