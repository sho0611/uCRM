<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { route } from 'ziggy-js';


//showからのデータの取得
const props = defineProps({
  item: Object
})

//データをリアクティブ変換
const form = reactive({
  id: props.item.id,
  name: props.item.name,
  memo: props.item.memo,
  price: props.item.price,
  is_seling: props.item.is_seling 
})

const updateItem = id => {
    Inertia.put(route('items.update', { item: id }), form)
}

</script>

<template>

<section class="text-gray-600 body-font relative">
  <!--ボタンが押されたらconst uadate-->
    <form @submit.prevent="updateItem(form.id)">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
            <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

        <!--リアクティブなデータv-modeを使用することにより表示-->
        <div class="p-2 w-full">
          <div class="relative">
            <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
            <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="price" class="leading-7 text-sm text-gray-600">値段</label>
            <input type="text" id="price" name="price" v-model="form.price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="is_seling" class="leading-7 text-sm text-gray-600">ステータス</label>

            <input type="radio" id="is_seling" name="is_seling" v-model="form.is_seling" value="1">
            <label>販売中</label>
            <input type="radio" id="is_seling" name="is_seling" v-model="form.is_seling" value="0">
            <label>停止中</label>

          </div>
        </div>

        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
        </div>

        </div>
      </div>
    </div>
</form>
</section>
</template>