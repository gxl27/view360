<template>
    <div class='nav-cart-content'>
        <img src='img/cart.svg' />
    <div id='nav-cart-counter'>
        {{ cartCounter }}
        </div>
    </div>
    <div>
        <span> Cart</span>
    </div>
</template>

<script>
   export default {
       name: "NavCart",
       props: ['cartCounter']


   }
</script>
<style scoped>
p {
   color:blue !important;
}
</style>