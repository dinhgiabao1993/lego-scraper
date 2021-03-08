<template>
    <div class="container-fluid">
        <h3>Lego Retiring Soon Products</h3>

        <b-form class="row">
            <b-form-group label="Item Number" class="col-md-2">
                <b-form-input v-model="filter.external_id" @keyup.enter="getProducts" type="number" min="0" step="1" placeholder="Item Number"/>
            </b-form-group>
            <b-form-group label="Marketplace" class="col-md-2">
                <b-form-select v-model="filter.marketplace" @change="getProducts" :options="marketplaces"></b-form-select>
            </b-form-group>
            <b-form-group label="Product Name" class="col-md-2">
                <b-form-input v-model="filter.name" @keyup.enter="getProducts" type="text" min="0" step="1" placeholder="Product Name"/>
            </b-form-group>
        </b-form>

        <b-overlay :show="loading" rounded="sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Marketplace</th>
                    <th scope="col">Item Number</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Listing URL</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Discount Amount</th>
                    <th scope="col">Discount Percentage</th>
                    <th scope="col">Spotted At</th>
                    <th scope="col">Stock Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) of products" :key="product.id">
                        <th scope="row">{{index + 1}}</th>
                        <td>{{get(product, 'marketplace')}}</td>
                        <td>{{get(product, 'external_id')}}</td>
                        <td>{{get(product, 'name')}}</td>
                        <td>
                            <a v-if="get(product, 'url')" :href="get(product, 'url')">{{get(product, 'url')}}</a>
                        </td>
                        <td>{{get(product, 'price')}} {{get(product, 'currency')}}</td>
                        <td>
                            <template v-if="get(product, 'sale_price')">{{get(product, 'sale_price')}} {{get(product, 'currency')}}</template>
                        </td>
                        <td>
                            <template v-if="get(product, 'discount_amount')">{{get(product, 'discount_amount')}} {{get(product, 'currency')}}</template>
                        </td>
                        <td>
                            <template v-if="get(product, 'discount_percentage')">{{get(product, 'discount_percentage')}}%</template>
                        </td>
                        <td>{{get(product, 'spotted_at')}}</td>
                        <td>{{get(product, 'stock_status', '').toUpperCase()}}</td>
                    </tr>
                    <tr v-if="!products.length">
                        <td colspan="11" class="text-center">No Products Found</td>
                    </tr>
                </tbody>
            </table>
        </b-overlay>

        <b-pagination v-model="filter.page" @input="getProducts" align="center" :total-rows="total" per-page="15"/>
    </div>
</template>

<script>
import { get } from 'lodash'

export default {
    data() {
        return {
            loading:false,
            total: 0,
            filter: {
                page: 1,
                marketplace: null,
            },
            products: [],
            marketplaces: [
                { value: null, text: 'Marketplace' },
                { value: 'US', text: 'US' },
                { value: 'UK', text: 'UK' },
            ],
            source: null,
        }
    },
    mounted() {
        this.getProducts()
    },
    methods: {
        async getProducts() {
            if (this.source) {
                this.source.cancel('Request canceled')
            }
            this.source = axios.CancelToken.source()
            try {
                this.loading = true
                const response = await axios.get('/products', {
                    params: this.filter,
                    cancelToken: this.source.token
                })

                if (get(response, 'data.success')) {
                    this.loading = false
                    this.products.splice(0)
                    this.products.push(...get(response, 'data.data.data', []))
                    this.filter.page = get(response, 'data.data.current_page', 1)
                    this.total = get(response, 'data.data.total', 0)
                }
            } catch (e) {
                if (!axios.isCancel(e)) {
                    this.loading = false
                }
            }
        },
        get(key, defaultValue = null) {
            return get(key, defaultValue)
        },
    }
}
</script>