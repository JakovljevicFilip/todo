<template>
    <q-btn color="green-7" text-color="white" size="lg" label="Add new" @click="taskDialog = true" />
    <TaskDialog v-model:taskDialog="taskDialog" />

</template>

<script setup>
import { ref } from 'vue';
import TaskDialog from './TaskDialog.vue';

const taskDialog = ref(false);
</script>

<style scoped>
</style>
