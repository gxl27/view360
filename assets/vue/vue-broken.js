// assets/js/app.js
import Vue from 'vue';
import axios from 'axios'
import Category from './components/Category.vue'
import Cart from './components/Cart.vue'
/**
* Create a fresh Vue Application instance
*/

Vue.component('product', {
    data() {
        return {
            product:'socks',
            image: '/uploads/photos',
            categories: {}
        }
    },
    props: ['propsVal'],
    methods: {
        addToCart() {
            return
        },
        async fetchUsers() {
            this.propsVal  = await axios.get('/api/category')
            .then(res =>res.data)
            .catch(err =>console.error(err));

          }
    },
    computed: {
        title() {
            return this.product + this.image
        }
    },
    template:`
        <div>
            <Category propsVal=this.categories></Category>
            <Cart></Cart>
        </div>
    `,
    components: {
        Category,
        Cart
      },
    created() {
        this.fetchUsers();
    }
  
})

// Vue.component('list', {
//     data() {
//         return {
//             product:'socks',
//             image: '/uploads/photos'
//         }
//     },
//     methods: {
//         addToCart() {
//             console.log(33);
//             return 33
//         }
//     },
//     computed: {
//         title() {
//             return this.product + this.image
//         }
//     },
//     template:`
//         <div>
//             <Carousel></Carousel>
//             <Example></Example>
//         </div>
//     `,
//     components: {
//         Example,
//         Carousel
//       }
// })

// Vue.component('cart', {
//     data() {
//         return {
//             product:'socks',
//             image: '/uploads/photos'
//         }
//     },
//     methods: {
//         addToCart() {
//             console.log(33);
//             return 33
//         }
//     },
//     computed: {
//         title() {
//             return this.product + this.image
//         }
//     },
//     template:`
//         <div>
//             <Carousel></Carousel>
//             <Example></Example>
//         </div>
//     `,
//     components: {
//         Example,
//         Carousel
//       }
// })


const app = new Vue({
    el: '#app',

  })


// const app = createApp({
//   data() {
//     return  {
//         product:'socks'
//     }
//   }
// })

//   const mountedApp = app.mount('#app');
