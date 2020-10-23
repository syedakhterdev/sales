<template>
    <v-card
        height="100vh"
        width="256"
        class="mx-auto"
    >
        <v-navigation-drawer permanent>
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title">
                        Application
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        subtext
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list
                dense
                nav
            >
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    link
                    :to="item.url"
                >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                        </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </v-card>
</template>

<script>
    export default {
        data() {
            return {
                items: [
                    {
                        title: 'Customers',
                        icon: '',
                        url: '/'
                    },
                    {
                        title: 'Products',
                        icon: '',
                        url: '/products'
                    },
                    {
                        title: 'Orders',
                        icon: '',
                        url: '/orders'
                    },
                ]
            }
        }
    }
</script>
