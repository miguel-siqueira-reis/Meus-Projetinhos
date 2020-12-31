<template>
    <div class="container-row">
        <div class="avatar" :class="{'bot-avatar': isBot}"></div>
        <strong>{{ name }}</strong>
        <span class="bot" v-if="isBot">bot</span>
    </div>
</template>

<script>
export default {
    props: {
        name: String,
        isBot: Boolean
    }
}
</script>

<style lang="scss" scoped>

.container-row {
    display: flex;
    margin-top: 5px;
    padding: 5px;
    align-items: center;
    cursor: pointer;
    border-radius: 5px;
    background-color: transparent;
    transition: .2;

    &:hover {
        background-color: rgba(0,0,0,.1);
    }

    strong {
        margin-left: 13px;
        font-weight: 500;
        opacity: .7;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: var(--white);
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        background-color: var(--primary);
    }

    .bot {
        margin-left: 9px;
        background-color: var(--discord);
        color: var(--white);
        padding: 4px 5px;
        border-radius: 4px;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 12px;
    }

    .boot-avatar {
        background-color: var(--mention-detail);
    }
}

</style>