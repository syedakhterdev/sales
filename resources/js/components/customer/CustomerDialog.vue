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
                    <v-row>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.name"
                                label="First Name"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.calories"
                                label="Calories"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.fat"
                                label="Fat (g)"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.carbs"
                                label="Carbs (g)"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            sm="6"
                            md="4"
                        >
                            <v-text-field
                                v-model="editedItem.protein"
                                label="Protein (g)"
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
