<template>
    <div class="app-container">
        <b-navbar class="app-header">
            <b-navbar-brand href="#" class="brand">
                Test Assignment
            </b-navbar-brand>

            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right class="user-dropdown">
                    <!-- Using 'button-content' slot -->
                    <template #button-content>
                        <b-avatar text="BD"/>
                        <span class="user-info pl-3 pr-3">
                            <div class="name">
                                <em>Benji D</em>
                            </div>
                            <div class="type">
                                <small>Admin</small>
                            </div>
                        </span>
                    </template>
                    <b-dropdown-item href="#">Profile</b-dropdown-item>
                    <b-dropdown-item href="#">Sign Out</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
        <transition name="fade">
            <router-view />
        </transition>
    </div>
</template>

<script>

export default {
}
</script>

<style scoped lang="scss">
    .app-container {
        height: 100vh;
    }
    .app-header {
        .brand {
            padding-top: 0;
            padding-bottom: 0;
        }
        .user-dropdown {
            .user-info {
                display: inline-flex;
                flex-direction: column;
                .type {
                    margin-top: -5px;
                }
            }
        }
    }
</style>

<style lang="scss">
    .app-header .user-dropdown .dropdown-toggle {
        display: inline-flex;
        align-items: center;
        padding-top: 0;
        padding-bottom: 0;
    }
</style>