<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { route } from 'ziggy-js';

defineProps({ game: Object})

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
            <div id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              {{ game.name }}
            </div>
          </div>
        </div>

        <div class="p-2 w-full">
          <div class="relative">
            <label for="memo" class="leading-7 text-sm text-gray-600">ジャンル</label>
            <div id="memo" name="memo" v-html="game.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></div>
         
          </div>
        </div>

        <div class="p-2 w-1/2">
          <div class="relative">
            <label for="price" class="leading-7 text-sm text-gray-600">値段</label>
            <div type="price" id="price" v-html="game.price" name="price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
        </div>
        <Link as="button" :href="route('games.edit', {
          game: game.id
        })">編集する</Link>

    </form>

</template>