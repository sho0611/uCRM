<script setup>
import { onMounted } from 'vue';

const props = defineProps({
    orders: Object
})
//console.log(props.orders.data)

</script>
<template>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>顧客名</th>
                <th>合計</th>
                <th>ステータス</th>
                <th>作成日</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="order in props.orders.data" :key="order.id">
                <td>{{ order.id }}</td>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.total !== null ? order.total : 'N/A' }}</td>
                <td>{{ order.status }}</td>
                <td>{{ order.created_at }}</td>
            </tr>
        </tbody>
    </table>
    <Pagination :links="props.orders.links"></Pagination>
</template>


