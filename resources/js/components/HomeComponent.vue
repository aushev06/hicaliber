<template>
    <el-container>
        <el-header>Header</el-header>
        <el-main>

            <div class="filters">
                <el-input placeholder="Name" @input="getHomes" v-model="filters.name"/>
                <div class="prices">
                    <el-input @input="getHomes" v-model="filters.prices.priceFrom" placeholder="PRICE FROM"/>
                    <span>-</span>
                    <el-input @input="getHomes" v-model="filters.prices.priceTo" placeholder="PRICE TO"/>
                </div>
                <el-input @input="getHomes" v-model="filters.bedrooms" placeholder="BEDROOMS"/>
                <el-input @input="getHomes" v-model="filters.bathrooms" placeholder="BATHROOMS"/>
                <el-input @input="getHomes" v-model="filters.storeys" placeholder="STOREYS"/>
                <el-input @input="getHomes" v-model="filters.garages" placeholder="GARAGES"/>
            </div>

            <el-table
                :data="tableData"
                v-loading="loading"
                empty-text="No data"
                style="width: 100%">
                <el-table-column
                    prop="name"
                    label="NAME"
                    width="180">
                </el-table-column>
                <el-table-column
                    prop="price"
                    label="PRICE"
                    width="180">
                </el-table-column>
                <el-table-column
                    prop="bedrooms"
                    label="BEDROOMS">
                </el-table-column>
                <el-table-column
                    prop="bathrooms"
                    label="BATHROOMS">
                </el-table-column>
                <el-table-column
                    prop="storeys"
                    label="STOREYS">
                </el-table-column>
                <el-table-column
                    prop="garages"
                    label="GARAGES">
                </el-table-column>
            </el-table>
        </el-main>
    </el-container>
</template>

<script>
    import {Container, Header, Main, Table, TableColumn, Input} from 'element-ui';

    const CancelToken = window.axios.CancelToken;

    let cancel;

    export default {
        components: {
            Container,
            Header,
            Main,
            Table,
            TableColumn,
            Input
        },

        data() {
            return {
                tableData: [],
                loading: false,
                filters: {
                    name: '',
                    prices: {
                        priceFrom: '',
                        priceTo: ''
                    },
                    bedrooms: '',
                    bathrooms: '',
                    storeys: '',
                    garages: ''

                }
            }
        },
        mounted() {
            this.getHomes()
        },

        methods: {
            getHomes: function () {
                this.loading = true;
                if(cancel) {
                    cancel();
                }

                window.axios.get('/api/homes', {
                    params: this.filters,
                    cancelToken: new CancelToken(function executor(c) {
                        // An executor function receives a cancel function as a parameter
                        cancel = c;
                    })
                })
                    .then(r => {
                        this.tableData = r.data;
                    }).finally(_ => {
                        this.loading = false;
                });
            }
        }
    }
</script>

<style>
    .filters {
        display: flex;
        justify-content: space-between;
    }

    .filters > div {
        margin-left: 5px;
    }

    .filters .prices {
        display: flex;
        width: 100%;
        align-items: center;
    }

</style>
