<template>
    <v-card >
        <v-card-title>

        </v-card-title>
    <v-data-table
        :headers="headers"
        :items="products"
        sort-by="calories"
        class="elevation-1"
        :search="search"
    >
        <template v-slot:top>
            <v-toolbar
                flat
            >
                <v-toolbar-title>Product</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    label="Search Product"
                    single-line
                    hide-details
                    max-width="400px"
                    align="right"
                ></v-text-field>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-on:click="showHideDialog()"
                >
                    New Item
                </v-btn>
                <product-dialog :initializeData="initialize" :editedItem="editedItem"  :dialog="dialog" :hideDialog="hideDialog"></product-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn
                color="primary"
                @click="initialize"
            >
                Reset
            </v-btn>
        </template>
    </v-data-table>
    </v-card>
</template>
<script>
    import ProductDialog from "../components/product/ProductDialog";
    export default {
        components: {
            ProductDialog
        },
        data: () => ({
            search: '',
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'ID',
                    align: 'start',
                    sortable: true,
                    value: 'productCode',
                },
                { text: 'Product Code', value: 'productCode' },
                { text: 'Product Name', value: 'productName' },
                { text: 'Product Line', value: 'productLine' },
                { text: 'Product Scale', value: 'productScale' },
                { text: 'Product Vendor', value: 'productVendor' },
                { text: 'Product Description', value: 'productDescription' },
                { text: 'Quantity In Stock', value: 'quantityInStock' },
                { text: 'Buy Price', value: 'buyPrice' },
                { text: 'MSRP', value: 'MSRP' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            products: [],
            editedIndex: -1,

            editedItem: {
                productName: '',
                productLine: '',
                productVendor: '',
                productScale: '',
                productDescription: '',
                quantityInStock: '',
                buyPrice: '',
                MSRP: '',
                creditLimit: ''
            },
            defaultItem: {
                productName: '',
                productLine: '',
                productVendor: '',
                productScale: '',
                productDescription: '',
                quantityInStock: '',
                buyPrice: '',
                MSRP: '',
                creditLimit: ''
            },
        }),

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            },
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {
                axios.get('/api/products')
                .then((response) => {
                    console.log(response.data)
                    this.products = response.data
                });

            },

            editItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            showHideDialog() {
              this.dialog = !this.dialog;
            },

            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            closeDelete () {
                this.dialogDelete = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },
            hideDialog() {
                this.dialog = false;
            }


        },
    }
</script>
