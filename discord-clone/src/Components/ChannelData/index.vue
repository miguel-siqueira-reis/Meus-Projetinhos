<template>
    <div class="container">
        <div class="message">
            <ChannelMessage v-for="messages in 18" :key="messages.id" author="Miguel Siqueira" date="29/12/2020" >Isso é uma mensagem</ChannelMessage>
            <ChannelMessage author="Rafael Neris" hasMentions date="29/12/2020" >
                <Mention>@Miguel Siqueira</Mention>, pq esta spamando isso??
            </ChannelMessage>
            <ChannelMessage author="Algum bot" isBot  date="29/12/2020">
                eu sou um bot
            </ChannelMessage>
        </div>
        <div class="input-wrapper">
            <input type="text" placeholder="Converssar em #chat-livre"/>
            <div class="icon">
                <Arroba :size="24" />
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import Arroba from 'vue-material-design-icons/At'; 
import ChannelMessage from './ChannelMessage';

export default {
    components: {
        Arroba,
        ChannelMessage,
        
    }
}

Vue.component('Mention', {
    template: '<span class="mention"><slot /></span>',
});
</script>

<style lang="scss" scoped>

.container {
    background-color: var(--primary);
    display: flex;
    flex-direction: column;
    flex: 1;
    grid-area: CD;
    justify-content: space-between;
}

.message {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 46px - 68px);
    max-height: calc(100vh - 46px - 68px);
    overflow-y: scroll;
    flex: 1;

.container-message:first-child {
    margin-top: 0;
}

    &::-webkit-scrollbar {
        width: 4px;
    }

    &::-webkit-scrollbar-thumb {
        background-color: var(--tertiary);
        border-radius: 4px;
    }

    &::-webkit-scrollbar-track {
        background-color: var(--secondary);
    }
    
}

.input-wrapper {
    width: 100%;
    padding: 0 16px;
    height: 68px;
    position: relative;

    input {
        width: 100%;
        height: 44px;
        padding: 0 10px 0 57px;
        border-radius: 5px;
        color: var(--white);
        background-color: var(--chat-input);
        position: relative;
        font-size: 1rem;
        

        &::placeholder {
            color: var(--grey);
        }

    }

    .icon {
        color: var(--grey);
        position: absolute;
        z-index: 5;
        top: 15%;
        left: 28px;
        transition: .2s;
        width: 24px;
    }

}


</style>