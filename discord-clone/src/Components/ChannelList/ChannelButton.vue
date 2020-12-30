<template>
    <div class="container__chat" :class="{ active: selected }">
        <div class="channel__info">
            <p><HashTagIcon class="hashicon" :size="20" /></p>
            <h3 class="chat-name">{{ channelName }}</h3>
        </div>
        <div class="channel__actions">
            <IviteIcon class="icon__actions" :size="16" />
            <SettingsIcon class="icon__actions" :size="16" />
        </div>
    </div>
</template>

<script>
import HashTagIcon from 'vue-material-design-icons/Pound';
import IviteIcon from 'vue-material-design-icons/AccountPlus';
import SettingsIcon from 'vue-material-design-icons/CogOutline';

export default {
    components: {
        HashTagIcon,
        IviteIcon,
        SettingsIcon
    },
    props: {
        channelName: String,
        selected: Boolean
    }
}
</script>

<style lang="scss" scoped>
.container__chat {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 5px 3px;
    cursor: pointer;
    border-radius: 5px;
    background-color: transparent;

    > div {
        display: flex;
        align-items: center;
    }

    .channel__info {
        h3 {
            color: var(--senary);
            font-size: 16px;
        }
        .hashicon {
            color: var(--symbol);
            margin-right: 8px;
        }
    }


    .channel__actions {
        display: none;
        .icon__actions {
            color: var(--symbol);
            margin-left: 4px;
            transition: 0.2s;
            &:hover {
                color: var(--white);
            }
        }
    }
    &.active,    
    &:hover {
        background-color: var(--quinary);
        .channel__info {
            h3 {
                color: var(--white)
            }
        }

        .channel__actions {
            display: flex;
        }
    }

}
</style>