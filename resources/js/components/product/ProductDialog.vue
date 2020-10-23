<template>
    <v-dialog
        v-model="dialog"
        max-width="500px"
    >

        <v-card>
            <v-card-title>
                <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-alert
                        dense
                        outlined
                        type="error"
                        v-if="showErro"
                    >
                    <ul>
                        <li v-for="errors in allerror">
                                    {{ errors }}
                        </li>
                    </ul>
                    </v-alert>
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.productName"
                                label="Product Name"
                                :error-messages="allerror.name"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-select
                            item-text="productLine"
                            v-model="prodSelected"
                            :items="productLines"
                            />
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.productVendor"
                                label="Product Vendor"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.productScale"
                                label="Product Scale"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.productDescription"
                                label="Product Description"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.quantityInStock"
                                label="Quantity In Stock"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.buyPrice"
                                label="Buy Price"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.MSRP"
                                label="MSRP"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    
                </v-container>
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="close"
                >
                    Cancel
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="save"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        data: () => ({
            allerror:[],
            showErro:false,
            productLines:[]
        }),
        props: {
            dialog: Boolean,
            hideDialog: Function,
            initializeData:Function,
            editedItem: Object,
            defaultItem: Object,
            prodSelected:null
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Product' : 'Edit Product'
            },
        },
        created () {
            this.getProdLines();
        },

        methods: {
            getProdLines () {
                 axios.get('/api/productLine')
                .then((response) => {
                    console.log('productLines',response.data)
                    this.productLines = response.data
                });
            },
        
            close () {
                // this.dialog = false;
                this.hideDialog();
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                    this.showErro = false;
                    this.allerror = [];
                })
            },
            
            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.products[this.editedIndex], this.editedItem)
                } else {
                    if(this.editedItem.productCode){
                        this.edit(this.editedItem.productCode,this.editedItem);
                    }else{
                        this.add(this.editedItem)
                    }
                }
                
            },

            add(data){
                axios.post('/api/product-add/',{
                    productCode: data.productCode,
                    productName: data.productName,
                    productLine: this.prodSelected,
                    productScale: data.productScale,
                    productVendor: data.productVendor,
                    productDescription: data.productDescription,
                    quantityInStock: data.quantityInStock,
                    buyPrice: data.buyPrice,
                    MSRP: data.MSRP,
                })
                .then((response) => {
                    this.initializeData();
                    this.showErro = false;
                    this.allerror = [];
                    this.close()
                })
                .catch((error) =>{ 
                    this.showErro = true;
                    this.allerror = error.response.data
                });
            },

            edit(id,data){
                axios.post('/api/product/'+id,{
                    productCode: data.productCode,
                    productName: data.productName,
                    productLine: this.prodSelected,
                    productScale: data.productScale,
                    productVendor: data.productVendor,
                    productDescription: data.productDescription,
                    quantityInStock: data.quantityInStock,
                    buyPrice: data.buyPrice,
                    MSRP: data.MSRP,
                })
                .then((response) => {
                    this.initializeData();
                    this.showErro = false;
                    this.allerror = [];
                    this.close()
                })
                .catch((error) =>{ 
                    this.showErro = true;
                    this.allerror = error.response.data
                });
            }
        }
    }
</script>
