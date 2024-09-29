<script setup>
import { Chart, registerables } from "chart.js";
import { BarChart } from "vue-chart-3";
import { reactive } from "vue"
import { computed } from 'vue'
import { onMounted } from "vue";

const props = defineProps({ 
    'data' : Object })

onMounted(() => {
    console.log(props.data.lables);
    console.log(props.data.totals);
});

const labels = computed(() => props.data.lables )
const totals = computed(() => props.data.totals )


Chart.register(...registerables);
const barData = reactive({
labels: labels,
datasets: [
{
label: '売上',
data: totals,
backgroundColor: "rgb(75, 192, 192)",
tension: 0.1,
}
]
})
</script>
<template>
    <div v-show="props.data">
        <BarChart :chartData="barData" />
    </div>
</template>