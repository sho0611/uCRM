<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'

const form = reactive({
    name: null,
    memo: null,
    price: null
})

const storeGame = () => {
    Inertia.post('/games', form)
}
</script>
<template>
    <form @submit.prevent="storeGame">
       <div class="p-2 w-1/2">
          <div class="relative">
            <label for="name" class="leading-7 text-sm text-gray-600">ゲーム名</label>
            <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="memo" class="leading-7 text-sm text-gray-600">ジャンル</label>
            <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
          </div>
        </div>

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="price" class="leading-7 text-sm text-gray-600">値段</label>
            <input type="price" id="price" name="price" v-model="form.price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
          </div>
        </div>
        <button>購入登録する</button>
    </form>

</template>