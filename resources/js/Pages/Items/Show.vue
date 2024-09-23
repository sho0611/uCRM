<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { nl2br } from '@/common';
import { Inertia } from '@inertiajs/inertia';
import { route } from 'ziggy-js';

defineProps({
  item : Object
})

const deleteItem = id => {
  Inertia.delete(route('items.destroy', { item: id}), {
    onBefore: () => confirm('本当に削除しますか?')
  })
}

</script>

<template>

<section class="text-gray-600 body-font relative">
  <Head title="商品詳細" />
    <form @submit.prevent="storeItem">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
            <div id="name" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              {{ item.id }}
            </div>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
            <div id="memo" v-html="item.memo" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
    
            </div>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="price" class="leading-7 text-sm text-gray-600">商品価格</label>
            <div id="price" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              {{ item.price }}
            </div>
          </div>
        </div>

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="status" class="leading-7 text-sm text-gray-600">商品状況</label>
            <div id="status" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              <span v-if="item.is_seling === 1">販売中</span>
              <span v-if="item.is_seling === 0">停止中</span>
            </div>
          </div>
        </div>

 


        <div class="p-2 w-full">
          <Link as="button" :href="route('items.edit', { item: item.id})">編集する</Link>
        </div>

        <div class="m-20 p-2 w-full">
          <button @click="deleteItem(item.id)" style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; transition: 0.3s; " @mouseover="this.style.backgroundColor='darkred'" @mouseleave="this.style.backgroundColor='red'">削除する</button>
        </div>

        </div>
      </div>
    </div>
</form>
</section>
</template>