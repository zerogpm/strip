<template>
    <form action="/purchases" method="POST">

        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <select name="product" v-model="product">
            <option v-for="product in products" :value="product.id">
                {{ product.name }} &mdash; ${{ product.price / 100}}
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
          stripe: null,
          stripeEmail: '',
          stripeToken: '',
          product: 1
        };
      },

      created() {
        let self = this;
        this.stripe = StripeCheckout.configure({
          key: keyhash.key,
          image: "https://stripe.com/img/documentation/checkout/marketplace.png",
          locale: "auto",
          token: function (token) {
            self.stripeEmail = token.email;
            self.stripeToken = token.id;
            axios.post('/purchases', self.$data).then(
              response => {
                console.log(response);
                alert('Complete! Thanks for your payment!')
              });
          }
        });
      },

      methods: {
        buy() {

          let product = this.findProductById(this.product);

          this.stripe.open({
            name: product.name,
            description: product.description,
            zipCode: true,
            amount: product.price
          });
        },

        findProductById(id) {
          return this.products.find(product => product.id == id);
        }
      },
    }
</script>
