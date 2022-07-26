<template>
   <div v-for="categor in propsVal">
      <div @click='addToCart'>
         <p>{{ categor.name }} </p>
      </div>
   </div>

   
</template>
<script>

   export default {
       name: "category",
       props: [
            'propsVal'
       ],

       methods: {
        addToCart() {
            console.log(33);
            return 33
        }
      }

   }
</script>
<style scoped>
.pp {
   color:blue !important;
}
</style>