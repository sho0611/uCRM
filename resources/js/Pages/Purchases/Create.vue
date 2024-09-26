<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { getToday } from '@/common';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
    'customers' : Array,
    'items' : Array
})

onMounted(() => {
    form.date = getToday();

//const itemList = ref([])へリアクティブな配列を作成
    props.items.forEach( item => {
        itemList.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0
        })
    })
})

//リアクティブな空の配列を作成
const itemList = ref([])

const form = reactive({
    date: null,

    //purchases
    customer_id: null,
    status: true,

    //storeコントローラーへ渡すitem.idとitem.quantity
    //を追加する空の配列を作成する。
    items: []
})

const totalPrice = computed(() => {
    let total = 0
    itemList.value.forEach( item => {
        total += item.price * item.quantity
    })
    return total
})

//item配列(item.idとitem.quantity作成した)の作成
const storePurchase = () => {
    itemList.value.forEach( item => {
        if( item.quantity > 0){
            form.items.push({
                id: item.id,
                quantity: item.quantity
            })
        }
    })
    Inertia.post(route('purchases.store'), form)
}

const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]

//親 MicroMotalからの受け取り
const setCustomerId = id => {
  form.customer_id = id
}


</script>

<template>
  <Head title="購入画面" />

  <AuthenticatedLayout>
     <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入一覧</h2>
     </template>
     <section class="text-gray-600 body-font relative">

        <form @submit.prevent="storePurchase">
           <div class="container px-5 py-24 mx-auto">
              <div class="lg:w-1/2 md:w-2/3 mx-auto">
                 <div class="flex flex-wrap -m-2">

                    <div class="p-2 w-1/2">
                       <div class="relative">
                          <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                          <input type="date" id="date" name="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                       </div>
                    </div>

                    <div class="p-2 w-full">
                       <div class="relative">
                          <label for="customer" class="leading-7 text-sm text-gray-600">会員名</label>
                          <MicroModal @update:customer-id="setCustomerId"/>
                       </div>
                    </div>

                    <div class="w-full mx-auto overflow-auto">
                       <table class="table-auto w-full text-left whitespace-no-wrap">
                          <thead>
                             <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-bl">ID</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>
                             </tr>
                          </thead>
                          <tbody>
                             <tr v-for="item in itemList" :key="item.id">
                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ item.id }}</td>
                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ item.name }}</td>
                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ item.price }}</td>
                                <td>
                                   <select name="quantity" v-model="item.quantity">
                                      <option v-for="q in quantity" :value="q">{{ q }}</option>
                                   </select>
                                </td>
                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ item.price * item.quantity }}</td>
                             </tr>
                          </tbody>
                       </table>
                    </div>

                    <div class="p-2 w-full">
                     
                          <label for="price" class="leading-7 text-sm text-gray-600">合計金額</label>
                          <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                             合計: {{ totalPrice }} 円
                          </div>
                    </div>

                    <div class="p-2 w-full">
                       <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                    </div>
                 </div>
              </div>
           </div>
        </form>
     </section>
  </AuthenticatedLayout>
</template>
