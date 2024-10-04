<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { route } from 'ziggy-js';

defineProps({ games: Array})

</script>


<template>
    <tr v-for="game in games" :key="game.id">
        <td>
        <Link class="text-bule-400" :href="route('games.show', {
           //key:  value
            game: game.id
        })">
            {{ game.id }}
        </Link>
        </td>
        <td>{{ game.name }}</td>
        <td>{{ game.memo }}</td>
        <td>{{ game.price }}</td>
    </tr>
    <Link as="button" :href="route('games.create')">購入登録</Link>


    
</template>
