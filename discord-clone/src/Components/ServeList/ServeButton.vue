<template>
    <div class="serve__button" :class="{ 'servebutton-ishome': isHome, 'servebutton-hasnotification': hasNotification }">
        <img src="./../../assets/discord.svg" alt="logo do discord" class="servebutton-img" v-if="isHome">
        <div class="mentions" v-if="mentions">
            {{ mentions }}
        </div>
    </div>    
</template>

<script>
export default {
    props: {
        select: Boolean,
        isHome: Boolean,
        hasNotification: Boolean,
        mentions: Number,
        
    },
}
</script>

<style lang="scss" scoped>

.serve__button {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    height: 48px;
    width: 48px;
    margin-bottom: 8px;
    background: var(--primary);
    cursor: pointer;
    position: relative;
    border-radius: 50%;
    transition:     0.2s;

img {
    width: 24px;
    height: 24px;
}

    &.active,
    &:hover {
        border-radius: 16px;
        background-color: var(--discord);
    }

.mentions {
    background-color: var(--notification);
    width: auto;
    height: 24px;
    padding: 0 4px;
    position: absolute;
    border-radius: 12px;
    bottom: -4px;
    border: 4px solid var(--quaternary);
    right: -4px;
    text-align: right;
    font-size: 13px;
    font-weight: bold;
    color: var(--white);
}

}

.servebutton-ishome {
    background-color: var(--rocketseat);

    &.active,
    &:hover {
        border-radius: 16px;
        background-color: var(--rocketseat);
    }
}

.servebutton-hasnotification {
    &::before {
        content: "";
        width: 9px;
        height: 9px;
        background-color: var(--white);
        position: absolute;
        left: -17px;
        top: calc(50% -4.5px);
        border-radius: 50%;
        display: block;

    }
}

</style>