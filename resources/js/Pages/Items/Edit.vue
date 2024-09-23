<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'



const props = defineProps({
  item: Object
})

const form = reactive({
  id: props.item.id,
  name: props.item.name,
  memo: props.item.memo,
  price: props.item.price,
  is_seling: props.item.is_seling 
})

const storeItem = () => {
    Inertia.post('/items', form)
}

</script>

<template>

<section class="text-gray-600 body-font relative">
    <form @submit.prevent="storeItem">
    <BreezeValidationErrors :errors="errors" />
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
            <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="memo" class="leading-7 text-sm text-gray-600">Message</label>
            <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="price" class="leading-7 text-sm text-gray-600">Name</label>
            <input type="text" id="price" name="price" v-model="form.price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="is_seling" class="leading-7 text-sm text-gray-600">ステータス</label>

          </div>
        </div>

        <div class="p-2 w-full">
          <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
        </div>

        </div>
      </div>
    </div>
</form>
</section>
</template>