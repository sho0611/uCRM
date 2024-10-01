<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive,onMounted } from 'vue';
import { getToday } from '@/common';
import axios from 'axios';
import Chart from '@/Components/Chart.vue'
import ResuliTable from '@/Components/ResultTable.vue'


onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})

const form = reactive({
    startDate: null,
    endDate: null,
    type: 'perDay',
    rfmPrms: [
    14, 28, 60, 90, 7, 5, 3, 2, 300000, 200000, 100000,
    30000
    ], 
})

const data = reactive({})

const getData = async () => {
    try {

        data.data = [];
        const res = await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,  // フォームから取得した開始日
                endDate: form.endDate,      // フォームから取得した終了日
                type: form.type,
                rfmPrms: form.rfmPrms  
            }
        })
        .then ( res => {
        // 取得したデータをコンソールに表示（JSON形式）
            // 取得したデータをコンソールに表示（JSON形式）
            data.data = res.data.data
            if(res.data.labels) {data.lables = res.data.labels}
            if(res.data.eachCount) {data.eachCount = res.data.eachCount}
            data.totals = res.data.totals
            //これを追加するとデータが再レンダリングされ、表示が二度表示される
            data.type = res.data.type
            console.log(res.data)
        })
    } catch (e) {
        console.log(e.message); // エラーハンドリング
    }
}



</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="getData">
                        分析方法<br>
                        <input type="radio" v-model="form.type" value="perDay" checked><span class="mr-2">日別</span>
                        <input type="radio" v-model="form.type" value="perMonth"><span class="mr-2">月別</span>
                        <input type="radio" v-model="form.type" value="perYear"><span class="mr-2">年別</span>
                        <input type="radio" v-model="form.type" value="decile"><span class="mr-2">デシル分析</span>
                        <input type="radio" v-model="form.type" value="rfm"><span class="mr-2">RFM分析</span>
                        
                      From: <input type="date" name="startDate" v-model="form.startDate"><br>
                        To: <input type="date" name="endtDate" v-model="form.endDate"><br>

                        <div v-if="form.type === 'rfm'">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ランク</th>
                                        <th>R (○日以内)</th>
                                        <th>F (○回以上)</th>
                                        <th>M (○円以上)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="number" v-model="form.rfmPrms[0]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[4]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[8]"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="number" v-model="form.rfmPrms[1]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[5]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[9]"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="number" v-model="form.rfmPrms[2]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[6]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[10]"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="number" v-model="form.rfmPrms[3]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[7]"></td>
                                        <td><input type="number" v-model="form.rfmPrms[11]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button>分析する</button>
                    </form>
                    <div v-show="data.data">
                        <div v-if="data.type != 'rfm'">
                            <Chart :data="data" />
                        </div>
                        <ResuliTable :data="data" />
                    </div>
            
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
