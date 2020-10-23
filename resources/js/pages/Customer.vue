<template>
    <v-card >
        <v-snackbar
            v-model="snackbar"
            color="primary"
        >
            Data has been save successfully!
        </v-snackbar>
    <v-data-table
        :headers="headers"
        :items="customers"
        sort-by="calories"
        class="elevation-1"
        :search="search"
    >
        <template v-slot:top>
            <v-toolbar
                flat
            >
                <v-toolbar-title>Customers</v-toolbar-title>

                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    label="Search Customer"
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
                <customer-dialog :dialog="dialog" :editedItem="editedItem" :hideDialog="hideDialog"
                :editedIndex="editedIndex"></customer-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
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
    import CustomerDialog from "../components/customer/CustomerDialog";
    export default {
        components: {
            CustomerDialog
        },
        data: () => ({
            search: '',
            snackbar: false,
            dialog: false,
            dialogDelete: false,
            headers: [
                {
                    text: 'ID',
                    align: 'start',
                    sortable: true,
                    value: 'customerNumber',
                },
                { text: 'Name', value: 'customerName' },
                { text: 'Phone', value: 'phone' },
                { text: 'City', value: 'city' },
                { text: 'State', value: 'state' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            customers: [],
            editedIndex: -1,

            editedItem: {
                customerNumber: '',
                customerName: '',
                contactLastName: '',
                contactFirstName: '',
                phone: '',
                addressLine1: '',
                addressLine2: '',
                city: '',
                state: '',
                postalCode: '',
                country: '',
                salesRepEmployeeNumber: null,
                creditLimit: ''
            },
            defaultItem: {
                customerName: '',
                contactLastName: '',
                contactFirstName: '',
                phone: '',
                addressLine1: '',
                addressLine2: '',
                city: '',
                state: '',
                postalCode: '',
                country: '',
                salesRepEmployeeNumber: null,
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
                axios.get('/api/customers')
                .then((response) => {
                    this.customers = response.data
                });

            },

            editItem (item) {
                this.editedIndex = this.customers.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                this.editedIndex = this.customers.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },

            deleteItemConfirm () {
                this.customers.splice(this.editedIndex, 1)
                this.closeDelete()
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
            hideDialog(type, data) {
                this.dialog = false;
                if(type === 'update') {
                    Object.assign(this.customers[this.editedIndex], data);
                    this.snackbar = true;
                } else if(type === 'add') {
                    this.customers.push(data);
                    this.snackbar = true;
                }
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }


        },
    }
</script>
