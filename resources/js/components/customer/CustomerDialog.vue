<template>
    <v-dialog
        v-model="dialog"
        max-width="650px"
    >

        <v-card>
            <v-card-title>
                <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-text-field
                                v-model="editedItem.customerName"
                                label="Customer Name"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.contactFirstName"
                                label="First Name"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.contactLastName"
                                label="Last Name"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.phone"
                                label="Phone"
                            ></v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            sm="12"
                            md="12"
                        >
                            <v-text-field
                                v-model="editedItem.addressLine1"
                                label="Address Line 1"
                            ></v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            sm="12"
                            md="12"
                        >
                            <v-text-field
                                v-model="editedItem.addressLine2"
                                label="Address Line 2"
                            ></v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.country"
                                label="Country"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.state"
                                label="State"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.city"
                                label="City"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.postalCode"
                                label="Postal Code"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.postalCode"
                                label="Postal Code"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-select
                                v-model="editedItem.salesRepEmployeeNumber"
                                :items="employees"
                                item-text="full_name"
                                item-value="employeeNumber"
                                label="Sales Rep"
                            ></v-select>
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
            employees: []
        }),
        props: {
            dialog: Boolean,
            hideDialog: Function,
            editedItem: Object,
            defaultItem: Object
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Customer' : 'Edit Customer'
            },
        },
        created () {
            axios.get('/api/employees')
            .then((response) => {
                this.employees = response.data;
            });
        },
        methods: {
            close () {
                // this.dialog = false;
                this.hideDialog();
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },
            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.customers[this.editedIndex], this.editedItem)
                } else {
                    this.customers.push(this.editedItem)
                }
                this.close()
            },
        }
    }
</script>
