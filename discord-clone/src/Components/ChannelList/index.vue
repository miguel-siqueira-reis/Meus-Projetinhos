<template>
    <div class="container">
        <div class="category">
            <h2>Canais de Texto</h2>
            <div class="category__icon">
                <AddCategoryButton :size="21" />
            </div>
        </div>

        <ChannelButton selected channelName="Chat Lirvre"/>
        <ChannelButton channelName="vue-js"/>
        <ChannelButton channelName="jogos"/>
        <ChannelButton channelName="csgo"/>
        <ChannelButton channelName="react-js"/>

    </div>
</template>

<script>
import ChannelButton from './ChannelButton';
import AddCategoryButton from 'vue-material-design-icons/Plus';

export default {
    components: {
        ChannelButton,
        AddCategoryButton
    }
}
</script>

<style lang="scss" scoped>

.container {
    grid-area: CL;
    display: flex;
    flex-direction: column;
    padding: 24px 10px 16px;
    background-color: var(--secondary);
}

.category {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    color: var(--grey);
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;

    .category__icon {
        color: var(--symbol);
        cursor: pointer;
    }
}

</style>