<template>
    <div class="container-message" :class="{'has-mentions': hasMentions, 'is-bot': isBot}">
        <div class="avatar"></div>
        <div class="message">
            <div class="user">
                <strong>{{ author }}</strong>
                <span class="bot" v-if="isBot">Bot</span>
                <span class="date">{{ date }}</span>
            </div>
            <div class="body">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        author: String,
        date: String,
        hasMentions: Boolean,
        isBot: Boolean
    }
}

</script>

<style lang="scss" scoped>

.container-message {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    margin-right: 4px;
    background-color: transparent;
    margin-top: 13px;

    &:hover {
        background-color: var(--quaternary);
    }

    &.has-mentions {
        background-color: var(--mention-message);
        border-left: 2px solid var(--mention-detail);
    }

    &.is-bot {
        .avatar {
            background-color: var(--mention-detail);
        }

        .bot {
            margin-left: 9px;
            background-color: var(--discord);
            color: var(--white);
            padding: 4px 5px;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: bold;
        }
    }
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--secondary);
    flex-shrink: 0;
    margin-right: 1rem;
}

.message {
    height: 40px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    strong {
        color: var(--white);
        font-size: 16px;
    }

    .date {
        margin-left: 6px;
        color: var(--grey);
        font-size: 13px;
    }
    
    .body {
        color: var(--white);
        text-transform: left;
        font-size: 16px;
        
        .mention {
            color: var(--link);
            cursor: pointer;

            &:hover {
                text-decoration: underline;
            }
        }
    }
}

</style>