<template>
    <!-- App.vue -->

    <v-app>
        <v-navigation-drawer app>
            <side-bar></side-bar>
        </v-navigation-drawer>

        <v-app-bar app>
            <!-- -->
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <!-- If using vue-router -->
                <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer app>
            <!-- -->
        </v-footer>
    </v-app>
</template>

<script>
    import NavBar from "../components/NavBar";
    import SideBar from "../components/SideBar";
    export default {
        components: {
            NavBar,
            SideBar
        },
        created: () => {
            console.log('Created App');
        }
    }
</script>
