<template>
    <div id="container">
        <TaskIndex/>
    </div>
</template>

<script lang="ts">
import TaskIndex from './components/Task/Index.vue';

export default {
    components: {
        TaskIndex,
    },
};
</script>

<style>
#container {
    min-width: 450px;
}
</style>
