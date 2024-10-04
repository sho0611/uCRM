<script setup>
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { route } from 'ziggy-js';
import Pagination from '@/Components/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
import dayjs from 'dayjs';
import { reactive } from 'vue';

const props = defineProps({
    orders: Object
});

const search = ref("");

const selectedStatus = ref('')

const searchPurchase = () => {
    Inertia.get(route('purchases.index', { search: search.value, status: selectedStatus.value })); // statusを渡す
};


</script>

<template>
    <Head title="購買履歴" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <FlashMessage :flash="$page.props.flash" />
                                <div>
                                    <input type="text" name="search" v-model="search">
                                    <button class="bg-blue-300 text-white py-2 px-2" @click="searchPurchase">検索</button>
                                </div>

                                <div>
                                    <label for="status">ステータスを選択</label>
                                    <select v-model="selectedStatus">
                                    <option value="1">ステータス 1</option>
                                    <option value="0">ステータス 0</option>
                                    <!-- 他のステータスも追加可能 -->
                                    </select>
                                </div>
                    
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">氏名</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="order in props.orders.data" :key="order.id">
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                    <Link class="text-blue-400" :href="route('purchases.show', { purchase: order.id })">
                                                        {{ order.id }}
                                                    </Link>
                                                </td>
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ order.customer_name }}</td>
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ order.customer_kana }}</td>
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ order.total }}</td>
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ order.status }}</td>
                                                <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <Pagination class="mt-6" :links="props.orders.links"></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

