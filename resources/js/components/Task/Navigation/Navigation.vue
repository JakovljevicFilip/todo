<template>
    <div class="row justify-center q-mb-md">
        <div class="col row justify-center">
            <CreateTask />
        </div>
        <div class="col row justify-center">
            <ToggleDisplayTasks />
        </div>
    </div>
</template>

<script setup>
import CreateTask from './CreateTask.vue';
import ToggleDisplayTasks from './ToggleDisplayTasks.vue';
</script>

<style scoped>
</style>
