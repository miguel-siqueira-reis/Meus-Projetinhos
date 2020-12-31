<template>
    <div class="container_user">
        <h3 class="role">Disponiveis - 2</h3>
        <UserRow name="Miguel Siqueira"/>
        <UserRow name="Rafael Neris"/>
        <UserRow name="Algum bot" isBot />
        <h3 class="role">Offline - 17</h3>
        <UserRow name="Josoares" />
        <UserRow name="não existo" />
        <UserRow name="pura mentira" />
        <UserRow name="Slomão" />
        <UserRow name="lininha" />
        <UserRow name="perigão" />
        <UserRow name="Maria fernandis" />
        <UserRow name="soares souza" />
        <UserRow name="sem nome" />
        <UserRow name="jOsE" />
        <UserRow name="pessoas" />
        <UserRow name="guilherme" />
        <UserRow name="felipe" />
        <UserRow name="clebinho" />
        <UserRow name="clebinho outro" />
        <UserRow name="Algum outro bot" isBot />
        <UserRow name="souza Soares" />
    </div>
</template>

<script>
import UserRow from './UserRow';

export default {
    components: {
        UserRow
    }
}
</script>

<style lang="scss" scoped>

.container_user {
    grid-area: UL;
    display: flex;
    flex-direction: column;
    padding: 3px 6px 10px 16px;
    background-color: var(--secondary);
    max-height: calc(100vh - 46px);
    overflow-y: scroll;

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

.role {
    margin-top: 20px;
    color: var(--grey);
    font-weight: 500;
    font-size: 14px;
    text-transform: uppercase;
}

</style>