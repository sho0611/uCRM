<script setup>
defineProps(['flash']);
</script>

<template>
    <div v-if="flash.message && flash.status === 'success'" class="bg-blue-300 text-white p-4">
        {{ flash.message }}
    </div>

    <div v-if="flash.message && flash.status === 'danger'" class="bg-red-300 text-white p-4">
        {{ flash.message }}
    </div>
</template>
