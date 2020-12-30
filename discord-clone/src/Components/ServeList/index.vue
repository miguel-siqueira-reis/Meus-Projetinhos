<template>
    <div class="container">
        <ServeButton isHome />
        <div class="separator"></div>
        <ServeButton hasNotification :mentions="3"/>
        <ServeButton hasNotification />
        <ServeButton hasNotification :mentions="32" />
        <ServeButton hasNotification />
        <ServeButton  />
        <ServeButton hasNotification :mentions="4" />
        <ServeButton  v-for="servers in 18" :key="servers.id"/>

    </div>
</template>

<script>
import ServeButton from './ServeButton.vue';

export default {
    components: {
        ServeButton
    }
}

</script>

<style lang="scss" scoped>

.container {
    grid-area: SL;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: var(--tertiary);
    padding: 11px 0;
    max-height: 100vh;
    overflow-y: scroll;
    
    &::-webkit-scrollbar {
        display: none;
    }
    scrollbar-width: none

}

.separator {
    width: 32px;
    border-bottom: 2px solid var(--quaternary);
    margin-bottom: 8px;
}

</style>