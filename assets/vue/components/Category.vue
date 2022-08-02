<template>
  <div>
      <div v-for="category in categories"
               :id="category.name"
               :class="'category-list'">
            <div 
               :key='category.id'
               :class="'category-item'">
               <div>
                  <img :src="'/uploads/photos/'+ category.img">
               </div>
               <div :class="'category-content'">
                  <h2>{{ category.name }} - {{ category.variantsCount }} brands</h2>
                  <div  :class="'variant-list'">
                        <div v-for="categoryVariant in category.variants"
                           :key='categoryVariant.id'
                           @click="getVariant(categoryVariant.id)"
                           :class="'variant-item'"
                           :title="'Details: ' + category.name + ' - ' + categoryVariant.name">
                              <img :src="'/uploads/photos/'+ categoryVariant.img">
                              <div>{{ categoryVariant.name }}</div>
                           </div>
                        </div>
                  </div>
               </div>
            </div>

            <div v-show="this.cartDisplay"
                  :class="'cart'">
               <div>
               <div @click="closeWindow"
                        :class="'btn-close-round'">
                  x
               </div>

               <div :class="'cart-image'">
                  <div>
                        <img v-if="product" :src="'/uploads/photos/'+ product.img"
                           :class="'variant-active-img'">
                  </div>
                  <div class="'text-title'">
                        <b>{{ product.name }} ( {{ product.stock }} remaining )</b>
                  </div>   
                  <div>
                        Price{{ product.price }} $
                  </div>      
                  
                  <button @click="addToCart"
                           :class="'btn-primary'">
                           <p v-if="product.stock > 0" >
                              Add to cart
                           </p>
                           <p v-else 
                              :class="'out-of-stock'">
                              Out of stock
                           </p>
                  </button>
               </div>
               <div :class="'cart-content'">
                  <div :class="'cart-list'">
                        <div v-for="variantProduct in products"
                              :key="variantProduct.id"
                              @click="getProduct(variantProduct.id)"
                              :class="'cart-item'">
                           <div :class="'cart-item-image'">
                              <img :src="'/uploads/photos/'+ variantProduct.img"
                                       :class="'variant-img'">
                           </div>
                           <div :class="'cart-item-content'">
                              <b>{{ variantProduct.name }}</b>
                              <div>
                                    Price: {{ variantProduct.price }} $
                              </div>
                           </div>

                        </div>
                  </div>
               </div>

            </div>
      </div>
   </div>
   
</template>
<script>

   export default {
       name: "category",
       props: [
            'propsVal'
       ],
       data() {
            image: '/uploads/photos',
            categories: {},
            variant:"",
            product:"",
            products:{},
            cartDisplay:0,
            cartCounter:0,
       }

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