<template>
    <div class="container">
        <h2 class="title">Servidor</h2>
        <div class="icon">
            <ExpandIcon size="28" />
        </div>
    </div>    
</template>

<script>
import ExpandIcon from 'vue-material-design-icons/ChevronDown';

export default {
    components: {
        ExpandIcon
    }
}

</script>

<style scoped>

.container {
    align-items: center;
    background-color: var(--secondary);
    display: flex;
    grid-area: SN;
    justify-content: space-between;
    padding: 0 11px 0 16px;
    box-shadow: rgba(0,0,0,.9) 0 1px 0 0;
    z-index: 1;
    
}

.title {
    color: var(--white);
    font-size: 16px;
    font-weight: bold;
}

.icon {
    color: var(--white);
    cursor: pointer;
}

</style>