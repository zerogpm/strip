<template>
    <form action="/purchases" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <select name="product" v-model="product">
            <option v-for="product in products" :value="product.id">
                {{ product.name }} &mdash; ${{ product.price}}
            </option>
        </select>

        <button type="submit" @click.prevent="buy">Buy my Book</button>
    </form>
</template>

<script>
    export default {

      props: ['products'],

      data() {
        return {
          stripeEmail: '',
          stripeToken: '',
          product: 1
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

          let product = this.findProductById(this.product);

          this.stripe.open({
            name: product.name,
            description: 'Some details about the book.',
            zipCode: true,
            amount: product.price * 100
          });
        },

        findProductById(id) {
          return this.products.find(product => product.id == id);
        }
      }

    }
</script>
